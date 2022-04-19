<?php

namespace App\Http\Livewire\Admin;

use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Livewire\Component;
use Livewire\WithPagination;

class Regions extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;

    protected $access = 'view-admin-regions';
    protected $routeName = "admin.regions";
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public $pageName = null;
    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = ['id' => 'ID', 'countries_id' => 'Country', 'name' => 'Region', 'timezone' => 'Time Zone', 'created_at' => 'Created at'];
    public $submitFields = ['countries_id' => 'country', 'name' => 'name', 'timezone' => 'timezone'];
    public $form = ['country'=>null,'name'=>null,'timezone'=>null,'trash' => false, 'timestamps' => true];
    public $formBackup=[];
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $countryList;


    protected function messages()
    {
        return [
            'form.name.required' => ':attribute name is required',
            'form.name.alpha' => ':attribute must be alphabets only',
            'form.country.required' => 'Country is required',
            "form.country.integer" => "Country must be integer",
            "form.country.gt" => "Country must be > 0",
            "form.timezone.required" => "Timezone is required",
            "form.timezone.timezone" => ":attribute is not a valid timezone",

        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Region',
            'form.timezone' => ($this->form['timezone'] != '') ? $this->form['timezone'] : 'Timezone',

        ];
    }

    public function rules()
    {
        return [
            'form.name' => 'required|alpha|min:4',
            'form.country' => 'required|integer|gt:0',
            'form.timezone' => 'required|timezone',
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
        $this->formBackup=$this->form;
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
        $this->countries = \App\Models\Countries::all();
        $this->countryList = TableFilter::selectListNames($this->countries, 'id','country');
    }

    public function updated($field)
    {

    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
                break;
        }
    }

    public function refreshPage()
    {
        $this->resetPage();
    }

    public function updatingPageno()
    {
        $this->resetPage();
    }

// CRUD BUTTON

    public function region_create_button($modalID)
    {
        $this->crudID = null;
        $this->clearFields($this->submitFields);
    }

    public function region_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $region = Query::region($id);
        $this->getRecords($region);
    }

    public function region_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $region = Query::region($id);
        $this->deleteMessage = Data::deleteMessage('Region', $region->name);
    }

// CRUD SUBMIT

    public function submit_region_create($modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $region = new \App\Models\Regions();
        $this->submit($crud = 'create', $mID = $modalID, $records = $region, $name = 'region', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_region_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $region = Query::region($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $region, $name = 'region', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_region_delete($id, $modalID)
    {
        $region = Query::region($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $region, $name = $region->name, $fields = $this->submitFields, $data = $this->form);
        $this->region = null;
    }

    public function render()
    {
        $regions = \App\Models\Regions::
        with(['country' => function () {
        }])
            ->whereHas('country', function ($q) {
                $q->where('country', 'like', '%' . $this->search . '%');
            })
            ->orwhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('timezone', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->pageNo);

        return view($this->routeIndex, [
            'regions' => $regions,
            'currentPage' => Quicker::currentPage($regions),
            'perPage' => Quicker::perPage($regions),
            'total' => Quicker::total($regions)
        ])->layout('layouts.app');

    }

}



