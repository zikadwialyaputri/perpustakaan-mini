<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;

//auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//books
// Cari bagian ini di web.php Anda dan pastikan seperti ini:
Route::middleware(['auth'])->group(function () {
    // Ini akan mencakup index, create, store, edit, update, DAN destroy
    Route::resource('books', BookController::class); 
});
//admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
    });

//staff
// Baris 36-44 (Blok Route Group untuk Staff)
Route::middleware(['auth', 'role:staff']) // Proteksi login & role staff
    ->prefix('staff')                     // Menambahkan /staff/ di URL
    ->name('staff.')                      // Memberikan prefix 'staff.' pada nama route
    ->group(function () {

        // Baris 41-42 (Halaman Utama Staff)
        Route::get('/dashboard', [StaffDashboard::class, 'index'])
            ->name('dashboard');          // Nama lengkap route: staff.dashboard
    });
