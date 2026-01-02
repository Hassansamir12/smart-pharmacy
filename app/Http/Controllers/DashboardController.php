<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Batch;

class DashboardController extends Controller
{
    public function index()
    {
        $days = 30;

        $today = now()->toDateString();
        $soonDate = now()->addDays($days)->toDateString();

        $medicinesCount = Medicine::count();
        $batchesCount = Batch::count();

        $expiredCount = Batch::whereDate('expiry_date', '<', $today)->count();

        $expiringSoonCount = Batch::whereDate('expiry_date', '>=', $today)
            ->whereDate('expiry_date', '<=', $soonDate)
            ->count();

        // Low stock: SUM(batches.quantity) per medicine <= medicines.min_stock
        // Requires Medicine model has: public function batches() { return $this->hasMany(Batch::class); }
        $lowStockCount = Medicine::query()
    ->withSum('batches as total_qty', 'quantity')
    ->havingRaw('COALESCE(total_qty, 0) <= COALESCE(min_stock, 0)')
    ->count();


        return view('dashboard', compact(
            'medicinesCount',
            'batchesCount',
            'expiredCount',
            'expiringSoonCount',
            'lowStockCount',
            'days'
        ));
    }
}
