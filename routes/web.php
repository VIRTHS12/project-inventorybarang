<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\AuditController;

// Halaman utama akan mengarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk proses Otentikasi
Route::get('login', [LoginController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [LoginController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Grup rute untuk admin yang sudah login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');

    // Resource Controller untuk CRUD Barang (ini yang diminta dosen!)
    Route::resource('barang', BarangController::class);

    Route::get('audit', [AuditController::class, 'index'])->name('audit.index');
    Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPDF'])->name('dashboard.export');


    // Route tambahan untuk bulk operations
    Route::delete('barang/bulk-delete', [BarangController::class, 'bulkDelete'])->name('barang.bulk-delete');
});
