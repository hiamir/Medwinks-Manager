<?php

namespace App\View\Components\Molecules\Modal;

use Illuminate\View\Component;

class Form extends Component
{
    public $wireSubmitPrevent;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($wireSubmitPrevent,$class)
    {
        $this->wireSubmitPrevent=$wireSubmitPrevent;
        $this->class=$class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.modal.form');
    }
}
