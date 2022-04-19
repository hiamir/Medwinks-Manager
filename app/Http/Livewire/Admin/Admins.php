<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\AuthSubmit;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Throwable;

class Admins extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use AuthSubmit;
    use Quicker;
    use TableFilter;
    use Data;

    public $pageName=null;
    public $auth;
    public $sortRoleField = 'all';
    public $pageNoList;
    public $pageNo = 20;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $toggleHighlight = false;
    public $sortField = 'created_at';
    public $searchFields = ['id' => 'ID', 'name' => 'Admin', 'email' => 'Email', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'email' => 'email', 'password' => 'password', 'blocked' => 'status', 'two_factor_code' => 'two_factor_code', 'two_factor_expires_at' => 'two_factor_expires_at'];
    public $form = ['name' => null, 'email' => null, 'roles' => [], 'trash' => false, 'timestamps' => true];
    public $crudID = null;
    public $data = ['name'];
    public $deleteMessage;
    public $oldEmail;
    public $menuList = [];
    public $menuCategory = [];
    public $checkbox;
    public $checked = [];
    public $roles;
    public $adminRoles;
    public $guardList;
    protected $listeners = ['refreshComponent' => 'refreshPage'];


    public function rules($field = null)
    {
        return $this->validateRule($this->auth, $field);
    }

    protected function messages($field = null)
    {
        return $this->validateMessage($this->auth, $field);
    }

    protected function validationAttributes($field = null)
    {
        return $this->validateAttribute($this->auth, $field);
    }


    public function mount()
    {

        $this->securityGate();
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;

    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
            case "form.email":
                $this->form['email'] = Data::all_lower_case($this->form['email']);
                break;
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($field)
    {
        $this->data_formatter($this->form, 'form');
    }

    public function refreshpage()
    {
        $this->resetPage();
    }

    public function updatingPageno()
    {
        $this->resetPage();
    }

    public function updatingSortRoleField()
    {
        $this->resetPage();
    }

    public function newEmailKeyup()
    {
        ($this->oldEmail != $this->form['email']) ? $this->toggleHighlight = true : $this->toggleHighlight = false;
    }

    public function emailKeyup()
    {
        ($this->oldEmail != $this->form['email']) ? $this->toggleHighlight = true : $this->toggleHighlight = false;
    }


    //  AUTH CREATE

    public function admin_create_button($modalID)
    {
        $this->authCreateButton($this->submitFields);
    }

    public function submit_admin_create($modalID)
    {
        $this->authCreate($this->auth, $modalID);

    }


    //  AUTH UPDATE

    public function admin_update_button($id, $modalID)
    {

        $this->authUpdateButton($this->auth, $id);
    }

    public function submit_admin_update($id, $modalID)
    {
        $this->authUpdate($this->auth, $id, $modalID);
    }


//  AUTH DELETE

    public function admin_delete_button($id, $modalID)
    {
        $this->authDeleteButton($this->auth, $id);
    }


    public function submit_admin_delete($id, $modalID)
    {
        $this->authDelete($this->auth, $id, $modalID);
    }

    //  RESET PASSWORD

    public function resetpassword_button($id, $modalID)
    {

    }

    public function submit_resetpassword($id, $modalID)
    {
        $this->resetPassword($this->auth, $id, $modalID);
    }

    public function render()
    {
        $this->adminRoles = Role::whereIn('slug_name', ['admin', 'super-admin'])->get();
        $this->roles = Quicker::convertArray($this->adminRoles, 'name');
        $admins = Admin::with('roles')
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('id', '!=', auth()->user()->id)
            ->whereHas('roles', function ($q) {
                if ($this->sortRoleField != 'all') {
                    $q->where('roles.id', $this->sortRoleField);
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->pageNo);

        return view($this->routeIndex,
            [
                'admins' => $admins,
                'roles' => $this->roles,
                'currentPage' => Quicker::currentPage($admins),
                'perPage' => Quicker::perPage($admins),
                'total' => Quicker::total($admins)
            ]
        )->layout('layouts.app');
    }


}
