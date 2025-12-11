<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard-test', function () {
    return view('dashboard');
});
Route::get('/dashboard', function(){
    return view('dashboard');
});
Route::resource('/books', BookController::class);
