<?php

namespace App\Http\Livewire\Errors;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminForbidden extends Component
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
        return view('livewire.errors.admin-forbidden')->layout('layouts.app');
    }
}
