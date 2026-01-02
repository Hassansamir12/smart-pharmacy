<?php

namespace App\Http\Controllers;

use App\Exports\ExpiryAlertsExport;
use App\Models\Batch;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpiryAlertController extends Controller
{
    public function index(Request $request)
    {
        $days = (int) ($request->get('days', 30));

        $today = now()->toDateString();
        $soonDate = now()->addDays($days)->toDateString();

        $expired = Batch::with(['medicine', 'supplier'])
            ->whereDate('expiry_date', '<', $today)
            ->orderBy('expiry_date')
            ->get();

        $expiringSoon = Batch::with(['medicine', 'supplier'])
            ->whereDate('expiry_date', '>=', $today)
            ->whereDate('expiry_date', '<=', $soonDate)
            ->orderBy('expiry_date')
            ->get();

        return view('alerts.expiry', compact('expired', 'expiringSoon', 'days'));
    }

    public function exportExcel(Request $request)
    {
        $days = (int) ($request->get('days', 30));

        $today = now()->toDateString();
        $soonDate = now()->addDays($days)->toDateString();

        $expired = Batch::with(['medicine', 'supplier'])
            ->whereDate('expiry_date', '<', $today)
            ->orderBy('expiry_date')
            ->get();

        $expiringSoon = Batch::with(['medicine', 'supplier'])
            ->whereDate('expiry_date', '>=', $today)
            ->whereDate('expiry_date', '<=', $soonDate)
            ->orderBy('expiry_date')
            ->get();

        return Excel::download(
            new ExpiryAlertsExport($expired, $expiringSoon),
            "expiry-alerts-{$days}-days.xlsx"
        );
    }

    public function exportPdf(Request $request)
    {
        $days = (int) ($request->get('days', 30));

        $today = now()->toDateString();
        $soonDate = now()->addDays($days)->toDateString();

        $expired = Batch::with(['medicine', 'supplier'])
            ->whereDate('expiry_date', '<', $today)
            ->orderBy('expiry_date')
            ->get();

        $expiringSoon = Batch::with(['medicine', 'supplier'])
            ->whereDate('expiry_date', '>=', $today)
            ->whereDate('expiry_date', '<=', $soonDate)
            ->orderBy('expiry_date')
            ->get();

        $pdf = Pdf::loadView('reports.expiry-alerts', compact('expired', 'expiringSoon', 'days'));

        return $pdf->download("expiry-alerts-{$days}-days.pdf");
    }
}
