<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class sessionmessagetoastr extends Component
{
    public function render()
    {
        return view('livewire.components.session-message-toastr')->layout('layouts.auth');
    }
}
