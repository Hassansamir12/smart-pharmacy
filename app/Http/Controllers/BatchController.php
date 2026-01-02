<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $medicineId = $request->query('medicine_id');
        $supplierId = $request->query('supplier_id');
        $expiryFrom = $request->query('expiry_from');
        $expiryTo = $request->query('expiry_to');

        $medicines = Medicine::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        $batches = Batch::query()
            ->with(['medicine', 'supplier'])
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('batch_no', 'like', "%{$q}%")
                       ->orWhereHas('medicine', fn ($m) => $m->where('name', 'like', "%{$q}%"))
                       ->orWhereHas('supplier', fn ($s) => $s->where('name', 'like', "%{$q}%"));
                });
            })
            ->when($medicineId, fn ($query) => $query->where('medicine_id', $medicineId))
            ->when($supplierId, fn ($query) => $query->where('supplier_id', $supplierId))
            ->when($expiryFrom, fn ($query) => $query->whereDate('expiry_date', '>=', $expiryFrom))
            ->when($expiryTo, fn ($query) => $query->whereDate('expiry_date', '<=', $expiryTo))
            ->orderBy('expiry_date')
            ->paginate(10)
            ->withQueryString();

        return view('batches.index', compact(
            'batches',
            'medicines',
            'suppliers',
            'q',
            'medicineId',
            'supplierId',
            'expiryFrom',
            'expiryTo'
        ));
    }

    public function create()
    {
        $medicines = Medicine::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('batches.create', compact('medicines', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => ['required', 'exists:medicines,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'batch_no' => ['nullable', 'string', 'max:255'],
            'expiry_date' => ['required', 'date'],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        Batch::create($validated);

        return redirect()->route('batches.index')->with('status', 'Batch created.');
    }

    public function edit(Batch $batch)
    {
        $medicines = Medicine::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('batches.edit', compact('batch', 'medicines', 'suppliers'));
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'medicine_id' => ['required', 'exists:medicines,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'batch_no' => ['nullable', 'string', 'max:255'],
            'expiry_date' => ['required', 'date'],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $batch->update($validated);

        return redirect()->route('batches.index')->with('status', 'Batch updated.');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('batches.index')->with('status', 'Batch deleted.');
    }
}
