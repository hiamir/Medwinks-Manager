<?php

namespace App\View\Components\Atoms\Modal;

use Illuminate\View\Component;

class Header extends Component
{
    public $headerName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($headerName)
    {
        $this->headerName=$headerName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.header');
    }
}
