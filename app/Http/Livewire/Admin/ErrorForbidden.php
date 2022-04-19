<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ErrorForbidden extends Component
{
    public $route;
    public $message;
    public $viewname = "Error";

    public function boot(){
    }

    public function logout(){
        if(auth()->guard('admin')->check()){
            Auth::logout();
            return redirect(route('admin.login'));
        }else{
            Auth::logout();
            return redirect(route('login'));
        }


    }

    public function render()
    {
        return view('livewire.error-forbidden')->layout('layouts.app');
    }
}
