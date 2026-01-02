<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

//edit profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

//guest
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//books
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
});
Route::get('/books/{book}', [BookController::class, 'show'])
    ->name('books.show');
Route::resource('books', BookController::class)->only(['show']);

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

    
