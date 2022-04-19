<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Livewire\Component;
use Livewire\WithPagination;

class Addresses extends Component
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
    public $searchFields = [
        'address_type_id' => 'Address Type',
        'countries_id' => 'Country',
        'created_at' => 'Created at'];
    public $submitFields = [
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
    public $form = [
        'address_type' => null,
        'address_line1' => null,
        'address_line2' => null,
        'postal_code' => null,
        'zip_code' => null,
        'country' => null,
        'region' => null,
//        'created_by' => null,
//        'updated_by' => null,
        'trash' => false,
        'timestamps' => true];
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $addressTypeList = [];
    public $countryList = [];
    public $regionList = [];
    public $menuCategory = [];
    public $checkbox;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public function rules()
    {
        return [
            'form.address_type' => 'required',
            'form.address_line1' => 'required',
            'form.address_line2' => 'required',
            'form.postal_code' => 'required',
            'form.country' => 'required',
            'form.region' => 'required',
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
        $this->addressTypeList = TableFilter::selectListNames(\App\Models\AddressType::all(), 'id','name');
        $this->countryList = TableFilter::selectListNames(\App\Models\Countries::all(), 'id','country');

    }

    public function inputFinisher($field)
    {
//        switch ($field) {
//            case "form.name":
//                $this->form['name'] = Data::capitalize_first_word($this->form['name']);
//                break;
//        }
    }

    public function updated($field)
    {
        switch ($field) {
            case 'form.address_type':
            case 'form.address_line1':
            case 'form.address_line2':
            case 'form.postal_code':

            case 'form.region':
                $this->validateOnly($field);
                break;

            case 'form.country':
                $this->regionList = TableFilter::selectListNames(Query::region_sort_country($this->form['country']), 'id','name');
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

    public function address_create_button($modalID)
    {
        $this->clearFields($this->submitFields);
    }

    public function address_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $address = Query::address($id);
        $this->getRecords($address);
    }

// CRUD BUTTON

    public function address_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $address = Query::address($id);
        $this->deleteMessage = Data::deleteMessage('Address', $address->address_type->name);
    }

    public function submit_address_create($modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $address = new \App\Models\Addresses();
        $this->submit($crud = 'create', $mID = $modalID, $records = $address, $name = 'address', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_address_update($id, $modalID)
    {
        $this->validate();

        $this->data_formatter($this->form, 'form');
        $address = Query::address($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $address, $name = 'address_type', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

// CRUD SUBMIT

    public function submit_address_delete($id, $modalID)
    {
        $address = Query::address($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $address, $name = 'address_type', $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->address_type = null;
    }

//return view('livewire.admin.contact.addresses');
    public function render()
    {

        if ($this->error === false || !$this->authorize($this->access, $this->routeName)) {

            $addresses= \App\Models\Addresses::with('address_type','country','region')
            ->where('address_line1', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);

//            dd($addresses);

            return view($this->routeIndex,
                ['addresses' => $addresses,
                    'currentPage' => Quicker::currentPage($addresses),
                    'perPage' => Quicker::perPage($addresses),
                    'total' => Quicker::total($addresses)])
                ->layout('layouts.app');

        } else {
            $addresses = Query::address_type(0);
            return view($this->routeIndex,
                [
                    'addresses' => $addresses

                ])->layout('layouts.app');
        }
    }

    protected function messages()
    {
        return [
            'form.address_type' => ':attribute name is required',
            'form.address_line1' => ':attribute name is required',
            'form.address_line2' => ':attribute name is required',
            'form.postal_code' => ':attribute name is required',
            'form.country' => ':attribute name is required',
            'form.region' => ':attribute name is required',

        ];
    }

    protected function validationAttributes()
    {
        return [
//            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Phone type',
            'form.address_type' => 'Address type',
            'form.address_line1' => 'Line1',
            'form.address_line2' => 'Line2',
            'form.postal_code' => 'Postal code',
            'form.country' => 'Country',
            'form.region' => 'Region',
        ];
    }

}
