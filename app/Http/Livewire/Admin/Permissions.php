<?php

namespace App\Http\Livewire\Admin;

use App\Models\PermissionExtends;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;

    public $pageName=null;
    protected $paginationTheme = 'bootstrap';
    protected $access = 'view-permissions';
    protected $routeName = "admin.permissions";
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = ['id' => 'ID', 'name' => 'Permission', 'slug_name' => 'Slug', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'slug_name' => 'slug', 'guard_name' => 'guard'];
    public $form = ['name'=>'','slug'=>'','guard'=>'','trash' => false, 'timestamps' => true];
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

    protected function messages()
    {
        return [
            'form.name.required' => ':attribute name is required',
            'form.name.regex' => ':attribute must have lower case and - only',
            "form.name.unique" => ":attribute is already exists",
            "form.guard.required" => "Guard name is required",
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Permission',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required','regex:/^[a-z,\-]+$/', 'min:4','unique:permissions,name,' . $this->crudID],
            'form.guard' => 'required',
        ];
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
    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::all_lower_case($this->form['name']);
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

// CRUD BUTTON

    public function permission_create_button($modalID)
    {
        $this->clearFields($this->submitFields);
    }

    public function permission_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $permission = Query::permission($id);
        $this->getRecords($permission);
    }

    public function permission_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $permission = Query::permission_with_roles($id);
        $this->deleteMessage = Data::deleteMessage('Role', $permission->name, 'user', count($permission->roles));
    }

// CRUD SUBMIT

    public function submit_permission_create($modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $permission = new PermissionExtends();
        $this->submit($crud = 'create', $mID = $modalID, $records = $permission, $name = 'permission', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_permission_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $permission = Query::permission($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $permission, $name = 'permission', $fields = $this->submitFields, $data = $this->form,null,null,null,);
    }

    public function submit_permission_delete($id, $modalID)
    {
        $permission = Query::permission($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $permission, $name = 'permission', $fields = $this->submitFields, $data = $this->form,null,null,null,);
        $this->permission = null;
    }

    public function render()
    {
        $userRole=json_decode(auth()->user()->roles->pluck('name'));
        if(in_array('Super Admin',$userRole)){
            $permissionViews = Permission::where('guard_name', 'admin')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }else{
            $permissionViews = Permission::where('guard_name', 'web')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }

        return view('livewire.admin.permissions.index',
            ['permissionViews' => $permissionViews,
                'currentPage' => Quicker::currentPage($permissionViews),
                'perPage' => Quicker::perPage($permissionViews),
                'total' => Quicker::total($permissionViews)])
            ->layout('layouts.app');
    }


}
