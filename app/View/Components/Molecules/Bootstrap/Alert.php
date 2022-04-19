<?php

namespace App\View\Components\Molecules\Bootstrap;

use Illuminate\View\Component;
use App\Traits\Quicker;

class Alert extends Component
{
    use Quicker;
    public $bgColor;
    public $txtColor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bgColor=null,$txtColor=null)
    {
        if ($bgColor===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Column'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($txtColor===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Column'),$this->sweetAlertComponentMessage('custom'),'error');
        }
        $this->bgColor=$bgColor;
        $this->txtColor=$txtColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.alert');
    }
}
