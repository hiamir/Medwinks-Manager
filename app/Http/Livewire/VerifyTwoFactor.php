<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyTwoFactor extends Component
{
    public $datatext = "";
    public $user;
    public $alert='';
    public $message='';
    public $verification_code;


    public function boot()
    {
        $this->user=Auth::user();
        ($this->user->two_factor_expires_at < now())? $this->message="Your Two Factor Code expired. Please resend": $this->message='';

    }

    public function inputext()
    {
        $this->datatext = $this->text;
    }

    public function logout()
    {
        Auth::logout();
        $this->emit('redirect', '/login');
    }

    public function verify()
    {
        if (Auth::guard('web')->check()) {
            $two_factor_code = auth()->user()->two_factor_code;
            $this->message="";
            if (($this->verification_code)===strval($two_factor_code)) {
                $user = Auth::user();
                $user->email_verified_at = now();
                $user->save();
                return redirect(route('user.dashboard'));
            } else {
                ($this->user->two_factor_expires_at < now())? $this->message="Your Two Factor Code expired. Please resend": $this->message='Your Two Factor Code do not match';

//                redirect()->route('verifytwofactor')->with('message', 'Two factor code did not match');
//                return redirect(route('verifytwofactor'))->with('message', 'Two factor code did not match');
            }
        }
    }

    public function resendcode()
    {
        $this->emit('redirect', '/sendtwofactor');
    }

    public function render()
    {

        return view('livewire.verifytwofactor')->layout('layouts.app');
    }
}
