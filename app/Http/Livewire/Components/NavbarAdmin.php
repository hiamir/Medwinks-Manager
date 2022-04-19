<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class navbaradmin extends Component
{
    public $view;
    public $layout;
    public $name;


protected $listeners=['pagename'];

public function mount(){
}

public function pagename($name){
   $this->name=$name;
}

    public function render()
    {
//        if($this->view !='' && $this->layout !=''){
//            return view('livewire.'.$this->view);
//        }
//        else{
            return view('livewire.components.navbaradmin');
//        }

    }
}
