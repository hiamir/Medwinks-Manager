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

class AddressType extends Component
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
    public $searchFields = ['id' => 'ID', 'name' => 'Type', 'created_at' => 'Created at'];
    public $submitFields = ['name' => 'name', 'created_by' => 'created_by', 'updated_by' => 'updated_by'];
    public $form = ['name' => null, 'created_by' => null, 'updated_by' => null, 'trash' => false, 'timestamps' => true];
    public $formBackup=null;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $checkbox;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public function rules()
    {
        return [
            'form.name' => 'required|min:4|unique:address_types,name,' . $this->crudID,
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
        $this->guardList = TableFilter::guardFilter();
        $this->form['guard'] = '';
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
            case 'form.name':
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

    public function address_type_create_button($modalID)
    {
        $this->clearFields($this->submitFields);
    }

    public function address_type_update_button($id, $modalID)
    {
        $this->crudID = $id;
        $address_type = Query::address_type($id);
        $this->getRecords($address_type);
    }

// CRUD BUTTON

    public function address_type_delete_button($id, $modalID)
    {

        $this->form['trash'] = false;

        $address_type = Query::address_type($id);
        $this->deleteMessage = Data::deleteMessage('Address Type', $address_type->name);
    }

    public function submit_address_type_create($modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $address_type = new \App\Models\AddressType();
        $this->submit($crud = 'create', $mID = $modalID, $records = $address_type, $name = 'address_type', $fields = $this->submitFields, $data = $this->form);
    }

    public function submit_address_type_update($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $address_type = Query::address_type($id);
        $this->submit($crud = 'update', $mID = $modalID, $records = $address_type, $name = 'address_type', $fields = $this->submitFields, $data = $this->form, null, null, null,);
    }

// CRUD SUBMIT

    public function submit_address_type_delete($id, $modalID)
    {
        $address_type = Query::address_type($id);

        $this->submit($crud = 'delete', $mID = $modalID, $records = $address_type, $name = 'address_type', $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->address_type = null;
    }

    public function render()
    {

        if ($this->error === false || !$this->authorize($this->access, $this->routeName)) {

            $addressTypes = \App\Models\AddressType::
            where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);

            return view($this->routeIndex,
                ['addressTypes' => $addressTypes,
                    'currentPage' => Quicker::currentPage($addressTypes),
                    'perPage' => Quicker::perPage($addressTypes),
                    'total' => Quicker::total($addressTypes)])
                ->layout('layouts.app');
        } else {
            $addressTypes = Query::address_type(0);
            return view($this->routeIndex,
                [
                    'roles' => $addressTypes,

                ])->layout('layouts.app');
        }
    }

    protected function messages()
    {
        return [
            'form.name.required' => ':attribute name is required',
            'form.name.alpha' => ':attribute must be alphabets only',
            "form.name.unique" => ":attribute is already exists",
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'Phone type',
        ];
    }
}
