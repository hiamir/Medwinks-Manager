<?php

namespace App\View\Components\Molecules\Bootstrap;

use Illuminate\View\Component;

class ListItem extends Component
{
    public $background;
    public $action;
    public $active;
    public $disable;
    public $bagText;
    public $bagColor;
    public $bagRounded;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $background,
        $action,
        $active,
        $disable,
        $bagText,
        $bagColor,
        $bagRounded,
        $class,
    )
    {
        $this->background=$background;
        $this->action=$action;
        $this->active=$active;
        $this->disable=$disable;
        $this->bagText=$bagText;
        $this->bagColor=$bagColor;
        $this->bagRounded=$bagRounded;
        $this->class=$class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.list-item');
    }
}
