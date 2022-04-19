<?php

namespace App\View\Components\Molecules\Modal;
use Illuminate\View\Component;

class Content extends Component
{
    public $class,$xdata;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class=null,$xdata=null)
    {
        $this->class=$class;
        $this->xdata=$xdata;
//        $this->userID=$userID;
//        $this->modelID=$modelID;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.modal.content');
    }
}
