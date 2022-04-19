<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;

class InputArea extends Component
{
    public $xdata,$name;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xdata,$name)
    {
        $this->xdata=$xdata;
        $this->name=$name;
    }

    public function render()
    {
        return view('components.atoms.bootstrap.input-area');
    }
}
