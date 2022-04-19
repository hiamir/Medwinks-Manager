<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTwoFactor extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
protected $name, $email,$twoFactorCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$twoFactorCode)
    {

       $this->name=$name;
       $this->email=$email;
        $this->twoFactorCode=$twoFactorCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from($this->email,'OMJ Manager')->subject('Two factor verification code')->view('emails.SendTwoFactor',['name'=>$this->name,'code'=>$this->twoFactorCode]);
    }
}
