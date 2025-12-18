<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        return view('staff.dashboard', [
            'totalBuku' => Book::count(),
        ]);
    }
}
