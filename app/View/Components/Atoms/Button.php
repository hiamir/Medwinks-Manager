<?php

namespace App\View\Components\Atoms;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $name;
    public $buttonName;
    public $id;
    public $class;
    public $buttonIcon;
    public $buttonSize;
    public $buttonColor;
    public $link;
    public $buttonRound;
    public $onClick;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type, $id, $class, $buttonIcon, $buttonColor, $link,$buttonSize, $buttonRound, $buttonName, $onClick)
    {
        $this->type = $type;
        $this->name = $name;
        $this->buttonName = $buttonName;
        $this->id = $id;
        $this->class = $class;
        $this->buttonIcon = $buttonIcon;
        $this->buttonSize = $buttonSize;
        $this->buttonColor = $buttonColor;
        $this->link=$link;
        $this->buttonRound = $buttonRound;
        $this->onClick = $onClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.button');
    }
}
