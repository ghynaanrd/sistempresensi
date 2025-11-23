<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login?
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user SAMA dengan role yang diminta?
        // (Misal: user 'admin' mencoba masuk halaman 'admin' -> BOLEH)
        if (Auth::user()->role == $role) {
            return $next($request);
        }

        // 3. Kalau role beda, tendang balik (Unauthorized)
        abort(403, 'Anda tidak punya akses ke halaman ini!');
    }
}