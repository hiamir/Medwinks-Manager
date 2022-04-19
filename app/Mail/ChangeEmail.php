<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
public $name,$email,$omjEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$omjEmail,$email)
    {
        $this->name=$name;
        $this->email=$email;
        $this->omjEmail=$omjEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->omjEmail)->subject('Email Changed')->view('emails.ChangeEmail',['name'=>$this->name,'email'=>$this->email]);
    }
}
