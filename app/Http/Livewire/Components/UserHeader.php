<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class UserHeader extends Component
{
    public $viewname;
    protected $listeners=['updateProfile'=>'$refresh'];

    public function mount($viewname){
        $this->viewname=$viewname;
        $this->emit('pagename',$viewname);
    }


    public function render()
    {

        return view('livewire.components.user-header');
    }
}
