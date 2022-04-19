<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\MenuFolders;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Folders extends Component
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
    public $searchFields = ['id' => 'ID', 'name' => 'Folder', 'position' => 'Position', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'position' => 'position'];
    public $form = ['trash' => false, 'timestamps' => true];
    public $crudID = null;
    public $deleteMessage= "";
    public $readyToLoad = false;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshComponent' => 'refreshPage'];

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
            'form.position' => ($this->form['name'] != '') ? $this->form['name'] : 'Position'
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
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
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

    public function folder_create_button($modalID)
    {
        $this->crudID = null;
        $this->clearFields();
    }

    protected function clearFields()
    {
        foreach ($this->submitFields as $recordField => $formField) {
            $this->form[$formField] = '';
        }
    }

    public function folder_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $folder = Query::menu_folder($id);
        $this->getRecords($folder);
    }

    public function folder_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $folder = Query::menu_folder_with_links($id);
        $this->deleteMessage = Data::deleteMessage('Folder', $folder->name, 'links', count($folder->links));
    }

// CRUD BUTTON

    public function submit_folder_create($modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $folder = new \App\Models\MenuFolders();
        $this->submit($crud = 'create', $mID = $modalID, $records = $folder, $name = 'folder', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_folder_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $folder = Query::menu_folder($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $folder, $name = $folder->name, $fields = $this->submitFields, $data = $this->form);
    }


    public function submit_folder_delete($id, $modalID)
    {
        $folder = Query::menu_folder($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $folder, $name = $folder->name, $fields = $this->submitFields, $data = $this->form);
        $this->folder = null;
    }


// CRUD SUBMIT

    public function render()
    {
        if ($this->error === false) {
            $folders = \App\Models\MenuFolders::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);;

            return view($this->routeIndex, [
                'folders' => $folders,
                'currentPage' => Quicker::currentPage($folders),
                'perPage' => Quicker::perPage($folders),
                'total' => Quicker::total($folders)
            ])->layout('layouts.app');
        } else {
            $roles = Query::menu_folder(0);
            return view($this->routeIndex,
                [
                    'roles' => $roles,

                ])->layout('layouts.app');
        }
    }
}
