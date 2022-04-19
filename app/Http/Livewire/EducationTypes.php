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

class EducationTypes extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;
    public $pageName = "Education Types";
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
        'acronym' => 'Acronym',
        'educations_id'=>'Education'
    ];

    public $submitFields = [
        'name'=>'name',
        'acronym'=>'acronym',
        'educations_id'=>'education'
    ];
    public $form = [
        'name'=>null,
        'acronym'=>null,
        'education'=>null,
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
    public $education_list=[];

    public $disabled='false';

    protected function messages()
    {
        return [
            'form.name.required' => 'Required',
            'form.name.min' => 'Name must be min 4 character long',
            'form.education.required'=>'Required',
            'form.education.integer'=>'Education value must be integer',
            'form.education.gt'=>'Education value must be positive integer'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'education',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:educations,name,' . $this->crudID,'min:4'],
            'form.education' => ['required', 'integer','gt:0'],
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
        $this->education_list=\App\Models\Educations::select('id','name as name')->get()->toJson();
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

    public function education_type_create_button($modalID)
    {
        $this->clearFields();
    }

    public function education_type_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $education_type = Query::education_type($id);
        $this->getRecords($education_type);
    }

    public function education_type_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $education_type = Query::education_type($id);
        $this->deleteMessage = Data::deleteMessage('education', $education_type->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_education_type_create($id,$modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $education_type = new \App\Models\EducationTypes();
        $this->submit($crud = 'create', $mID = $modalID, $records = $education_type, $name = 'education_type', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_education_type_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $education_type = Query::education_type($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $education_type, $name = 'education_type', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_education_type_delete($id, $modalID)
    {
        $education_type = Query::education_type($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $education_type, $name = 'Passport- '.$education_type->education_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->education_types = null;
    }


    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        $education_types=\App\Models\EducationTypes::all();
        if (in_array('Manager', $userRole)) {
            $education_types =\App\Models\EducationTypes::
                where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } elseif (in_array('User', $userRole)) {
            $education_types = \App\Models\EducationTypes::where('id',0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'education_types' => $education_types,
                'currentPage' => Quicker::currentPage($education_types),
                'perPage' => Quicker::perPage($education_types),
                'total' => Quicker::total($education_types)
            ])
            ->layout('layouts.app');
    }

}
