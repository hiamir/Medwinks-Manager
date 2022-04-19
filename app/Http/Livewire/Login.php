<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\User;
use App\Traits\FormValidation;
use App\Traits\Quicker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    use FormValidation;
    use Quicker;
    public $form = [
        'email', 'password'
    ];
    public $alert = '';
    protected $isEmailVerified = false;

    public function boot()
    {
        Session::forget('error');

    }

    public function login()
    {

        $this->formValidation($this,'login', ['form.email', 'form.password']);

        try {
            DB::transaction(function () {
                $credentials = [
                    'email' => $this->form['email'],
                    'password' => $this->form['password'],
                ];
                if (Auth::guard('web')->attempt($credentials)) {
                    session()->regenerate();

                    $user = User::whereEmail($credentials['email'])->first();

                    if(Quicker::validateMySQLTimeStamp($user->blocked)){
                        Auth::logout();

                        Quicker::toastr($this, 'error', 'Your account is blocked, Contact Administrator!');
                    }else  if (empty($user->email_verified_at)) {
                        return redirect(route('verifytwofactor'));
                    } else {
                        return redirect(route('user.dashboard'));
                    }
                } else {
                    Quicker::toastr($this, 'error', 'Username or Password incorrect!');
                }
            });
        } catch (Throwable $e) {
            DB::rollback();
            Quicker::toastr($this, 'error', $e.'Login Error! Please contact administrator');
            return false;
        }
    }
    public function render()
    {

        return view('livewire.login')->layout('layouts.app');
    }
}
