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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Throwable;

class Users extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use AuthSubmit;
    use Quicker;
    use TableFilter;
    use Data;

    public $pageName = "Users";
    public $sortField = 'created_at';
    protected $access = 'view-users';
    protected $routeName = "admin.users";

    public $auth;
    public $sortRoleField = 'all';
    public $pageNoList;
    public $pageNo = 20;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $toggleHighlight = false;
    public $searchFields = ['id' => 'ID', 'name' => 'User', 'email' => 'Email', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'email' => 'email', 'password' => 'password', 'blocked' => 'status', 'two_factor_code' => 'two_factor_code', 'two_factor_expires_at' => 'two_factor_expires_at'];
    public $form = ['name' => null, 'email' => null, 'roles' => [], 'trash' => false, 'timestamps' => true];
    public $crudID = null;
    public $data = ['name'];
    public $userRoles;
    public $deleteMessage;
    public $oldEmail;
    public $menuList = [];
    public $menuCategory = [];
    public $checkbox;
    public $checked = [];
    public $roles;
    public $adminRoles;
    public $guardList;
    protected $paginationTheme = 'bootstrap';
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

    public function user_create_button($modalID)
    {
        $this->authCreateButton($this->submitFields);
    }

    public function submit_user_create($modalID)
    {
        $this->authCreate(Query::auth_guard_for_admin(), $modalID);

    }


    //  AUTH UPDATE

    public function user_update_button($id, $modalID)
    {

        $this->authUpdateButton(Query::auth_guard_for_admin(), $id);
    }

    public function submit_user_update($id, $modalID)
    {
        $this->authUpdate(Query::auth_guard_for_admin(), $id, $modalID);
    }


//  AUTH DELETE

    public function user_delete_button($id, $modalID)
    {
        $this->authDeleteButton(Query::auth_guard_for_admin(), $id);
    }


    public function submit_user_delete($id, $modalID)
    {
        $this->authDelete(Query::auth_guard_for_admin(), $id, $modalID);
    }

    //  RESET PASSWORD

    public function resetpassword_button($id, $modalID)
    {

    }

    public function submit_resetpassword($id, $modalID)
    {
        $this->resetPassword(Query::auth_guard_for_admin(), $id, $modalID);
    }


    public function render()
    {
        $this->userRoles = Role::whereNotIn('slug_name', ['admin', 'super-admin'])->get();
        $this->roles = Quicker::convertArray($this->userRoles, 'name');
        $users = User::
            where('name', 'like', '%' . $this->search . '%')
            ->where('email', '!=', auth()->user()->email)
//            ->whereHas('roles', function ($q) {
//                if ($this->sortRoleField != 'all') {
//                    $q->where('roles.id', $this->sortRoleField);
//                }
//            })
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->pageNo);
        return view('livewire.admin.users.index', [
            'pageName'=>$this->pageName,
            'users' => $users,
            'roles' => $this->roles,
            'currentPage' => Quicker::currentPage($users),
            'perPage' => Quicker::perPage($users),
            'total' => Quicker::total($users)])->layout('layouts.app');
    }
}
