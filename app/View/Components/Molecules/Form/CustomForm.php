<?php

namespace App\View\Components\Molecules\Form;

use Illuminate\View\Component;

class CustomForm extends Component
{
    public $showButton;
    public $name;
//    public $type;
    public $id;
//    public $size;
    public $scroll;
    public $buttonSubmitName;
    public $buttonName;
//    public $buttonRound;
//    public $buttonIcon;
//    public $buttonColor;
//    public $buttonWidth;
//    public $buttonClass;
//    public $buttonDisabled;
//    public $buttonTextColor;
//    public $passingData;
//    public $custom;
public $close;
public $footer;
public $footerClass;
    public $xdata;
//    public $mydata;
    public $xinit;

    /**
     * Create a new component instance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __construct(
        $showButton,
        $name,
//        $type,
        $id,
        $buttonSubmitName,
//        $buttonIcon,
//        $size,
//        $custom,
//        $buttonColor,
//        $passingData,
//        $buttonTextColor='',
//        $buttonClass='',
//        $buttonDisabled='',
//        $buttonWidth='',
//        $scroll="modal-scroll",
//        $buttonRound = null,
        $close=null,
        $footer=null,
        $footerClass=null,
        $buttonName = null,
        $xdata=null,
        $mydata=null,
        $xinit=null
    )
    {

        $this->showButton = $showButton;
        $this->name = $name;
//        $this->type = $type;
        $this->id = $id;
//        $this->size = $size;
//        $this->scroll = $scroll;
        $this->buttonSubmitName = $buttonSubmitName;
        $this->buttonName = $buttonName;
//        $this->buttonIcon = $buttonIcon;
//        $this->buttonColor = $buttonColor;
//        $this->buttonTextColor = $buttonTextColor;
//        $this->buttonWidth = $buttonWidth;
//        $this->buttonClass = $buttonClass;
//        $this->buttonRound = $buttonRound;
//        $this->passingData = $passingData;
//        $this->buttonDisabled = $buttonDisabled;
//        $this->custom = $custom;
        $this->close=$close;
        $this->footer=$footer;
        $this->footerClass=$footerClass;
        $this->xdata = $xdata;
//        $this->mydata = $mydata;
        $this->xinit = $xinit;
    }
    public function render()
    {
        return view('components.molecules.form.custom-form');
    }
}
