<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckGuard
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
        if (Auth::guard('admin')->check()) {

            if (Auth::getDefaultDriver() === 'admin') {

                return $next($request);
            } else {
//                return Redirect::back();
                return redirect()->route('admin.dashboard');
            }
        } else {
            if (Auth::getDefaultDriver() === 'web') {
                return $next($request);
            } else {
//                return Redirect::back();
                return redirect()->route('user.dashboard');
            }
        }

    }
}
