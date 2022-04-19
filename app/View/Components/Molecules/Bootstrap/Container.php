<?php

namespace App\View\Components\Molecules\Bootstrap;

use App\Traits\Quicker;
use Illuminate\View\Component;

class Container extends Component
{
    use Quicker;
    public $class;
    public $fluid;
    public $custom;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class=null,$fluid=null,$custom=null)
    {
        if ($class===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Container'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($custom===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Container'),$this->sweetAlertComponentMessage('custom'),'error');
        }
        elseif($fluid===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Container'),$this->sweetAlertComponentMessage('fluid'),'error');
        }
        $this->class=$class;
        $this->fluid=$fluid;
        $this->custom=$custom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.container');
    }
}
