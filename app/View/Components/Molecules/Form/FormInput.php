<?php

namespace App\View\Components\Molecules;

use App\Traits\Quicker;
use Illuminate\View\Component;

class FormInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $name;
    public $size='normal';
    public $container;
    public $type;
    public $icon;
    public $lazy=false;
    public $defer=true;
    public $debounce;
    public $label;
    public $placeholder;
    public $value;
    public $custom;
    public $class;



    use Quicker;


    public function __construct($id=null,$name=null,$type=null,$container=null,$placeholder=null,$size=null,$label=null,$icon=null,$lazy=null,$defer=null,
                                $debounce=null,$value=null,$custom=null,$class=null)
    {
        if ($id===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('id'),'error');
        }elseif($name===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('name'),'error');
        }elseif($class===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($type===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('type'),'error');
        }elseif($container===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('container'),'error');
        }elseif($placeholder===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('placeholder'),'error');
        }elseif($size===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('size'),'error');
        }elseif($label===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('label'),'error');
        }elseif($icon===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('icon'),'error');
        }elseif($type===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('type'),'error');
        }elseif($defer===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('defer'),'error');
        }elseif($debounce===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('debounce'),'error');
        }elseif($value===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('value'),'error');
        }elseif($custom===null) {
            $this->sweetalert($this->sweetAlertComponentTitle('Input'),$this->sweetAlertComponentMessage('custom'),'error');
        }else {
            $this->id = $id;
            $this->name = $name;
            $this->size = $size;
            $this->icon = $icon;
            $this->container = $container;
            $this->label = $label;
            $this->lazy = $lazy;
            $this->defer = $defer;
            $this->debounce = $debounce;
            $this->type = $type;
            $this->placeholder = $placeholder;
            $this->value = $value;
            $this->custom = $custom;
            $this->class = $class;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.form-input');
    }
}
