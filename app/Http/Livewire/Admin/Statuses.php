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

class Statuses extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;
    public $pageName = "status";
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
        'reference' => 'Reference',
    ];

    public $submitFields = [
        'name'=>'name',
        'reference' => 'reference',
        'icon' => 'icon',
        'models_id' => 'model',
    ];
    public $form = [
        'name'=>null,
        'reference'=>null,
        'icon'=>null,
        'model'=>'',
        'trash' => false,
        'timestamps' => true
    ];
    public $selectedCheckbox=[];
    public $formBackup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $modelList=[];
    public $menuCategory = [];

    public $disabled='false';

    protected function messages()
    {
        return [
            'form.name.required' => 'Required',
            'form.name.min' => ':attribute must be min 4 character long',
            'form.reference.required' => 'Required',
            'form.reference.min' => ':attribute must be min 4 character long',
            'form.reference.unique'=>':attribute already exists',
            'form.icon.required'=>'Icon is required',
            'form.icon.min' => ':attribute must be min 4 character long',
            'form.model.required' => 'Required',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'status',
            'form.reference' => ($this->form['reference'] != '') ? $this->form['reference'] : 'reference',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'min:4'],
            'form.reference' => ['required', 'unique:Statuses,reference,' . $this->crudID,'min:4'],
            'form.icon' => ['required','min:4'],
            'form.model' => ['required'],
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
        $this->modelList = (\App\Models\Models::select('id', 'name as name')->get()->toJson());
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
    }


    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_each_word($this->form['name']);
                break;
            case "form.reference":
                $this->form['reference'] = Data::all_lower_case($this->form['reference']);
                break;
        }
    }


    public function updated($field)
    {
        switch ($field) {
            case "form.name":
            case "form.reference":
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

    public function status_create_button($modalID)
    {
        $this->clearFields();
    }

    public function status_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $status = Query::status($id);

        $this->getRecords($status);
    }

    public function status_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $status = Query::status($id);
        $this->deleteMessage = Data::deleteMessage('status', $status->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_status_create($id,$modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $status = new \App\Models\Status();
        $this->submit($crud = 'create', $mID = $modalID, $records = $status, $name = 'status', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_status_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $status = Query::status($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $status, $name = 'status', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_status_delete($id, $modalID)
    {
        $status = Query::status($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $status, $name = 'Passport- '.$status->status_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->status = null;
    }


    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        if (in_array('Admin', $userRole)) {
            $statuses =\App\Models\Status::with('models')
            ->where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } else {
            $statuses = \App\Models\Status::where('id',0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'statuses' => $statuses,
                'currentPage' => Quicker::currentPage($statuses),
                'perPage' => Quicker::perPage($statuses),
                'total' => Quicker::total($statuses)
            ])
            ->layout('layouts.app');
    }

}
