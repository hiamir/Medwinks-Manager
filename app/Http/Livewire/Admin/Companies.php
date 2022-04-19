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

class Companies extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage', 'company', 'passingData'];

    public $pageName = "Companies";
    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'asc';
    public $search = '';
    public $searchFields = ['id' => 'ID', 'name' => 'Company', 'description' => 'Description', 'website' => 'Website', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'description' => 'description', 'website' => 'website'];
    public $submitFields2 = ['name' => 'name', 'companies_id' => 'companyID', 'description' => 'description', 'website' => 'website'];
    public $submitFields3 = [
        'address_type_id' => 'address_type',
        'address_line1' => 'address_line1',
        'address_line2' => 'address_line2',
        'postal_code' => 'postal_code',
        'zip_code' => 'zip_code',
        'countries_id' => 'country',
        'regions_id' => 'region',
//        'created_by' => 'created_by',
//        'updated_by' => 'updated_by'
    ];

    public $form1 = ['name' => null, 'description' => null, 'website' => null, 'trash' => false, 'timestamps' => true];
    public $form2 = ['name' => null, 'companyID' => null, 'description' => null, 'website' => null, 'trash' => false, 'timestamps' => true];
    public $form3 = [
        'address_type' => '',
        'address_line1' => null,
        'address_line2' => null,
        'postal_code' => null,
        'zip_code' => null,
        'country' => '',
        'region' => '',
//        'created_by' => null,
//        'updated_by' => null,
        'trash' => false,
        'timestamps' => true];
    public $form1Backup;
    public $form2Backup;
    public $form3Backup;
    public $crudName = "company";
    public $divisionEmit = "divisionID";
    public $adminMessage = 'Error creating new Admin user. Please contact Administrator';
    public $companyID;
    public $crudID = null;
    public $divisionID = null;
    public $divisionName = null;
    public $deleteMessage;
    public $session;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $addressTypeList = [];
    public $countryList = [];
    public $regionList = [];

    protected function messages()
    {

        return [
            'form1.name.required' => ':attribute name is required',
            'form1.name.min' => 'Name must be min 4 character long',
            'form1.name.regex' => ':attribute must have alphabets, brackets and spaces only',
            'form1.name.unique' => ':attribute already assigned',
            'form1.description.required' => ':attribute description is required',
            'form1.website.required' => 'Please give website address form :attribute',
            'form1.website.url' => ':attribute website address not valid url',
            'form2.name.required' => ':attribute name is required',
            'form2.name.min' => 'Name must be min 4 character long',
            'form2.name.regex' => ':attribute must have alphabets, brackets and spaces only',
            'form2.name.unique' => ':attribute already assigned',
            'form2.description.required' => ':attribute description is required',
            'form2.website.required' => 'Please give website address form :attribute',
            'form2.website.url' => ':attribute website address not valid url',
            'form2.companyID.required' => $this->adminMessage,
            'form2.companyID.integer' => $this->adminMessage,
            'form2.companyID.exists' => $this->adminMessage,
            'form3.address_type' => ':attribute name is required',
            'form3.address_line1' => ':attribute name is required',
            'form3.address_line2' => ':attribute name is required',
            'form3.postal_code' => ':attribute name is required',
            'form3.country' => ':attribute name is required',
            'form3.region' => ':attribute name is required',
        ];
    }

    protected function validationAttributes($field = null)
    {
        $fields = [
            'form1.name' => ($this->form1['name'] != '') ? $this->form1['name'] : 'Company',
            'form1.description' => ($this->form1['name'] != '') ? $this->form1['name'] : 'Company',
            'form1.website' => ($this->form1['name'] != '') ? $this->form1['name'] : 'Company',
            'form2.name' => ($this->form2['name'] != '') ? $this->form2['name'] : 'Division',
            'form2.description' => ($this->form2['name'] != '') ? $this->form2['name'] : 'Division',
            'form2.website' => ($this->form2['name'] != '') ? $this->form2['name'] : 'Division',
            'form3.address_type' => 'Address type',
            'form3.address_line1' => 'Line1',
            'form3.address_line2' => 'Line2',
            'form3.postal_code' => 'Postal code',
            'form3.country' => 'Country',
            'form3.region' => 'Region',
        ];
        if ($field) {
            return ($field($field));
        } else {
            return $fields;
        }
    }

    public function rules()
    {
        return [
            'form1.name' => 'required|regex:/^[A-Za-z0-9,\s,(,)]+$/|min:4|unique:companies,name,' . $this->crudID,
            'form1.description' => 'required',
            'form1.website' => 'required|url',
            'form2.name' => 'required|regex:/^[A-Za-z0-9,\s,(,)]+$/|min:4|unique:divisions,name,' . $this->crudID,
            'form2.description' => 'required',
            'form2.website' => 'required|url',
//            'form2.country' => 'required|integer|exists:companies,id',
            'form3.address_type' => 'required',
            'form3.address_line1' => 'required',
            'form3.address_line2' => 'required',
            'form3.postal_code' => 'required',
            'form3.country' => 'required',
            'form3.region' => 'required',
        ];
    }


    public function hydrate()
    {
    }


    public function mount()
    {
        $this->securityGate();
        $this->form1Backup = $this->form1;
        $this->form2Backup = $this->form2;
        $this->form3Backup = $this->form3;
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
        $this->addressTypeList = TableFilter::selectListNames(\App\Models\AddressType::all(), 'id', 'name');
        $this->countryList = TableFilter::selectListNames(\App\Models\Countries::all(), 'id', 'country');
    }

    public function updated($field)
    {

        switch ($field) {
            case "form1.name":
            case "form1.description":
            case "form1.website":
            case "form2.name":
            case "form2.description":
            case "form2.website":
            case 'form3.address_type':
            case 'form3.address_line1':
            case 'form3.address_line2':
            case 'form3.postal_code':
            case 'form3.region':
                $this->validateOnly($field);
                break;
            case 'form3.country':
                $this->regionList = TableFilter::selectListNames(Query::region_sort_country($this->form3['country']), 'id', 'name');
                $this->validateOnly($field);
                break;
        }
    }

    public function inputFinisher($field)
    {
        switch ($field) {

            case "form1.name":
                $this->form1['name'] = Data::capitalize_each_word($this->form1['name']);
                break;
            case "form1.website":
                $this->form1['website'] = Data::all_lower_case($this->form1['website']);
                break;
            case "form2.name":
                $this->form2['name'] = Data::capitalize_each_word($this->form2['name']);
                break;
            case "form2.website":
                $this->form2['website'] = Data::all_lower_case($this->form2['website']);
                break;
        }
    }

    public function company($id)
    {
        $this->companyID = $id;
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


    public function passingData($division)
    {
        $this->divisionID = $division;

    }

// CRUD BUTTON

    public function company_create_button($modalID)
    {

        $this->session = 'company';
        $this->crudID = '';

        $this->clearFields('form1');


    }

    public function company_update_button($id, $modalID)
    {

        $this->crudID = $id;
        $company = Query::company($id);
        $this->getRecords($company, $this->submitFields, 'form1');
    }

    public function company_delete_button($id, $modalID)
    {
        $this->form1['trash'] = false;
        $company = Query::company_with_divisions($id);
        $this->deleteMessage = Data::deleteMessage('Company', $company->name, 'links', count($company->divisions));
    }

// CRUD COMPANY

    public function submit_company_create($modalID)
    {
        $this->validateOnly('form1.name');
        $this->validateOnly('form1.description');
        $this->validateOnly('form1.website');
        $this->data_formatter($this->form1, 'form1');

        $company = new \App\Models\Companies();

        $this->submit($crud = "create", $mID = $modalID, $records = $company, $name = "company", $fields = $this->submitFields, $data = $this->form1, $customCreate = null, $customUpdate = null, $customDelete = null);

    }

    public function division_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $division = Query::division($id);
        $this->getRecords($division, $this->submitFields2, 'form2');
    }

    public function submit_company_update($id, $modalID)
    {
        $this->validateOnly('form1.name');
        $this->validateOnly('form1.description');
        $this->validateOnly('form1.website');
        $this->data_formatter($this->form1, 'form1');
        $company = Query::company($id);
        $this->submit($crud = "update", $mID = $modalID, $records = $company, $name = $company->name, $fields = $this->submitFields, $data = $this->form1, $customCreate = null, $customUpdate = null, $customDelete = null);
    }

    public function submit_company_delete($id, $modalID)
    {
        $company = Query::company($id);
        $this->submit($crud = "delete", $mID = $modalID, $records = $company, $name = $company->name, $fields = $this->submitFields, $data = $this->form1, $customCreate = null, $customUpdate = null, $customDelete = null);
        $this->company = null;
    }


//    CURD DIVISION

    public function division_create_button($modalID)
    {
        $this->clearFields('form2');
//        $this->clearFields($this->submitFields2,'form2');

    }

    public function submit_division_create($modalID)
    {
        $this->validateOnly('form2.name');
        $this->validateOnly('form2.description');
        $this->validateOnly('form2.website');
        $this->data_formatter($this->form2, 'form2');

        $this->form2['companyID'] = $this->companyID;
        $this->validateOnly('form2.companyID');
        $division = new \App\Models\Divisions();
        $this->submit($crud = "create", $mID = $modalID, $records = $division, $name = 'division', $fields = $this->submitFields2, $data = $this->form2, $customCreate = null, $customUpdate = null, $customDelete = null);


    }

    public function submit_division_update($id, $modalID)
    {

        $this->validateOnly('form2.name');
        $this->validateOnly('form2.description');
        $this->validateOnly('form2.website');
        $this->data_formatter($this->form2, 'form2');
        $division = Query::division($id);
        $division->name = $this->form2['name'];
        $division->description = $this->form2['description'];
        $division->website = $this->form2['website'];
        $this->submit($crud = "update", $mID = $modalID, $records = $division, $name = $division->name, $fields = $this->submitFields2, $data = $this->form2, $customCreate = null, $customUpdate = $division, $customDelete = null);
    }

    public function division_delete_button($id, $modalID)
    {
        $this->form2['trash'] = false;
        $division = Query::division($id);
        $this->deleteMessage = Data::deleteMessage('Division', $division->name);
    }

    public function submit_division_delete($id, $modalID)
    {
        $division = Query::division($id);
        $this->submit($crud = "delete", $mID = $modalID, $records = $division, $name = $division->name, $fields = $this->submitFields2, $data = $this->form2, $customCreate = null, $customUpdate = null, $customDelete = null);
        $this->division = null;
    }


    //ADDRESS

    public function address_company_create_button($modalID)
    {
        $this->session = 'company';
        $this->form3 = $this->form3Backup;
    }

    public function address_create_button($modalID)
    {
        $this->form3 = $this->form3Backup;
//        $this->clearFields($this->submitFields3,'form3');
    }

    public function address_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $address = Query::address($id);
        $this->regionList = TableFilter::selectListNames(Query::region_sort_country($address->countries_id), 'id', 'name');
        $this->getRecords($address, $this->submitFields3, 'form3');
    }

    public function address_company_update_button($id, $modalID)
    {
        $this->crudID = $id;

        $address = Query::address($id);
        $this->regionList = TableFilter::selectListNames(Query::region_sort_country($address->countries_id), 'id', 'name');
        $this->getRecords($address, $this->submitFields3, 'form3');
    }

    public function address_delete_button($id, $modalID)
    {
        $this->form3['trash'] = false;
        $address = Query::address($id);
        $this->deleteMessage = Data::deleteMessage('Address', $address->address_type->name);
    }

    public function address_company_delete_button($id, $modalID)
    {
        $this->form3['trash'] = false;
        $address = Query::address($id);
        $this->deleteMessage = Data::deleteMessage('Address', $address->address_type->name);
    }


    public function submit_address_company_create($modalID)
    {

        $this->validateOnly('form3.address_type');
        $this->validateOnly('form3.address_line1');
        $this->validateOnly('form3.address_line2');
        $this->validateOnly('form3.postal_code');
        $this->validateOnly('form3.zip_code');
        $this->validateOnly('form3.website');
        $this->validateOnly('form3.country');
        $this->validateOnly('form3.region');


        $this->data_formatter($this->form3, 'form3');
        $company = Query::company($this->companyID);
        if(count($company->addresses)===0) {
            $addresses = $company->addresses()
                ->create([
                    'address_type_id' => $this->form3['address_type'],
                    'address_line1' => $this->form3['address_line1'],
                    'address_line2' => $this->form3['address_line2'],
                    'postal_code' => $this->form3['postal_code'],
                    'zip_code' => $this->form3['zip_code'],
                    'countries_id' => $this->form3['country'],
                    'regions_id' => $this->form3['region'],
                ]);
            $this->submit($crud = "create", $mID = $modalID, $records = $addresses, $name = 'Address', $fields = $this->submitFields3, $data = $this->form3, $customCreate = $addresses, $customUpdate = null, $customDelete = null);
        }
    }


    public function submit_address_create($modalID)
    {
        $this->validateOnly('form3.address_type');
        $this->validateOnly('form3.address_line1');
        $this->validateOnly('form3.address_line2');
        $this->validateOnly('form3.postal_code');
        $this->validateOnly('form3.zip_code');
        $this->validateOnly('form3.website');
        $this->validateOnly('form3.country');
        $this->validateOnly('form3.region');


        $this->data_formatter($this->form3, 'form3');
        $division = Query::division($this->divisionID);

        $addresses = $division->addresses()
            ->create([
                'address_type_id' => $this->form3['address_type'],
                'address_line1' => $this->form3['address_line1'],
                'address_line2' => $this->form3['address_line2'],
                'postal_code' => $this->form3['postal_code'],
                'zip_code' => $this->form3['zip_code'],
                'countries_id' => $this->form3['country'],
                'regions_id' => $this->form3['region'],
            ]);
        $this->submit($crud = "create", $mID = $modalID, $records = $addresses, $name = 'Address', $fields = $this->submitFields3, $data = $this->form3, $customCreate = $addresses, $customUpdate = null, $customDelete = null);
    }

    public function submit_address_update($id, $modalID)
    {
        $this->validateOnly('form3.address_type');
        $this->validateOnly('form3.address_line1');
        $this->validateOnly('form3.address_line2');
        $this->validateOnly('form3.postal_code');
        $this->validateOnly('form3.zip_code');
        $this->validateOnly('form3.website');
        $this->validateOnly('form3.country');
        $this->validateOnly('form3.region');

        $this->data_formatter($this->form3, 'form3');

        $address = Query::address($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $address, $name = 'address_type', $fields = $this->submitFields3, $data = $this->form3, null, null, null,);
    }

    public function submit_address_company_update($id, $modalID)
    {
        $this->validateOnly('form3.address_type');
        $this->validateOnly('form3.address_line1');
        $this->validateOnly('form3.address_line2');
        $this->validateOnly('form3.postal_code');
        $this->validateOnly('form3.zip_code');
        $this->validateOnly('form3.website');
        $this->validateOnly('form3.country');
        $this->validateOnly('form3.region');

        $this->data_formatter($this->form3, 'form3');
        $address = Query::address($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $address, $name = 'Company address', $fields = $this->submitFields3, $data = $this->form3, null, null, null,);
    }


    public function submit_address_delete($id, $modalID)
    {
        $address = Query::address($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $address, $name = 'address_type', $fields = $this->submitFields3, $data = $this->form3, null, null, null,);
        $this->address_type = null;
    }

    public function submit_address_company_delete($id, $modalID)
    {
        $address = Query::address($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $address, $name = 'address_type', $fields = $this->submitFields3, $data = $this->form3, null, null, null,);
        $this->address_type = null;
    }

    public function render()
    {
        $companies = \App\Models\Companies::with(['addresses' => function ($a) {
            $a->with('address_type', 'country', 'region');
            },
            'divisions' => function ($q) {
                $q->with(['addresses' => function ($a) {
                    $a->with('address_type', 'country', 'region');
                }]);
            }])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->pageNo);

        return view($this->routeIndex, [
            'companies' => $this->readyToLoad ? $companies : $companies,
            'currentPage' => Quicker::currentPage($companies),
            'perPage' => Quicker::perPage($companies),
            'total' => Quicker::total($companies)
        ])->layout('layouts.app');
    }
}
