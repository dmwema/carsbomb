<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthPlayer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('auth')) {
            return $next($request);
        }
        return redirect()->route('public.login');
    }
}
