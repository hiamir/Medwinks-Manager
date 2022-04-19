<?php

namespace App\Http\Livewire\Admin;

use App\Models\RoleExtends;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\AuthSubmit;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;

    public $pageName = "Roles";
    public $sortField = 'created_at';
    public $routeName = "admin.roles";
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = ['id' => 'ID', 'name' => 'Role', 'slug_name' => 'Slug', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'slug_name' => 'slug', 'guard_name' => 'guard'];
    public $form = ['name' => null, 'slug' => null, 'guard' => '', 'permissions' => [], 'trash' => false, 'timestamps' => false];
    public $formBackup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $checkbox;
    public $guardList;
    public $permissions;
    public $permissionList;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public function rules()
    {
        return [
            'form.name' => 'required|min:4|unique:roles,name,' . $this->crudID,
            'form.slug' => 'required|min:4|regex:/^[a-z,\-]+$/|unique:roles,slug_name,' . $this->crudID,
            'form.permissions.permission' => $this->anyPermisisonSelected(),
            'form.guard' => 'required',
        ];
    }

    public function anyPermisisonSelected()
    {
        $validated = false;
        if (($this->form['permissions']) != "") {
            $keys = array_keys($this->form['permissions']);
            foreach ($keys as $key) {
                if ($this->form['permissions'][$key] == true) {
                    $validated = true;
                }
            }
        }
        if ($validated) {
            return '';
        } else {
            return 'required';
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->securityGate();
        $this->formBackup=$this->form;
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
        $this->guardList = TableFilter::guardFilter();
        $this->form['guard'] = '';

        $this->permissionList = Quicker::convertArray(Query::permission_all_with_guard(Query::auth_guard_for_admin()), 'name');;
    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
            case "form.slug":
                $this->form['slug'] = Data::all_lower_case($this->form['slug']);
                break;
            case "form.guard":
                $this->form['guard'] = Data::all_lower_case($this->form['guard']);
                break;
        }
    }

    public function updated($field)
    {

        switch ($field) {
            case 'form.name':
            case 'form.slug':
                $this->validateOnly($field);
                break;
        }

    }

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function refreshPage()
    {
        $this->resetPage();
    }

    public function updatingPageNo()
    {
        $this->resetPage();
    }

    public function role_create_button($modalID)
    {
        $this->form['permissions'] = '';
        $this->clearFields($this->submitFields);
    }

    public function role_update_button($id, $modalID)
    {

        $this->crudID = $id;
        $role = Query::role($id);
        $this->getRecords($role);
        $this->form['permissions'] = Quicker::processCheckbox('permission', $role->permissions->pluck('name'), $this->permissionList, $id);
        $this->checkbox = Quicker::processCheckboxCreate($this->form, $this->permissionList, $id, 'permissions', 'permission', 'permission_name_from_id', true);
    }

// CRUD BUTTON

    public function role_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $role = Query::role_with_users($id);
        $this->deleteMessage = Data::deleteMessage('Role', $role->name, 'user', count($role->users));
    }

    public function submit_role_create($modalID)
    {
        $this->validate();
        $this->form['permissions'] = Quicker::processCheckboxCreate($this->form, $this->permissionList, 0, 'permissions', 'permission', 'permission_name_from_id', true);

        $this->data_formatter($this->form, 'form');

        $role = new RoleExtends();
        $this->submit($crud = 'create', $mID = $modalID, $records = $role, $name = 'role', $fields = $this->submitFields, $data = $this->form);

        $role->syncPermissions(json_decode($this->form['permissions'], true));
        $this->emit('refreshMenu');
    }

    public function submit_role_update($id, $modalID)
    {

        $this->validate();

        $this->form['permissions'] = Quicker::processCheckboxCreate($this->form, $this->permissions, $id, 'permissions', 'permission', 'permission_name_from_id', true);
        $role = Query::role($id);
        $this->data_formatter($this->form, 'form');
//        $customUpdate = $this->data_difference(json_decode($this->checkbox, true), json_decode($this->form['permissions'], true));
        $this->submit($crud = 'update', $mID = $modalID, $records = $role, $name = 'role', $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $role->syncPermissions(json_decode($this->form['permissions'], true));
        $this->emit('refreshMenu');
    }


// CRUD SUBMIT

    public function submit_role_delete($id, $modalID)
    {
        $role = Query::role($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $role, $name = $role->name, $fields = $this->submitFields, $data = $this->form);
        $this->role = null;
        $this->emit('refreshMenu');
    }

    public function permissions_button($id, $modalID)
    {
        $this->modalID = $modalID;
        $this->form['trash'] = false;
    }

    public function submit_permissions($id, $modalID)
    {
        $permissions = $this->form['permissions'];
        $role = Query::role($this->roleID);
        $this->syncPermissions($role, $modalID, $permissions, $this->permissionKeys);
    }

    // PERMISSION BUTTON

    public function render()
    {

        if ($this->error === false) {

            if (in_array("Super Admin", json_decode(auth()->user()->roles->pluck('name')))) {

                $roles = RoleExtends::with('permissions')
                    ->where('guard_name', 'admin')
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->pageNo);

                $permissions = Query::permission_with_admin_guard();

            } else {
                $roles = RoleExtends::with('permissions')
                    ->where('guard_name', 'web')
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->pageNo);
                $permissions = $permissions = Query::permission_with_web_guard();
            }
            $this->permissions = Quicker::convertArray($permissions, 'name');
            return view($this->routeIndex,
                [
                    'roles' => $roles,
                    'permissions' => $permissions,
                    'currentPage' => Quicker::currentPage($roles),
                    'perPage' => Quicker::perPage($roles),
                    'total' => Quicker::total($roles)
                ])->layout('layouts.app');
        } else {
            $roles = RoleExtends::find(0);
            return view($this->routeIndex,
                [
                    'roles' => $roles,

                ])->layout('layouts.app');
        }

    }

    // PERMISSION SUBMIT

    protected function messages()
    {
        return [
            'form.name.required' => ':attribute name is required',
            'form.name.alpha' => ':attribute must be alphabets only',
            "form.name.unique" => ":attribute is already exists",
            "form.slug.required" => "Slug name is required",
            "form.slug.min" => "Slug require minimum 4 characters",
            "form.slug.regex" => ":attribute must have only lower case letter and '-'",
            "form.slug.unique" => ":attribute name already exists",
            'form.permissions.permission.required' => 'Any permission must be selected',
            "form.guard.required" => "Guard name is required",
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Role',
            'form.slug' => ($this->form['slug'] != '') ? $this->form['slug'] : 'SLug',

        ];
    }
}
