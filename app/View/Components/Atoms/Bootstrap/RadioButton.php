<?php

namespace App\View\Components\Atoms\Bootstrap;

use App\Traits\Quicker;
use Illuminate\View\Component;

class RadioButton extends Component
{
    use Quicker;
    public $label;
    public $name;
    public $text;
    public $id;
    public $class;
    public $customID;
    public $debounce;
    public $lazy;
    public $defer;
    public $listdata;
    public $click;
    public $parentName;
    public $childName;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($label=null,$name=null,$debounce=null, $class=null, $lazy=null,$defer=null, $id=null,$customID=null,$text=null,$listdata=null,$click=null,$parentName=null,$childName=null)
    {
        if ($id===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('id'),'error');
        }elseif($customID===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('customID'),'error');
        }elseif($name===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('name'),'error');
        }elseif($label===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('label'),'error');
        }elseif($text===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('text'),'error');
        }elseif($lazy===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('lazy'),'error');
        }elseif($defer===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('defer'),'error');
        }elseif($class===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('class'),'error');
        }elseif($listdata===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('listdata'),'error');
        }elseif($click===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('click'),'error');
        }elseif($parentName===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('parentName'),'error');
        }elseif($childName===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('childName'),'error');
        }


        $this->label=$label;
        $this->name=$name;
        $this->id=$id;
        $this->customID=$customID;
        $this->text=$text;
        $this->debounce=$debounce;
        $this->lazy=$lazy;
        $this->defer=$defer;
        $this->class=$class;
        $this->click=$click;
        $this->parentName=$parentName;
        $this->childName=$childName;
        $this->listdata=$listdata;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.radioButton');
    }
}
