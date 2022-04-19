<?php

namespace App\View\Components\Molecules\Bootstrap;

use App\Traits\Quicker;
use Illuminate\View\Component;

class Row extends Component
{
    use Quicker;
    public $class;
    public $custom;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class=null,$custom=null)
    {
        if ($class===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Row'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($custom===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Row'),$this->sweetAlertComponentMessage('custom'),'error');
        }
        $this->class=$class;
        $this->custom=$custom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.row');
    }
}
