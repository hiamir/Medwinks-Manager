<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo()
    {
        switch(Auth::user()->role_id){
            case 1:
                return route(RouteServiceProvider::SUPERADMIN);
                break;
            case 2:
                return route(RouteServiceProvider::ADMIN);
                break;
            case 3:
                return route(RouteServiceProvider::DASHBOARD);
                break;
            case 4:
                return route(RouteServiceProvider::DASHBOARD);
                break;
            case 5:
                return route(RouteServiceProvider::DASHBOARD);
                break;
            case 6:
                return route(RouteServiceProvider::DASHBOARD);
                break;
            default:
                return route(RouteServiceProvider::HOME);
        }
        // return $next($request);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
