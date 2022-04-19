<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class inputerror extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.components.input-error');
    }
}
