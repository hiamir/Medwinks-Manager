<?php

namespace App\View\Components\Molecules\Bootstrap;

use Illuminate\View\Component;

class ListGroup extends Component
{
    public $flush;
    public $class;
    public $number;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($flush,$class,$number)
    {
        $this->flush=$flush;
        $this->class=$class;
        $this->number=$number;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.list-group');
    }
}
