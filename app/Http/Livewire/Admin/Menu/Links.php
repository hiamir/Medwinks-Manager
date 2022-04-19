<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\MenuLinks;
use App\Models\PermissionExtends;
use App\Models\RoleExtends;
use App\Rules\AnyRoleSelected;
use App\Rules\CheckRoute;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\AuthSubmit;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class Links extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    public $pageName = null;
    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = ['id' => 'ID', 'name' => 'Name', 'route' => 'Route', 'route_index' => 'Route Index', 'permission_id' => 'Permission', 'position' => 'Position', 'folder_id' => 'Folder', 'category_id' => 'Category', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'route' => 'route', 'route_index' => 'route_index', 'permission_id' => 'permission', 'position' => 'position', 'folder_id' => 'folder', 'category_id' => 'category'];
    public $form = ['name' => null, 'route' => null, 'route_index' => null, 'permission_id' => null, 'position' => null, 'folder' => '', 'category' => '', 'roles.role' => [], 'permission' => null, 'trash' => false, 'timestamps' => true];
public $formBackup;
    public $roles;
    public $display_permission_list = 'none';
    public $display_route_list = 'none';
    public $permissionList;
    public $routeList;
    public $roleCollect;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public function rules()
    {

        return [
            'form.name' => 'required|min:4|regex:/^[A-Za-z,\s]+$/',
            'form.route' => ['required', 'regex:/^[a-z,\.-]+$/', 'unique:menu_links,route,' . $this->crudID, new CheckRoute()],
//            'form.roles.role' => $this->anyRoleSelected(),
            'form.permission' => ['required', 'regex:/^[a-z,\-]+$/', 'exists:permissions,name', $this->uniquePermission()],
            'form.folder' => 'required|integer|gt:0',
            'form.category' => 'required|integer|gt:0',
            'form.position' => 'required|integer|gt:0',
        ];
    }

    public function uniquePermission()
    {
        if ($this->crudID != null) {
            $assignedPermissions = json_decode(Query::menu_links_all()->pluck('permission_id'));
            $selectedPermission = Query::menu_link($this->crudID)->permission_id;
            if (!in_array($selectedPermission, $assignedPermissions)) {
                return 'integer';
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function anyRoleSelected()
    {
//        if (is_array($this->form['roles'])) {
//            $validated = false;
//            if (($this->form['roles']) != "") {
//                $keys = array_keys($this->form['roles']);
//                foreach ($keys as $key) {
//                    if ($this->form['roles'][$key] == true) {
//                        $validated = true;
//                    }
//                }
//            }
//            return ($validated ? '' : 'required');
//        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->securityGate();
        $this->formBackup = $this->form;
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
        $this->menuList = Quicker::convertArray(Query::menu_folders_all(), 'name');
        $this->menuCategory = Quicker::convertArray(Query::menu_categories_all(), 'name');

    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($field)
    {
        switch ($field) {
            case 'form.route':
                $this->display_permission_list = 'none';
                $assignedRoutes = MenuLinks::all()->pluck('route')->toArray();

                $finalRoute = [];
                foreach ($this->routeNames('web') as $id => $route) {
                    if (!array_search($route, $assignedRoutes, true)) {
                        $finalRoute[$id] = ['name' => $route];
//                        array_push($finalRoute, $route);
                    }
                }

                if (isset($finalRoute)) {
                    ($this->form['route'] != "") ? $this->display_route_list = 'block' : $this->display_route_list = 'none';
                    $a = $this->form["route"];
                    $this->routeList = $this->array_partial_search($finalRoute, $this->form['route']);
//                    $this->routeList =  $finalRoute;
                }
                $this->validateOnly($field);
                break;

            case 'form.permission':
                $this->display_route_list = 'none';
                $assignedPermissions = MenuLinks::with('permission')
                    ->whereHas('permission', function ($q) {
                        $q->where('guard_name', Query::auth_guard_for_admin());
                    })
                    ->pluck('permission_id')->toArray();
                $permissions = PermissionExtends::whereNotIn('id', $assignedPermissions)
                    ->where('guard_name',  Query::auth_guard_for_admin())
                    ->where('name', 'like', '%' . $this->form['permission'] . '%')->get();
                if (isset($permissions)) {
                    ($this->form['permission'] != "") ? $this->display_permission_list = 'block' : $this->display_permission_list = 'none';
                    $this->permissionList = $permissions;
                }
                $this->validateOnly($field);
                break;
        }
    }

    public function array_partial_search($array, $keyword)
    {
        $found = [];
        // Loop through each item and check for a match.
        foreach ($array as $string) {

            // If found somewhere inside the string, add.
            if (strpos($string['name'], $keyword) !== false) {
                $found[] = ['name' => $string['name']];
            }
        }
        return $found;
    }

    public function routeSelect($name)
    {
        $this->form['route'] = $name;
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
    }


    public function permissionSelect($name)
    {

        $this->form['permission'] = $name;
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
    }


    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
            case "form.route":
                $this->form['position'] = Data::all_lower_case($this->form['position']);
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

    public function link_create_button($modalID)
    {
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
        $this->crudID = null;
        $this->clearFields($this->submitFields);
    }

    public function link_update_button($id, $modalID)
    {
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
        $this->crudID = $id;
        $link = MenuLinks::with('link_roles')->where('id', $id)->first();
        $this->getRecords($link);
        $this->form['permission'] = Query::permission_name_from_id($this->form['permission']);
        $this->form['roles'] = Quicker::processCheckbox('role', $link->link_roles->pluck('id')->toArray(), $this->roles, $id);
    }


// CRUD BUTTON

    public function link_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $link = Query::menu_link($id);
        $this->deleteMessage = Data::deleteMessage('Link', $link->name);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submit_link_create($modalID)
    {
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
        $this->validate();
        $this->form['permission'] = Query::permission_id_by_name($this->form['permission']);

        $roles = Quicker::processCheckboxCreate($this->form, $this->roles, 0, 'roles', 'role', 'getRoleName', false);
        $this->data_formatter($this->form, 'form');
        $link = new \App\Models\MenuLinks();
        $this->submit($crud = 'create', $mID = $modalID, $records = $link, $name = 'link', $fields = $this->submitFields, $data = $this->form);
        $link->link_roles()->sync($roles);
        $this->emit('refreshMenu');
    }

    public function submit_link_update($id, $modalID)
    {
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
        $this->validate();
        $this->form['permission'] = Query::permission_id_by_name($this->form['permission']);
        $roles = (Quicker::processCheckboxCreate($this->form, $this->roles, $id, 'roles', 'role', 'getRoleName', false));
//        dd($roles);
        $this->data_formatter($this->form, 'form');
        $link = Query::menu_link($id);
        $link->link_roles()->sync($roles);
        $this->submit($crud = 'update', $mID = $modalID, $records = $link, $name = 'link', $fields = $this->submitFields, $data = $this->form);
        $this->emit('refreshMenu');
    }


// CRUD SUBMIT

    public function submit_link_delete($id, $modalID)
    {
        $this->display_route_list = 'none';
        $this->display_permission_list = 'none';
        $link = Query::menu_link($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $link, $name = $link->name, $fields = $this->submitFields, $data = $this->form);
        $this->link = null;
        $this->emit('refreshMenu');
    }

    public function render()
    {


        if ($this->error === false) {

            if (Auth::user()->hasRole('Super Admin')) {
                $userRoles = Role::whereIn('name', ['Super Admin', 'Admin'])->get();
                $links = \App\Models\MenuLinks::
                with([
                    'link_roles:id,name,guard_name',
                    'permission:id,name,guard_name',
                    'folder:id,name',
                    'category:id,name'])
                    ->search($this->search);

                $links = $links
                    ->whereHas('link_roles', function ($query) {
                        $query->whereIn('roles.name', ['Super Admin', 'Admin']);
                    })
                    ->whereHas('permission', function ($query) {
                        $query->where('permissions.guard_name', 'admin');
                    })
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->pageNo);


            } elseif (Auth::user()->hasRole('Admin')) {
                $userRoles = Role::whereNotIn('name', ['Super Admin', 'Admin'])->get();
                $links = \App\Models\MenuLinks::
                with([
                    'link_roles:id,name,guard_name',
                    'permission:id,name,guard_name',
                    'folder:id,name',
                    'category:id,name'])
                    ->search($this->search);

                $links = $links
                    ->whereHas('link_roles', function ($query) {
                        $query->whereNotIn('roles.name', ['Super Admin', 'Admin']);
                    })
                    ->whereHas('permission', function ($query) {
                        $query->where('permissions.guard_name', 'web');
                    })
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->paginate($this->pageNo);


            }
            $this->roles = Quicker::convertArray($userRoles, 'name');
//            dd($links);

            return view($this->routeIndex, [
                'links' => $links,
                'currentPage' => Quicker::currentPage($links),
                'perPage' => Quicker::perPage($links),
                'total' => Quicker::total($links)
            ])->layout('layouts.app');
        } else {
            $links = Query::menu_link(0);
            return view($this->routeIndex,
                [
                    'roles' => $links,

                ])->layout('layouts.app');
        }
    }

    protected function messages()
    {
        return [
            'form.name.required' => ':attribute name is required',
            'form.name.regex' => ':attribute must have alphabets and - only',
            'form.name.min' => ':attribute must be 4 characters long',
            'form.route.required' => 'Valid Route name is required',
            'form.route.regex' => 'Route allowed only lower case alphabetic characters and dot ' . ' ',
            'form.route.unique' => ':attribute already registered',
            'form.permission.required' => 'Valid permission name is required',
            'form.permission.regex' => 'Permission must have lower case alphabets and - only',
            'form.permission.exists' => ":attribute permission doesn't exists",
            'form.permission.unique' => ':attribute already exists',
            'form.category.required' => 'Select a Category',
            'form.category.integer' => 'Category must be integer',
            'form.category.gt' => 'Category must be > 0',
            'form.folder.required' => 'Select a folder',
            'form.folder.integer' => 'Folder must be integer',
            'form.folder.gt' => 'Folder must be > 0',
            'form.position.required' => 'Give a position for :attribute',
            'form.position.integer' => ':attribute must be integer',
            'form.position.gt' => 'Position must be > 0',
            'form.roles.role.required' => 'Any role must be selected',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? '"' . $this->form['name'] . '"' : 'Link',
            'form.position' => ($this->form['name'] != '') ? '"' . $this->form['name'] . '"' : 'Link',
            'form.route' => ($this->form['route'] != '') ? '"' . $this->form['route'] . '"' : 'Route',
            'form.permission' => ($this->form['permission'] != '') ? '"' . $this->form['permission'] . '"' : 'Permission'
        ];
    }
}

