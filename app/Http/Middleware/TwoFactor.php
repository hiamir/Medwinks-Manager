<?php

namespace App\Http\Middleware;

use App\Traits\Quicker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = auth()->user();
        if (Auth::check() && !Quicker::validateMySQLTimeStamp($user->blocked)) {


            if ((isset($user->two_factor_code)) && (isset($user->two_factor_expires_at)) && !isset($user->email_verified_at)) {

                if (($user->email_verified_at) === null) {

                    if ($user->two_factor_expires_at < (now())) {
//                        dd('hello');
                        (Auth::guard('admin')->check()) ? $isAdmin = true : $isAdmin = false;
                        if ($isAdmin) {

//                    return response()->view('livewire.admin.verifytwofactor');
//                    auth()->logout();
//                    return $next($request);
                            return redirect()->route('admin.sendtwofactor')->with('message', 'Your Two Factor Code expired. Please resend');
                        }
                        if(Auth::guard('web')->check()){
                            $this->message="Hellp";
//                            return redirect()->route('sendtwofactor')->with('message', 'Your Two Factor Code expired. Please resend');
                        }

//                    return redirect()->route('admin.verifytwofactor');
//                    return redirect()->to('/admin/verifytwofactor');
//                    return redirect()->route('admin.login')->withMessage('The two factor code has expired. Please login again.');
                    } else {

                        (Auth::guard('admin')->check()) ? $isAdmin = true : $isAdmin = false;
//                        if ($isAdmin) {
//                            return redirect(route('admin.verifytwofactor'));
//                        }
//                        if(Auth::guard('web')->check()){
//                            return redirect()->route('verifytwofactor');
////                            return redirect(route('verifytwofactor'));
//                        }
//                    return redirect()->route('login') ->withMessage('The two factor code has expired. Please login again.');
                    }
                }
//
//                $user->resetTwoFactorCode();
            }
            elseif ((isset($user->two_factor_code)) && (isset($user->two_factor_expires_at)) && isset($user->email_verified_at)) {
//                return redirect()->route('admin.dashboard');
                return $next($request);
            }

            else {
                return redirect()->route('admin.sendtwofactor')->with('message', 'Two Factor Verification Error! Please verify your email.');
//            return redirect()->intended('admin/main');
            }

        }

        else{
            Auth::logout();
            return redirect()->intended('admin/login');
        }

//            if(!$request->is('verify*'))
//            {
////                return view('livewire.verifytwofactor')->layout('layouts.app');
//                return redirect()->route('verifytwofactor');
////                return redirect()->route('verify.index');
//            }
//        }

        return $next($request);
    }
}
//echo "
//<script>
// document.addEventListener('livewire:load', function (event) {
//        window.livewire.on('redirect', param => {
//            Turbolinks.visit(param)
//        })
//    })
//</script>
//";
