<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini jika auth() merah

class RoleMiddleware
{
  public function handle(Request $request, Closure $next, $role): Response
{
    // Menggunakan Auth facade biasanya menghilangkan garis merah di VS Code
    if (Auth::check() && Auth::user()->role == $role) {
        return $next($request);
    }

    return redirect('/dashboard-test')->with('error', 'Anda tidak memiliki hak akses.');
}
}
