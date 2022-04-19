<?php

namespace App\Http\Livewire\Admin;

use App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{
    use AuthorizesRoleOrPermission;
    public $listeners=['display'=>'view'];

    public $content='dashboard';
    public $viewid='dashboard';
    public $viewname='Dashboard';

    public function mount(){

        $this->authorizeRoleOrPermission('Admin');

        $this->emit('viewpass',$this->viewname);
    }
    public function view($view){
        $viewkey=array_keys($view);
        $this->viewid=$viewkey[0];
        $this->viewname=$view[$viewkey[0]];
        $this->content=$this->viewid;

        $this->emit('viewpass',$this->viewname);
    }

    public function render()
    {
        return view('livewire.admin.main')->layout('layouts.appadmin');
    }
}
