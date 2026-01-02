<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $medicines = Medicine::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('name', 'like', "%{$q}%")
                       ->orWhere('barcode', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('medicines.index', compact('medicines', 'q'));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'barcode' => ['nullable', 'string', 'max:255', 'unique:medicines,barcode'],
            'min_stock' => ['nullable', 'integer', 'min:0'],
        ]);

        Medicine::create([
            'name' => $validated['name'],
            'barcode' => $validated['barcode'] ?? null,
            'min_stock' => $validated['min_stock'] ?? 0,
        ]);

        return redirect()->route('medicines.index')->with('status', 'Medicine created.');
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'barcode' => ['nullable', 'string', 'max:255', 'unique:medicines,barcode,' . $medicine->id],
            'min_stock' => ['nullable', 'integer', 'min:0'],
        ]);

        $medicine->update([
            'name' => $validated['name'],
            'barcode' => $validated['barcode'] ?? null,
            'min_stock' => $validated['min_stock'] ?? 0,
        ]);

        return redirect()->route('medicines.index')->with('status', 'Medicine updated.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('status', 'Medicine deleted.');
    }
}
