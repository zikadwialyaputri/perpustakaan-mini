<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku'     => Book::count(),
            'totalKategori' => Category::count(),
            'totalUser'     => User::count(),
            'books'         => Book::latest()->get(),
        ]);
    }
}
