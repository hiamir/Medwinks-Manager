<?php

namespace App\View\Components\Atoms\Modal;

use Illuminate\View\Component;

class Label extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $labelFor='';
    public $labelName='';
    public function __construct($labelFor,$labelName)
    {
        $this->labelFor = $labelFor;
        $this->labelName=$labelName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.label');
    }
}
