<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role !== $role) {
            // Jika pembeli tersesat ke halaman penjual, arahkan ke toko
            if ($request->user()->role === 'pembeli') {
                return redirect()->route('store.index')->with('error', 'Akses Ditolak: Halaman tersebut khusus Penjual.');
            }
            // Jika penjual tersesat ke halaman lain, arahkan ke dashboard
            if ($request->user()->role === 'penjual') {
                return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda sudah login sebagai Penjual.');
            }
            
            abort(403, 'Akses Ditolak - Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
