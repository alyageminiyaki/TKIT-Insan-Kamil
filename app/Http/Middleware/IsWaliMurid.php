<?php

// app/Http/Middleware/IsWaliMurid.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsWaliMurid
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login DAN perannya adalah 'walimurid'
        if (auth()->check() && auth()->user()->role == 'walimurid') {
            return $next($request);
        }
        // Jika tidak, tolak akses
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
