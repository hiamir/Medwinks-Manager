<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;

class InputFile extends Component
{
    public
    $name,
      $xdata,
    $configFile;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xdata,$name,$configFile
//        $configDate,$xdata, $configFile
    )
    {
        $this->name=$name;
//        $this->configDate=$configDate;
        $this->xdata=$xdata;
        $this->configFile=$configFile;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.input-file');
    }
}
