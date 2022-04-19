<?php

namespace App\View\Components\Atoms\Bootstrap;

use Illuminate\View\Component;
use App\Traits\Quicker;

class Select extends Component
{
    use Quicker;

    public $list;
    public $name;
    public $class;
    public $label;
    public $id;
    public $firstvalue;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name=null,$class=null, $label=null,$id=null, $placeholder=null,$firstvalue=null,$list=null)
    {
        if ($list===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('list'),'error');
        }elseif($name===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('name'),'error');
        }elseif($id===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('id'),'error');
        }elseif($label===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('label'),'error');
        }elseif($class===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($firstvalue===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('firstvalue'),'error');
        }elseif($placeholder===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Select'),$this->sweetAlertComponentMessage('placeholder'),'error');
        }



        $this->list = $list;
        $this->name = $name;
        ($class == '') ? $this->class = "p-0 mb-4" : $this->class = $class;
        $this->label = $label;
        $this->id = $id;
        $this->firstvalue=$firstvalue;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.select');
    }
}
