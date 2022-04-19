<?php

namespace App\Http\Livewire\Admin;

use App\Traits\AuthorizesRoleOrPermission;
use Livewire\Component;

class Dashboard extends Component
{
    use AuthorizesRoleOrPermission;
    public $listeners = ['display' => 'view'];
    protected $access = 'view-admin-dashboard';
    protected $routeName = "admin.dashboard";
    public $pageName=null;
    public $content = '';

    public function mount(){
        $this->securityGate();
    }

//    public function mount()
//    {
//        $this->authorizeRoleOrPermission(['Super Admin','Admin']);
//
//    }

    public function view($view)
    {
        $this->content = $view;
    }

    public function render()
    {

        return view($this->routeIndex)->layout('layouts.app');
    }
}
