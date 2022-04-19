<?php

namespace App\Http\Livewire\Components;


use Livewire\Component;

class AdminHeader extends Component
{
    public $pageName=null;
    protected $listeners = ['updateProfile' => '$refresh'];

    public function mount($pageName){
        $this->pageName=$pageName;
        $this->emit('pageName',$pageName);
    }

    public function render()
    {
        return view('livewire.components.admin-header');
    }
}
