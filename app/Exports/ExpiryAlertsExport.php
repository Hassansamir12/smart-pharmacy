<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpiryAlertsExport implements FromCollection, WithHeadings
{
    public function __construct(
        public Collection $expired,
        public Collection $expiringSoon
    ) {}

    public function headings(): array
    {
        return ['Type', 'Medicine', 'Supplier', 'Batch No', 'Expiry Date', 'Qty'];
    }

    public function collection()
    {
        $expiredRows = $this->expired->map(function ($b) {
            return [
                'Expired',
                $b->medicine->name,
                $b->supplier?->name ?? '',
                $b->batch_no ?? '',
                $b->expiry_date,
                $b->quantity,
            ];
        });

        $soonRows = $this->expiringSoon->map(function ($b) {
            return [
                'Expiring Soon',
                $b->medicine->name,
                $b->supplier?->name ?? '',
                $b->batch_no ?? '',
                $b->expiry_date,
                $b->quantity,
            ];
        });

        return $expiredRows->concat($soonRows)->values();
    }
}
