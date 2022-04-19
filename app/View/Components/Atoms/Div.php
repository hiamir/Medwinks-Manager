<?php

namespace App\View\Components\Atoms;

use Illuminate\View\Component;

class Div extends Component
{
    public $class;
    public $custom;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page=null,$class=null,$custom=null)
    {
       if($class===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($custom===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('custom'),'error');
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
        return view('components.atoms.div');
    }
}
