<?php

namespace App\View\Components\Molecules\Bootstrap;

use Illuminate\View\Component;

class Lists extends Component
{
    public $displayList;
    public $listName;
    public $width;
    public $lists;
    public $name;
    public $background;
    public $error;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($displayList,$listName,$width,$lists,$name,$background,$error)
    {
        $this->displayList=$displayList;
        $this->listName=$listName;
        $this->width=$width;
        $this->lists=$lists;
        $this->name=$name;
        $this->background=$background;
        $this->error=$error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.lists');
    }
}
