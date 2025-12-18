<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;

Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboard::class, 'index'])
        ->name('dashboard');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    // Halaman List Peminjaman
    Route::get('/staff/peminjaman', [PeminjamanController::class, 'index'])->name('staff.peminjaman');

    // Fitur Operasional Staff
    Route::post('/staff/peminjaman/validasi/{id}', [PeminjamanController::class, 'validasi'])->name('staff.validasi');
    Route::post('/staff/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembali'])->name('staff.kembali');
}); // Pastikan ada penutup }); di sini!

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('/books', BookController::class);
Route::prefix('admin')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});

