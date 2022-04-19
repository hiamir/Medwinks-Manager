<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;

class InputDate extends Component
{
    public $xdata, $name,$config;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xdata, $name,$config)
    {
        $this->xdata = $xdata;
        $this->config=$config;
        $this->name = $name;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.input-date');
    }
}
