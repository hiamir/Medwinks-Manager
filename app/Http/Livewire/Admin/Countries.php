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


class Countries extends Component
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
    public $searchFields = ['id' => 'ID', 'country' => 'Country', 'phone_prefix' => 'Phone Prefix', 'currency_name' => 'Currency Name', 'created_at' => 'Created at'];
    public $submitFields = ['country' => 'name', 'iso' => 'iso', 'iso3' => 'iso3', 'fips' => 'fips', 'continent' => 'continent', 'currency_code' => 'currency_code', 'currency_name' => 'currency_name', 'postal_code' => 'postal_code', 'phone_prefix' => 'phone_prefix', 'languages' => 'languages', 'geonameid' => 'geonameid'];
    public $form = [
        'name'=>null,
        'iso'=>null,
        'iso3'=>null,
        'fips'=>null,
        'continent'=>null,
        'postal_code'=>null,
        'currency_code'=>null,
        'currency_name'=>null,
        'languages'=>null,
        'geonameid'=>null,
        'phone_prefix'=>null,
        'trash' => false,
        'timestamps' => false
    ];
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $countryList;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public function rules()
    {
        return [
            'form.name' => 'required|min:4|unique:countries,country,' . $this->crudID,
            'form.iso' => 'required|alpha|min:2|max:2|unique:countries,iso,' . $this->crudID,
            'form.iso3' => 'required|alpha|min:3|max:3|unique:countries,iso3,' . $this->crudID,
            'form.fips' => 'required|alpha|min:2|max:2|max:2|unique:countries,fips,' . $this->crudID,
            'form.continent' => 'required|alpha||min:2|max:2',
            'form.currency_code' => 'required|alpha|min:3|max:3',
            'form.currency_name' => 'required|min:2',
            'form.phone_prefix' => 'required|min:2|regex:/^([0-9\s\-\+\(\)]*)$/',
            'form.postal_code' => '',
            'form.languages' => 'required|regex:/^[A-Za-z,\-]+$/',
            'form.geonameid' => 'required|numeric|unique:countries,geonameid,' . $this->crudID,
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
        switch ($field) {
            case 'form.name':
            case 'form.iso':
            case 'form.iso3':
            case 'form.fips':
            case 'form.geonameid':
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

            case "form.iso":
                $this->form['iso'] = Data::all_upper_case($this->form['iso']);
                break;

            case "form.iso3":
                $this->form['iso3'] = Data::all_upper_case($this->form['iso3']);
                break;

            case "form.fips":
                $this->form['fips'] = Data::all_upper_case($this->form['fips']);
                break;

            case "form.currency_name":
                $this->form['currency_name'] = Data::capitalize_first_word($this->form['currency_name']);
                break;

            case "form.currency_code":
                $this->form['currency_code'] = Data::all_upper_case($this->form['currency_code']);
                break;

            case "form.continent":
                $this->form['continent'] = Data::all_upper_case($this->form['continent']);
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

    public function country_create_button($modalID)
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

    public function country_update_button($id, $modalID)
    {

        $this->crudID = $id;
        $record = Query::country($id);
        foreach ($this->submitFields as $recordField => $formField) {
            $this->form[$formField] = $record->$recordField;
        }
    }

    public function country_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $country = Query::country_with_regions($id);
        $this->deleteMessage = Data::deleteMessage('Country', $country->country, 'regions', count($country->regions));
    }

// CRUD BUTTON

    public function submit_country_create($modalID)
    {
        $this->validateTryCatch();
        $this->data_formatter($this->form, 'form');

        $step = new \App\Models\Countries();
        $this->submit($crud = 'create', $mID = $modalID, $records = $step, $name = 'Country', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_country_update($id, $modalID)
    {
        $this->validateTryCatch();
        $this->data_formatter($this->form, 'form');
        $step = Query::country($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $step, $name = 'country', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

// CRUD SUBMIT

    public function submit_country_delete($id, $modalID)
    {
        $country = Query::country($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $country, $name = $country->name, $fields = $this->submitFields, $data = $this->form);
        $this->country = null;
    }

    public function render()
    {
        if ($this->error === false) {
            $records = \App\Models\Countries::
            with('regions')
                ->orwhere('country', 'like', '%' . $this->search . '%')
                ->orWhere('phone_prefix', 'like', '%' . $this->search . '%')
                ->orWhere('currency_name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);

            return view($this->routeIndex, [
                'countries' => $this->readyToLoad ? $records : $records,
                'currentPage' => Quicker::currentPage($records),
                'perPage' => Quicker::perPage($records),
                'total' => Quicker::total($records)
            ])->layout('layouts.app');
        } else {
            $roles = Query::company(0);
            return view($this->routeIndex,
                [
                    'roles' => $roles,

                ])->layout('layouts.app');
        }
    }

    protected function messages()
    {
        return [
            'form.country.required' => ':attribute name is required',
            'form.country.alpha' => ':attribute must be alphabets only',
            'form.country.min' => ':attribute must be 4 characters long',
            "form.iso.required" => "ISO is required",
            "form.iso.alpha" => "ISO must be alphabets",
            "form.iso.min" => "ISO requires minimum  2 characters",
            "form.iso.max" => "ISO requires maximum 2 characters",
            "form.iso.unique" => "ISO already exists",
            "form.iso3.required" => "ISO3 is required",
            "form.iso3.alpha" => "ISO must be alphabets",
            "form.iso3.min" => "ISO3 requires minimum  3 characters",
            "form.iso3.max" => "ISO3 requires maximum 3 characters",
            "form.iso3.unique" => "ISO3 already exists",
            "form.fips.required" => "Fips is required",
            "form.fips.alpha" => "Fips must be alphabets",
            "form.fips.min" => "Fips requires minimum characters",
            "form.fips.max" => "Fips requires maximum 2 characters",
            "form.fips.unique" => "Fips already exists",
            "form.continent.required" => "Continent is required",
            "form.continent.alpha" => "Continent must be alphabets",
            "form.continent.min" => "Continent requires minimum characters",
            "form.continent.max" => "Continent requires  maximum 2 characters",
            "form.currency_code.required" => "Continent is required",
            "form.currency_code.alpha" => "Currency Code must be alphabets",
            "form.currency_code" => "Currency Code must be alphabets",
            "form.currency_code.min" => "Continent requires minimum 3 characters",
            "form.currency_code.max" => "Continent requires maximum 3 characters",
            "form.currency_name.required" => "Continent is required",
            "form.currency_name.min" => "Continent requires minimum 2 characters",
            "form.postal_code.required" => "Postal code is required",
            "form.languages.required" => "Languages is required",
            "form.languages.regex" => "Languages must only have alhpa characters and dash",
            "form.phone_prefix.required" => "Phone prefix is required",
            "form.phone_prefix.min" => "Phone prefix requires minimum 2 characters",
            "form.phone_prefix.regex" => "Phone prefix must only contain integers [0-9], +, -",
            "form.geonameid.required" => ":attribute is required",
            "form.geonameid.numeric" => "Geonameid must be integer",
            "form.geonameid.unique" => ":attribute is already taken",
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Country',
            'form.position' => ($this->form['name'] != '') ? $this->form['name'] : 'Country',
            'form.geonameid' => ($this->form['geonameid'] != '') ? $this->form['geonameid'] : 'Geonameid',
        ];
    }
}






