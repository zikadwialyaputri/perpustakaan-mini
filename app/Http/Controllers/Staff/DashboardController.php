<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $books     = Book::latest()->paginate(16);
        $totalBuku = Book::count();

        return view('staff.dashboard', compact('books', 'totalBuku'));
    }
}
