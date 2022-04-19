<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Framer extends Component
{
    public $pageName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageName)
    {
       $this->pageName=$pageName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.framer');
    }
}
