<?php

namespace App\Http\Livewire\Admin;

use App\Traits\Quicker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;


class SendTwoFactor extends Component
{
    use Quicker;
    protected $listeners=['resendcode'=>'resend'];

    public $disablebutton='false';

    public function resend($link){
        dd($link);
    }

    public function mount(){
        $user=Auth::user();
        ($user->two_factor_expires_at < now())? $this->message="Your Two Factor Code expired. Please resend": $this->message='';
        $this->disablebutton = 'false';
    }

    public function logout(){
        Auth::logout();
        return redirect(route('admin.login'));
//        $this->emit('redirect', '/admin/login');
    }

    public function verify_code(){
        return redirect(route('admin.verifytwofactor'));
    }

    public function emailcode(){
        try{
            DB::transaction(function () {
                $name = auth()->user()->name;
                $email = auth()->user()->email;
                $user = Auth()->user();
                $twoFactorCode = $this->resetTwoFactorCode($user);

                $this->disablebutton = 'true';
                Mail::to('omj@admin.com')->send(new \App\Mail\SendTwoFactor($name, $email, $twoFactorCode));
                $this->emit('redirect', '/admin/verifytwofactor');
            });
        }
        catch(Throwable $e){
            DB::rollback();
            $this->disablebutton = 'false';
            Quicker::toastr($this,'error','Error sending email. Please contact administrator');
            return false;
        }



    }
    public function render()
    {
        return view('livewire.admin.sendtwofactor')->layout('layouts.app');
    }
}
