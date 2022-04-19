<?php

namespace App\Http\Livewire;

use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Universities extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;
    public $pageName = "University";
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
        'code' => 'Code'
    ];

    public $submitFields = [
        'name'=>'name',
        'code' => 'code',
    ];
    public $form = [
        'name'=>null,
        'code' => null,
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
            'form.description.required' => 'Required',
            'form.description.min' => ':attribute description must be min 20 character long',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'university',
            'form.description' => ($this->form['name'] != '') ? $this->form['name'] : 'Description',
        ];
    }

    public function rules()
    {
        return [
            'form.name' => ['required', 'unique:universities,name,' . $this->crudID,'min:4'],
            'form.code' => 'required'
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
            case "form.code":
                $this->form['code'] = Data::all_upper_case($this->form['code']);
                break;
        }
    }


    public function updated($field)
    {
        switch ($field) {
            case "form.name":
            case "form.code":
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

    public function university_create_button($modalID)
    {
        $this->clearFields();
    }

    public function university_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $university = Query::university($id);
        $this->getRecords($university);
    }

    public function university_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $university = Query::university($id);
        $this->deleteMessage = Data::deleteMessage('university', $university->name);
    }

// CRUD SUBMIT

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_university_create($id,$modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');

        $university = new \App\Models\Universities();
        $this->submit($crud = 'create', $mID = $modalID, $records = $university, $name = 'university', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_university_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $university = Query::university($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $university, $name = 'university', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

    public function submit_university_delete($id, $modalID)
    {
        $university = Query::university($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $university, $name = 'Passport- '.$university->university_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->university = null;
    }


    public function render()
    {
        $userRole = json_decode(auth()->user()->roles->pluck('name'));
        if (in_array('Manager', $userRole)) {
            $universities =\App\Models\Universities::
                where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } elseif (in_array('User', $userRole)) {
            $universities = \App\Models\Universities::where('id',0)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
        return view($this->routeIndex,
            [
                'universities' => $universities,
                'currentPage' => Quicker::currentPage($universities),
                'perPage' => Quicker::perPage($universities),
                'total' => Quicker::total($universities)
            ])
            ->layout('layouts.app');
    }

}
