<?php

namespace App\Http\Livewire\Admin;

use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Models extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;
    public $pageName = "model";
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];


    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = [
        'id' => 'ID',
        'name' => 'Name',
    ];

    public $submitFields = [
        'name'=>'name',
    ];
    public $form = [
        'name'=>null,
        'trash' => false,
        'timestamps' => true
    ];
    public $selectedCheckbox=[];
    public $formBackup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];

    public $disabled='false';

    protected function messages()
    {
        return [
            'form.name.required' => 'Required',
            'form.name.min' => 'Name must be min 4 character long',
            'form.name.unique'=>':attribute already exists'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'model',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:models,name,' . $this->crudID,'min:4'],
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
        $this->formBackup = $this->form;
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
    }


    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_each_word($this->form['name']);
                break;
        }
    }


    public function updated($field)
    {
        switch ($field) {
            case "form.name":
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

    public function model_create_button($modalID)
    {
        $this->clearFields();
    }

    public function model_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $model = Query::model($id);
        $this->getRecords($model);
    }

    public function model_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $model = Query::model($id);
        $this->deleteMessage = Data::deleteMessage('model', $model->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_model_create($id,$modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $model = new \App\Models\Models();
        $this->submit($crud = 'create', $mID = $modalID, $records = $model, $name = 'model', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_model_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $model = Query::model($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $model, $name = 'model', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_model_delete($id, $modalID)
    {
        $model = Query::model($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $model, $name = 'Passport- '.$model->model_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->model = null;
    }


    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        if (in_array('Admin', $userRole)) {
            $models =\App\Models\Models::
            where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } else {
            $models = \App\Models\Models::where('id',0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'models' => $models,
                'currentPage' => Quicker::currentPage($models),
                'perPage' => Quicker::perPage($models),
                'total' => Quicker::total($models)
            ])
            ->layout('layouts.app');
    }

}
