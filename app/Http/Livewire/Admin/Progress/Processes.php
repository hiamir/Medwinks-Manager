<?php


namespace App\Http\Livewire\Admin\Progress;

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
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Processes extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;

    public $pageName = "Processes";
    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = [
        'id' => 'ID',
        'name' => 'Name',
        'reference' => 'Reference'
    ];
    public $submitFields = [
        'name' => 'name',
        'reference' => 'reference',
    ];
    public $submitFields1 = [
        'name' => 'name',
        'position' => 'position',
        'processes_id' => 'processes_id',
    ];
    public $form = [
        'name' => null,
        'reference'=>null,
        'trash' => false,
        'timestamps' => true
    ];
    public $form1 = [
        'name' => null,
        'position' => null,
        'processes_id' => null,
        'trash' => false,
        'timestamps' => true
    ];
    public $processes_id = null;
    public $process_id = null;
    public $selectedCheckbox = [];
    public $formBackup;
    public $form1Backup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $disabled = 'false';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage','passingData'];

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:processes,name,' . $this->crudID, 'min:4'],
            'form.reference' => ['required', 'unique:processes,reference,' . $this->crudID, 'min:3'],
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
        $this->form1Backup = $this->form1;
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
            case "form1.name":
                $this->form1['name'] = Data::capitalize_first_word($this->form1['name']);
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

            case "form1.name":
            case "form1.position":
            case "form1.processes_id":
                $this->validate($this->form1_rules($field));
                break;

        }

    }

    public function form1_rules($field=null)
    {
        if ($field == null) {
            return [
                'form1.name' => ['required', 'min:4'],
                'form1.position' => ['required', 'integer', 'gt:0'],
            ];
        } else {

            switch ($field) {
                case'form1.name':
                    return ['form1.name' => ['required', 'min:4']];
                case'form1.position':
                    return ['form1.position' => ['required', 'integer', 'gt:0']];
            }
        }
    }

    public function passingData($id){
        $this->process_id=$id;
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

    public function process_create_button($modalID)
    {
        $this->clearFields();
    }

    public function process_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $service = Query::process($id);
        $this->getRecords($service);
    }

// CRUD BUTTON

    public function process_delete_button($id, $modalID)
    {
        $this->form1['trash'] = false;
        $service = Query::process($id);
        $this->deleteMessage = Data::deleteMessage('Service', $service->name);
    }

    public function step_create_button($modalID)
    {
        $this->clearFields('form1');
    }

    public function step_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $step = Query::step($id);
        $this->getRecords($step, $this->submitFields1, 'form1');
    }

//STEP

    public function step_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $step = Query::step($id);
        $this->deleteMessage = Data::deleteMessage('Step', $step->name);
    }

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_process_create($id, $modalID)
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emitSelf('validation-error',$e);
            $this->validate();
        }
        $this->data_formatter($this->form, 'form');

        $service = new \App\Models\Processes();
        $this->submit($crud = 'create', $mID = $modalID, $records = $service, $name = 'process', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_process_update($id, $modalID)
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emitSelf('validation-error',$e);
            $this->validate();
        }

        $this->data_formatter($this->form, 'form');
        $service = Query::process($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $service, $name = 'process', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

// CRUD SUBMIT

    public function submit_process_delete($id, $modalID)
    {
        $service = Query::process($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $service, $name = 'Passport- ' . $service->process_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->process = null;
    }

    public function submit_step_create($id, $modalID)
    {
        try {
            $this->validate($this->form1_rules());
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emitSelf('validation-error',$e);
            $this->validate($this->form1_rules());
        }
        $this->form1['processes_id']=$this->process_id;
        $this->data_formatter($this->form1, 'form1');
        $step = new \App\Models\Steps();
        $this->submit($crud = 'create', $mID = $modalID, $records = $step, $name = 'step', $fields = $this->submitFields1, $data = $this->form1);
    }

    public function submit_step_update($id, $modalID)
    {
        try {
            $this->validate($this->form1_rules());
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emitSelf('validation-error',$e);
            $this->validate($this->form1_rules());
        }
        $this->data_formatter($this->form1, 'form1');
        $step = Query::step($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $step, $name = 'step', $fields = $this->submitFields1, $data = $this->form1, null, null, null,);
    }


    //STEPS

    public function submit_step_delete($id, $modalID)
    {
        $step = Query::step($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $step, $name = 'Step- ' . $step->step_number, $fields = $this->submitFields1, $data = $this->form1, null, null, null,);
        $this->step = null;
    }

    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        if (in_array('Admin', $userRole)) {
            $processes = \App\Models\Processes::with(['steps' => function ($q) {
                $q->orderBy('position', 'asc');
            }])
                ->where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } else {
            $processes = \App\Models\Processes::where('id', 0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'processes' => $processes,
                'currentPage' => Quicker::currentPage($processes),
                'perPage' => Quicker::perPage($processes),
                'total' => Quicker::total($processes)
            ])
            ->layout('layouts.app');
    }

    protected function messages()
    {
        return [
            'form.name.required' => 'Required',
            'form.name.min' => 'Name must be min 4 character long',
            'form.reference.required' => 'Required',
            'form.reference.min' => ':attribute must be min 3 character long',
            'form.reference.unique' => ':attribute name already taken',
            'form1.name.min' => 'Name must be min 4 character long',
            'form1.position.required' => 'Position is required',
            'form1.position.integer' => ':attribute must be an integer',
            'form1.position.gt' => ':attribute must be a positive integer',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Process',
            'form.reference' => ($this->form['reference'] != '') ? $this->form['reference'] : 'Reference',
            'form1.name' => ($this->form1['name'] != '') ? $this->form1['name'] : 'Position',
            'form1.position' => ($this->form1['position'] != '') ? $this->form1['position'] : 'Position',

        ];
    }

}

