<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\MenuCategories;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class Categories extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;

    public $pageName=null;
    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = ['id' => 'ID', 'name' => 'Category', 'position' => 'Position', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'position' => 'position'];
    public $form = ['trash' => false, 'timestamps' => true];
    public $crudID = null;
    public $deleteMessage= "";
    public $readyToLoad = false;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshComponent' => 'refreshPage'];


    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->securityGate();
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
    }

//    VALIDATION

    protected function messages()
    {
        return [
            'form.name.required' => ':attribute name is required',
            'form.name.min' => ':attribute must be 4 characters long',
            'form.position.required' => 'Give a position for :attribute',
            'form.position.integer' => ':attribute must be integer',
            'form.position.gt' => 'Position must be > 0',
            'form.position.unique' => 'This position for :attribute already taken',
        ];
    }

    protected function rules()
    {
        return [
            'form.name' => 'required|min:4',
            'form.position' => 'required|integer|gt:0|min:1|unique:menu_folders,position,' . $this->crudID
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => 'Folder',
            'form.position' => ($this->form['name'] != '') ? $this->form['name'] : ''
        ];
    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
            case "form.position":
                $this->form['position'] = Data::all_lower_case($this->form['position']);
                break;
        }
    }

    public function updated($field)
    {
        $this->inputFinisher($field);
        switch ($field) {
            case 'form.position':
                $this->validateOnly($field);
                break;
        }

    }

    protected function clearFields()
    {
        foreach ($this->submitFields as $recordField => $formField) {
            $this->form[$formField] = '';
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

    public function category_create_button($modalID)
    {
        $this->crudID = null;
        $this->clearFields();
    }

    public function category_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $category = Query::menu_category($id);
        $this->getRecords($category);
    }

    public function category_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $category = Query::menu_category_with_links($id);
        $this->deleteMessage = Data::deleteMessage('Category', $category->name, 'links', count($category->links));
    }


// CRUD SUBMIT

    public function submit_category_create($modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $category = new \App\Models\MenuCategories();
        $this->submit($crud = 'create', $mID = $modalID, $records = $category, $name = 'category', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_category_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $category = Query::menu_category($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $category, $name = $category->name, $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_category_delete($id, $modalID)
    {
        $category = Query::menu_category($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $category, $name = $category->name, $fields = $this->submitFields, $data = $this->form);
        $this->category = null;
    }


    public function render()
    {

        $categories = \App\Models\MenuCategories::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->pageNo);;


        return view('livewire.admin.menu.categories.index', [
            'categories' => $categories,
            'currentPage' => Quicker::currentPage($categories),
            'perPage' => Quicker::perPage($categories),
            'total' => Quicker::total($categories)
        ])->layout('layouts.app');
    }
}
