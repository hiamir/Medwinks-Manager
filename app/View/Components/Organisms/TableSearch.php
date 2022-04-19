<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class TableSearch extends Component
{
    public $fields=[];
    public $pageNoList=[];
    public $sortDirectionList=[];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fields,$pageNoList, $sortDirectionList)
    {
        $this->fields=$fields;
        $this->pageNoList=$pageNoList;
        $this->sortDirectionList=$sortDirectionList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.table-search');
    }
}
