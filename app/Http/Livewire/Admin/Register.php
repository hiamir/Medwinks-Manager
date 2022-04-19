<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Traits\FormValidation;
use App\Traits\Quicker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Throwable;


class register extends Component
{
    use FormValidation;
    use Quicker;
    public $form = ['name', 'admin-email', 'password', 'password_confirmation'];
    protected $validate;

    public function boot()
    {
    }

    public function updated($field)
    {
       $this->formValidation($this,'registration', ['form.admin-email']);

    }

    public function register()
    {
         $this->formValidation($this,'registration', ['form.name', 'form.admin-email', 'form.password', 'form.password_confirmation']);

        $password = Hash::make($this->form['password']);

        try {
            $admin = Admin::create([
                'name' => $this->form['name'],
                'email' => $this->form['admin-email'],
                'password' => $password,
                'two_factor_code' => Quicker::generate_two_factor_code(),
                'two_factor_expires_at' => Quicker::generate_two_factor_expiry()
            ]);
            $name=$admin->name;
            $email=$admin->email;
            $user=$admin;
            $twoFactorCode=$this->resetTwoFactorCode($user);

//            Session::put('alert', ['type'=>'success','message'=>'Your registration was successfullly!']);
//
//            $this->emit('alert', ['success', 'Record has been updated']);
//            $this->emit('redirect', '/admin/login');
            Mail::to($email)->send(new \App\Mail\Welcome($name,config('app.admin_email')));
            Mail::to($email)->send(new \App\Mail\SendTwoFactor($name, config('app.admin_email'), $twoFactorCode));
            session()->flush();
            return redirect(route('admin.login'))->with('alert', ['type'=>'success','message'=>'Your registration was successfullly!']);
        } catch (Throwable $e) {
            if ($admin) {
                $admin->delete();
            }
            Quicker::toastr($this, 'error', 'Something went wrong, contact administrator');
            return false;
        }


    }


    public function render()
    {

        return view('livewire.admin.register')->layout('layouts.app');
    }
}
