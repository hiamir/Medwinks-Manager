<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Admin\Countries;
use App\Models\Regions;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class ServiceRequirements extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;
    public $pageName = "Service Requirements";
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
        'description' => 'Description'
    ];

    public $submitFields = [
        'name'=>'name',
        'description' => 'description',
    ];
    public $form = [
        'name'=>null,
        'description' => null,
        'trash' => false,
        'timestamps' => true
    ];
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
            'form.description.required' => 'Required',
            'form.description.min' => ':attribute description must be min 20 character long',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Service requirement',
            'form.description' => ($this->form['name'] != '') ? $this->form['name'] : 'Description',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:service_requirements,name,' . $this->crudID,'min:4'],
            'form.description' => 'required|min:20',
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
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
        }
    }


    public function updated($field)
    {
        switch ($field) {
            case "form.name":
            case "form.description":
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

    public function service_requirement_create_button($modalID)
    {
        $this->clearFields();
    }

    public function service_requirement_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $service = Query::service_requirement($id);
        $this->getRecords($service);
    }

    public function service_requirement_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $service = Query::service_requirement($id);
        $this->deleteMessage = Data::deleteMessage('Service', $service->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_service_requirement_create($id,$modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $service = new \App\Models\ServiceRequirements();
        $this->submit($crud = 'create', $mID = $modalID, $records = $service, $name = 'service', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_service_requirement_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $service = Query::service_requirement($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $service, $name = 'service', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_service_requirement_delete($id, $modalID)
    {
        $service = Query::service_requirement($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $service, $name = 'Passport- '.$service->name, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->service = null;
    }


    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        if (in_array('Manager', $userRole)) {
            $service_requirements =\App\Models\ServiceRequirements::
            where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } elseif (in_array('User', $userRole)) {
            $service_requirements = \App\Models\ServiceRequirements::where('id',0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }

        return view($this->routeIndex,
            [
                'service_requirements' => $service_requirements,
                'currentPage' => Quicker::currentPage($service_requirements),
                'perPage' => Quicker::perPage($service_requirements),
                'total' => Quicker::total($service_requirements)
            ])
            ->layout('layouts.app');
    }

}
