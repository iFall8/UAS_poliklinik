<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek dulu apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil data pengguna yang sedang login
        $user = Auth::user();

        // 3. Periksa apakah peran pengguna ada di dalam daftar peran yang diizinkan
        if (in_array($user->role, $roles)) {
            // Jika peran sesuai, izinkan akses
            return $next($request);
        }

        // 4. Jika tidak, tolak akses
        abort(403, 'ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI');
    }
}
