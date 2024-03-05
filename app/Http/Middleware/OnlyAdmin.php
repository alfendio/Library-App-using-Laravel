<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // beri tau apa yang harus dilakukan jika yang login bukan admin
        if(Auth::user()->role_id != 1) {
            return redirect('books');
        }

        // yang middleware lakukan jika akun yang login adalah admin
        return $next($request);
    }
}
