<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class openpage extends Component
{
    protected $listeners=['view'];

    public function view($layout){
        dd($layout);
    }
    public function render()
    {
        return view('livewire.'.$this->view)->layout('layouts.'.$this->layout);
    }
}
