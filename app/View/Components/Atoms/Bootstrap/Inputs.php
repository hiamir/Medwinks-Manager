<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;

class Inputs extends Component
{
    public $xdata,$xinit,$name;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xdata,$xinit,$name)
    {
        $this->xdata=$xdata;
        $this->xinit=$xinit;
        $this->name=$name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.inputs');
    }
}
