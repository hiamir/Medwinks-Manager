<?php

namespace App\View\Components\Atoms\Modal;

use Illuminate\View\Component;

class InputError extends Component
{
    public $input;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input=$input;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.modal.input-error');
    }
}
