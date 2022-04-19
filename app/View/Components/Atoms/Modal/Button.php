<?php

namespace App\View\Components\Atoms\Modal;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $name;
    public $buttonName;
    public $id;
    public $buttonIcon;
    public $buttonColor;
    public $buttonTextColor;
    public $buttonWidth;
    public $buttonRound;
    public $passingData;
    public $buttonClass;
    public $buttonDisabled;
    public $custom;
    public $xdata;


    /**
     * Create a new component instance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __construct(
        $name,
        $type,
        $id,
        $buttonIcon,
        $buttonColor,
        $custom,
        $buttonTextColor = '',
        $buttonWidth = '',
        $buttonClass='',
        $buttonDisabled='',
        $passingData = null,
        $buttonRound = null,
        $buttonName = null,
        $xdata=null
    )
    {
//        if( empty($name) ||empty($type) || empty($buttonIcon) ||  empty($id) || empty($buttonColor)){
//            return redirect()->route('admin.dashboard')->with('componentAlert',
//                [
//                    'title' => 'Error!',
//                    'message' => 'Page Error!, Please contact Administrator!',
//                    'icon' => 'error'
//                ]);
//        } else {
        $this->type = $type;
        $this->name = $name;
        $this->buttonName = $buttonName;
        $this->id = $id;
        $this->buttonIcon = $buttonIcon;
        $this->buttonColor = $buttonColor;
        $this->passingData = $passingData;
        $this->buttonRound = $buttonRound;
        $this->buttonTextColor = $buttonTextColor;
        $this->buttonWidth = $buttonWidth;
        $this->buttonClass = $buttonClass;
        $this->buttonDisabled=$buttonDisabled;
        $this->custom = $custom;
        $this->xdata=$xdata;
//        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.button');
    }
}
