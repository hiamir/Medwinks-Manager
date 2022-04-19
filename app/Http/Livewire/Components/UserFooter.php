<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class userfooter extends Component
{
    public $copyright="© 2021 OMJ. All Rights Reserved";
    public function render()
    {
        return view('livewire.components.user-footer');
    }
}
