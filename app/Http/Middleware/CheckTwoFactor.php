<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTwoFactor
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
        $user = auth()->user();

        if (Auth::check()) {

            $user = auth()->user();
            if ((isset($user->two_factor_code))&&(isset($user->two_factor_expires_at)) && isset($user->email_verified_at)) {
//                return redirect()->back();

                (Auth::guard('admin')->check()) ? $route = 'admin.dashboard' : $route = 'dashboard';

                return redirect(route($route));

            }else{

                return $next($request);
//                return redirect(route('admin.sendtwofactor'));
            }
        } else {
            (Auth::guard('admin')->check()) ? $route = 'admin.login' : $route = 'login';
            return redirect(route('admin.login'));
        }

    }
}
