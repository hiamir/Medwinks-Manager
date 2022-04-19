<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\User;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Quicker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Throwable;


class Register extends Component
{
    use FormValidation;
    use Quicker;
    public $form = ['name', 'email', 'password', 'password_confirmation'];
    protected $validate;

    public function boot()
    {
    }

    public function updated($field)
    {
        $this->formValidation($this,'registration', ['form.email']);

    }

    public function register()
    {
        $this->formValidation($this,'registration', ['form.name', 'form.email', 'form.password', 'form.password_confirmation']);



        try {
            DB::transaction(function ()  {
                $password = Hash::make($this->form['password']);
            $user = User::create([
                'name' => $this->form['name'],
                'email' => $this->form['email'],
                'password' => $password,
                'two_factor_code' => Quicker::generate_two_factor_code(),
                'two_factor_expires_at' => Quicker::generate_two_factor_expiry()
            ]);
            $name=$user->name;
            $email=$user->email;
            $twoFactorCode=$this->resetTwoFactorCode($user);

            Mail::to($email)->send(new \App\Mail\Welcome($name,config('app.admin_email')));
            Mail::to($email)->send(new \App\Mail\SendTwoFactor($name, config('app.admin_email'), $twoFactorCode));
            session()->flush();
            return redirect(route('login'))->with('alert', ['type'=>'success','message'=>'Your registration was successfully!']);
            });
        } catch (Throwable $e) {

                $alert = 'error';
                $message = Data::capitalize_first_word('Update Error! Please contact administrator');

            DB::rollback();
            Quicker::toastr($this, 'error', $e.'Something went wrong, contact administrator');
            return false;
        }


    }


    public function render()
    {

        return view('livewire.register')->layout('layouts.app');
    }
}
