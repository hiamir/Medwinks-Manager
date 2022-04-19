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

class Educations extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;
    public $pageName = "Educations";
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage','passingData'];


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
        'position' => 'Position',
        'created_at' => 'Created at'
    ];

    public $submitFields = [
        'name'=>'name',
        'position' => 'position',
    ];
    public $submitFields1 = [
        'name'=>'name',
        'acronym'=>'acronym',
        'educations_id' => 'education_id',
    ];
    public $form = [
        'name'=>null,
        'position' => null,
        'trash' => false,
        'timestamps' => true
    ];
    public $form1 = [
        'name'=>null,
        'acronym'=>null,
        'education_id' => null,
        'trash' => false,
        'timestamps' => true
    ];

    public $form_name;

    public $education_types_list=[];
    public $education='';
    public $educationID='';
    public $selectedCheckbox=[];
    public $formBackup;
    public $form1Backup;
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
            'form1.name.required' => 'Required',
            'form1.name.min' => ':attribute must be min 4 character long',
            'form1.name.unique' => ':attribute already exits',
            'form.position.required' => 'Position is required',
            'form.position.integer' => ':attribute must be an integer',
            'form.position.gt' => ':attribute must be a positive integer',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'education',
            'form1.name' => ($this->form1['name'] != '') ? $this->form1['name'] : 'education type',
            'form.position' => ($this->form['position'] != '') ? $this->form['position'] : 'Step',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:educations,name,' . $this->crudID,'min:4'],
            'form.position' => ['required', 'integer','gt:0'],
        ];
    }

    public function education_type_rules()
    {
        return [
            'form1.name' => ['required', 'unique:education_types,name,' . $this->crudID,'min:4'],
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
            case "form1.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
            case 'form1.acronym':
                $this->form1['acronym']=Data::capitalize_each_word($this->form1['acronym']);
        }
    }


    public function updated($field)
    {
        switch ($field) {
            case "form.name":
            case "form1.name":
            case "form.position":
                $this->validateOnly($field);
                break;
            case 'form1.acronym':
//                if($field=='' || $field==null){
//                    $this->form1['acronym']='';
//                }
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

    public function passingData($value){
        $this->educationID=$value;

    }

// CRUD BUTTON

    public function education_create_button($modalID)
    {
        $this->clearFields();
    }

    public function education_update_button($id, $modalID)
    {
        $this->resetErrorBag();
        $this->crudID = $id;
        $education = Query::education_with_types($id);

        $this->getRecords($education);
    }

    public function education_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $education = Query::education($id);
        $this->deleteMessage = Data::deleteMessage('education', $education->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_education_create($id,$modalID)
    {

        $this->validate();
        $this->data_formatter($this->form, 'form');

        $education = new \App\Models\Educations();
        $this->submit($crud = 'create', $mID = $modalID, $records = $education, $name = 'education', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_education_update($id, $modalID)
    {

        $this->validate();
        $this->data_formatter($this->form, 'form');
        $education = Query::education($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $education, $name = 'education', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_education_delete($id, $modalID)
    {
        $education = Query::education($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $education, $name = 'Passport- '.$education->education_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->education = null;
    }

// EDUCATION TYPE
    public function education_type_create_button($modalID)
    {
        $this->clearFields();
    }

    public function education_type_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $education_type = Query::education_type($id);
        $this->getRecords($education_type,$this->submitFields1,'form1');

    }

    public function education_type_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $education = Query::education_type($id);
        $this->deleteMessage = Data::deleteMessage('education', $education->name);
    }
    public function submit_education_type_create($id, $modalID)
    {
        $this->validate($this->education_type_rules());
        $this->data_formatter($this->form1, 'form1');
        $this->form1['education_id'] = $this->educationID;
        $step = new \App\Models\EducationTypes();
        $this->submit($crud = 'create', $mID = $modalID, $records = $step, $name = 'step', $fields = $this->submitFields1, $data = $this->form1);
    }

    public function submit_education_type_update($id, $modalID)
    {
        $this->validate($this->education_type_rules());
        $this->data_formatter($this->form1, 'form1');
        $education_type = Query::education_type($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $education_type, $name = $education_type->name, $fields = $this->submitFields1, $data = $this->form1, null, null, null,);
    }

    public function submit_education_type_delete($id, $modalID)
    {
        $education_type = Query::education_type($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $education_type, $name = $education_type->name, $fields = $this->submitFields1, $data = $this->form1, null, null, null,);
        $this->education_type = null;
    }
    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        if (in_array('Manager', $userRole)) {
            $educations =\App\Models\Educations::with('education_types')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } elseif (in_array('User', $userRole)) {
            $educations = \App\Models\Educations::where('id',0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'educations'=>$educations,
                'currentPage' => Quicker::currentPage($educations),
                'perPage' => Quicker::perPage($educations),
                'total' => Quicker::total($educations)
            ])
            ->layout('layouts.app');
    }

}
