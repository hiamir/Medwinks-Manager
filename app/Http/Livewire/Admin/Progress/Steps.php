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
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Steps extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;

    public $pageName = "Steps";
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
        'position' => 'Position'
    ];

    public $submitFields = [
        'name' => 'name',
        'position' => 'position',
        'processes_id'=>'process'
    ];
    public $form = [
        'name' => null,
        'position' => null,
        'process'=>null,
        'trash' => false,
        'timestamps' => true
    ];
    public $selectedCheckbox = [];
    public $formBackup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];

    public $disabled = 'false';

    protected function messages()
    {
        return [
            'form.name.required' => 'Required',
            'form.name.min' => 'Name must be min 4 character long',
            'form.position.required' => 'Position is required',
            'form.position.integer' => ':attribute must be an integer',
            'form.position.gt' => ':attribute must be a positive integer',
            'form.process.required'=>'Required'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Step',
            'form.position' => ($this->form['position'] != '') ? $this->form['position'] : 'Step',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:steps,name,' . $this->crudID, 'min:4'],
            'form.position' => ['required', 'integer','gt:0'],
            'form.process'=>['required']
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
            case "form.position":
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

    public function step_create_button($modalID)
    {
        $this->clearFields();
    }

    public function step_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $step = Query::step($id);
        $this->getRecords($step);
    }

    public function step_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $step = Query::step($id);
        $this->deleteMessage = Data::deleteMessage('Service', $step->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_step_create($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $step = new \App\Models\Steps();
        $this->submit($crud = 'create', $mID = $modalID, $records = $step, $name = 'step', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_step_update($id, $modalID)
    {
        $this->validateTryCatch();
        $this->data_formatter($this->form, 'form');
        $step = Query::step($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $step, $name = 'step', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_step_delete($id, $modalID)
    {
        $step = Query::step($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $step, $name = 'Passport- ' . $step->step_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->step = null;
    }


    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        $processList=\App\Models\Processes::select('id','name')->get();
        if (in_array('Admin', $userRole)) {
            $steps = \App\Models\Steps::
            where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } else{
            $steps = \App\Models\Steps::where('id', 0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'steps' => $steps,
                'processList'=>$processList,
                'currentPage' => Quicker::currentPage($steps),
                'perPage' => Quicker::perPage($steps),
                'total' => Quicker::total($steps)
            ])
            ->layout('layouts.app');
    }

}

