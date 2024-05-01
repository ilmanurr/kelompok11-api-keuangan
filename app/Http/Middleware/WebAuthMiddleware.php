<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah ada pengguna yang diotentikasi
        if (Auth::check()) {
            // Jika ada, dapatkan model pengguna dan perbarui waktu login terakhir
            $user = Auth::user();
            $user->last_login = now();
            /** @var \App\Models\User $user **/
            $user->save();
            return $next($request);
        } else {
            // Jika tidak ada, arahkan pengguna ke halaman login
            return redirect()->route('login');
        }
    }
}