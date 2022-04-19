<?php

namespace App\View\Components\Atoms\Modal;

use App\Traits\Quicker;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\View\Component;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Highlight extends Component
{
    public $id;
    public $name;
    public $class;
    public $background;

    use Quicker;

    /**
     * Create a new component instance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __construct($id=null, $name=null, $background=null,$class=null)
    {
        if ($id===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('highlight'),$this->sweetAlertComponentMessage('id'),'error');
        }elseif($name===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('highlight'),$this->sweetAlertComponentMessage('name'),'error');
        }elseif($class===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('highlight'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($background===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('highlight'),$this->sweetAlertComponentMessage('background'),'error');
        }else {
            $this->background = $background;
            $this->name = $name;
            $this->class = $class;
            $this->id = $id;
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.highlight');
    }
}

