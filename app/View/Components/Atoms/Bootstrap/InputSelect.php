<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;

class InputSelect extends Component
{
    public $xdata,$name,$dataList;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xdata,$name,$dataList)
    {

        $this->name=$name;
        $this->xdata=$xdata;
        $this->dataList=$dataList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.input-select');
    }
}
