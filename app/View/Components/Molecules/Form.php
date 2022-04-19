<?php

namespace App\View\Components\Molecules;

use Illuminate\View\Component;

class Form extends Component
{
    public $action,$method='',$submit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($submit,$action=null,$method=null)
    {
        $this->action=$action;
        $this->method=$method;
        $this->submit=$submit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.form');
    }
}
