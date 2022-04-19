<?php

namespace App\Http\Livewire\Errors;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Forbidden extends Component
{
    public $route;
    public $message;
    public $pageName = "Error";

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
        return view('livewire.errors.forbidden')->layout('layouts.app');
    }
}
