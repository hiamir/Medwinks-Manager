<?php

namespace App\Http\Livewire;

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
public $alert='';
public $message='';
    public $disablebutton='false';



    public function mount(){
        $user=Auth::user();
        ($user->two_factor_expires_at < now())? $this->message="Your Two Factor Code expired. Please resend": $this->message='';
        $this->disablebutton = 'false';
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function verify_code(){
        return redirect(route('verifytwofactor'));
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
                redirect()->route('verifytwofactor');
//                $this->emit('redirect', '/verifytwofactor');
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
        return view('livewire.sendtwofactor')->layout('layouts.app');
    }
}
