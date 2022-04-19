<?php

namespace App\View\Components\Atoms\Modal;

use App\Traits\Quicker;
use Illuminate\View\Component;

class Checkbox extends Component
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
    public $checked;
    public $data;
    public $listdata;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($label=null,$name=null,$debounce=null, $class=null, $lazy=null,$defer=null, $id=null,$customID=null,$text=null,$checked=null,$data=null,$listdata=null)
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
        }elseif($checked===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('checked'),'error');
        }elseif($lazy===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('lazy'),'error');
        }elseif($defer===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('defer'),'error');
        }elseif($data===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('data'),'error');
        }elseif($class===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('class'),'error');
        }
        elseif($listdata===null) {
            Quicker::sweetalert($this->sweetAlertComponentTitle('checkbox'),$this->sweetAlertComponentMessage('listdata'),'error');
        }


        $this->label=$label;
        $this->name=$name;
        $this->id=$id;
        $this->customID=$customID;
        $this->text=$text;
        $this->checked=$checked;
        $this->debounce=$debounce;
        $this->lazy=$lazy;
        $this->defer=$defer;
        $this->data=$data;
        $this->class=$class;
        $this->listdata=$listdata;
//        ($customID!='') ? $this->id=$customID : $this->customID=$customID;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.checkbox');
    }
}
