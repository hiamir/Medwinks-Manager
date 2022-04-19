<?php

namespace App\View\Components\Atoms\Bootstrap;

use App\Traits\Quicker;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $id;
    public $height;
    public $name;
    public $size = 'normal';
    public $container;
    public $type;
    public $icon;
    public $lazy = false;
    public $defer = true;
    public $debounce;
    public $label;
    public $placeholder;
    public $value;
    public $custom;
    public $class;
    public $showError;


    use Quicker;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $height,$name, $type, $container, $placeholder, $size, $label, $icon, $lazy, $defer,
                                $debounce, $value, $custom, $class,$showError=true)
    {




            $this->id = $id;
            $this->height = $height;
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
            $this->showError=$showError;
            $this->custom = $custom;

            ($class == '') ? $this->class = "p-0 mb-4" : $this->class = $class;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.bootstrap.textarea');
    }
}
