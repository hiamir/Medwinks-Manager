<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
//        $role_name=Role::where('id',Auth::user()->role_id)->first()->name;

        return view('dashboard');
    }
}
