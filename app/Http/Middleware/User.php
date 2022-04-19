<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
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
//        if (Auth::check() && Auth::user()->role == 1) {
//            return redirect()->route('superadmin');
//        }
//        elseif (Auth::check() && Auth::user()->role == 2) {
//
//            return redirect()->route('admin');
//        }
//        elseif (Auth::check() && Auth::user()->role == 3) {
//            return redirect()->route('medicaleditor');
//        }
//        elseif (Auth::check() && Auth::user()->role == 4) {
//            return redirect()->route('proofreader');
//        }
//        elseif (Auth::check() && Auth::user()->role == 5) {
//            return redirect()->route('layoutcheck');
//        }
//        elseif (Auth::check() && Auth::user()->role == 6) {
//            return redirect()->route('technicaleditor');
//        }
//        elseif (Auth::check() && Auth::user()->role == 7) {
//            return $next($request);
//        }
//
//        else {
//            return redirect()->route('login');
//        }
    }
}
