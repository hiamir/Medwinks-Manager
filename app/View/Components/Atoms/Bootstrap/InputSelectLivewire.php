<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;

class InputSelectLivewire extends Component
{
    public $id,$label,$name,$placeholder,$dataList;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,$label,$name,$placeholder,$dataList)
    {
        $this->id=$id;
        $this->label=$label;
        $this->name=$name;
        $this->placeholder=$placeholder;
        $this->dataList=$dataList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.input-select-livewire');
    }
}
