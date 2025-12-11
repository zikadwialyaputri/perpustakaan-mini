<?php
namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalBuku'  => Book::count(),
            'totalStaff' => User::where('role', 'staff')->count(),
        ]);
    }
}
