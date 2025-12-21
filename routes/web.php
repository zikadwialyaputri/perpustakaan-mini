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
Route::middleware(['auth'])->group(function () {
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
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {

        Route::get('/dashboard', [StaffDashboard::class, 'index'])
            ->name('dashboard');
    });
