<?php

namespace App\Http\Livewire;

use App\Models\Status;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use AuthorizesRoleOrPermission;

    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;

    public $listeners = ['display' => 'view'];

    protected $paginationTheme = 'bootstrap';
    public $pageName='Dashboard';
    public $userRole;
    public $application_submitted;
    public $application_incomplete;
    public $application_revision;
    public $application_accepted;
    public $application_rejected;
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
        $this->userRole = json_decode(auth()->user()->roles->pluck('name'));

        if (in_array('Manager', $this->userRole)) {
            $this->application_submitted = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-submitted')
                ->first();

            $this->application_incomplete = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-incomplete')
                ->first();

            $this->application_revision = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-revision')
                ->first();

            $this->application_accepted = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-accepted')
                ->first();

            $this->application_rejected = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-rejected')
                ->first();

        }else{

            $this->application_submitted = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']) ->where('users_id', Auth::user()->id);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-submitted')
                ->first();

            $this->application_incomplete = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']) ->where('users_id', Auth::user()->id);;
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-incomplete')
                ->first();

            $this->application_revision = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']) ->where('users_id', Auth::user()->id);;
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-revision')
                ->first();

            $this->application_accepted = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']) ->where('users_id', Auth::user()->id);;
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-accepted')
                ->first();

            $this->application_rejected = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']) ->where('users_id', Auth::user()->id);;
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->where('reference','application-rejected')
                ->first();
        }






        return view($this->routeIndex)->layout('layouts.app');
    }
}
