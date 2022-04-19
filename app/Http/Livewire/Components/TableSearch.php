<?php

namespace App\Http\Livewire\Components;

use App\Traits\Quicker;
use Livewire\Component;

class tablesearch extends Component
{
    public $fields;
    public $pageNo=5;
    public $search='';
    public $sortField='created_at';
    public $class='';
    public $sortDirection = 'asc';

    public function updated(){
        $this->emitUp('searchdata',['pageNo'=>$this->pageNo, 'class'=>$this->class,'search'=>$this->search,'sortField'=>$this->sortField, 'sortDirection'=>$this->sortDirection]);
    }

    public function render()
    {



        return view('livewire.components.table-search');
    }
}
