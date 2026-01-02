<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Medicine extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'barcode',
        'category',
        'manufacturer',
        'min_stock',
    ];

    // Audit log options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('medicines')
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}
