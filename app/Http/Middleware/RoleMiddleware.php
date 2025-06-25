<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login'); // Redirect ke halaman login jika belum login
        }

        $user = Auth::user(); // Dapatkan user yang sedang login

        // Cek apakah role user ada di dalam daftar role yang diizinkan untuk rute ini
        if (!in_array($user->role, $roles)) {
            // Jika role tidak diizinkan, tampilkan halaman 403 (Akses Ditolak)
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request); // Lanjutkan permintaan jika user memiliki role yang sesuai
    }
}
