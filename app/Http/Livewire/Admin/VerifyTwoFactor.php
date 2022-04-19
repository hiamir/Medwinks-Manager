<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyTwoFactor extends Component
{
    public $datatext = "";
    public $verification_code;


    public function mount()
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
        return redirect()->route('admin.login');
//        $this->emit('redirect', '/admin/login');
    }

    public function verify()
    {
        if (Auth::guard('admin')->check()) {
            $two_factor_code = auth()->user()->two_factor_code;

            if (($this->verification_code)===strval($two_factor_code)) {
                $user = Auth::user();
                $user->email_verified_at = now();
                $user->save();
                return redirect(route('admin.dashboard'));
            } else {
                ($this->user->two_factor_expires_at < now())? $this->message="Your Two Factor Code expired. Please resend": $this->message='Your Two Factor Code do not match';
            }
        }
    }

    public function resendcode()
    {
        $this->emit('redirect', '/admin/sendtwofactor');
    }

    public function render()
    {

        return view('livewire.admin.verifytwofactor')->layout('layouts.app');
    }
}
