<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $books     = Book::latest()->get();
        $totalBuku = $books->count();

        return view('staff.dashboard', compact('books', 'totalBuku'));
    }
}
