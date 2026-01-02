<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ExpiryAlertController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuditLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Staff/Admin Pharmacy (CRUD)
    Route::resource('medicines', MedicineController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('batches', BatchController::class);

    // Alerts
    Route::get('/alerts/expiry', [ExpiryAlertController::class, 'index'])
        ->name('alerts.expiry');

    Route::get('/alerts/expiry/export/excel', [ExpiryAlertController::class, 'exportExcel'])
        ->name('alerts.expiry.export.excel');

    Route::get('/alerts/expiry/export/pdf', [ExpiryAlertController::class, 'exportPdf'])
        ->name('alerts.expiry.export.pdf');

  
});

// Admin only (user management + audit logs)
Route::middleware(['auth', 'can:manage-users'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin users
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::put('/users/{user}/role', [AdminUserController::class, 'updateRole'])
            ->name('users.role');

        // Audit logs
        Route::get('/audit-logs', [AuditLogController::class, 'index'])
            ->name('audit-logs.index');
    });

require __DIR__ . '/auth.php';
