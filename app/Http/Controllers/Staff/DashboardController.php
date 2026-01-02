<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
                return view('staff.dashboard', [
            'totalBuku' => Book::count(),
        ]);
        $books     = Book::latest()->get();
        $totalBuku = $books->count();

        return view('staff.dashboard', compact('books', 'totalBuku'));
    }
}

