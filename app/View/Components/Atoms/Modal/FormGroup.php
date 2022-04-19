<?php

namespace App\View\Components\Atoms\Modal;

use Illuminate\View\Component;

class FormGroup extends Component
{
    public $size;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($size,$icon)
    {
       $this->size=$size;
       $this->icon=$icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.form-group');
    }
}
