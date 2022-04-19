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

class Passports extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;

    public $pageName = "Passports";
    public $sortField = 'created_at';
    public $pageNoList;
    public $pageNo = 9;
    public $sortDirectionList;
    public $sortDirection = 'desc';
    public $search = '';
    public $searchFields = [
        'id' => 'ID',
        'passport_number' => 'Passport Number',
        'given_name' => 'Given Name',
        'sur_name' => 'Sur Name',
        'date_of_birth' => 'Date of Birth',
        'issue_date' => 'Issue Date',
        'expiry_date' => 'Expiry Date',
        'countries_id' => 'Country',
        'regions_id' => 'Region',
        'active' => 'Active',
        'created_at' => 'Created at'
    ];
    public $submitFields = [
        'user_id' => 'user',
        'passport_number' => 'passport_number',
        'given_name' => 'given_name',
        'sur_name' => 'sur_name',
        'date_of_birth' => 'date_of_birth',
        'issue_date' => 'issue_date',
        'expiry_date' => 'expiry_date',
        'countries_id' => 'country',
        'regions_id' => 'region',
        'active' => 'active',
        'file' => 'file'
    ];
    public $form = [
        'user' => null,
        'passport_number' => null,
        'given_name' => null,
        'sur_name' => null,
        'date_of_birth' => '',
        'issue_date' => '',
        'expiry_date' => '',
        'country' => '',
        'region' => '',
        'file' => null,
        'active' => false,
        'trash' => false,
        'timestamps' => true
    ];
    public $formBackup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $menuCategory = [];
    public $checkbox;
    public $guardList;
    public $countryList = "";
    public $regionList = "";
    public $disabled = 'false';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage'];

    public function rules()
    {
        return [
            'form.passport_number' => ['required', 'unique:passports,passport_number,' . $this->crudID],
            'form.given_name' => 'required|min:4',
            'form.sur_name' => 'required|min:4',
            'form.date_of_birth' => 'required|date|before_or_equal:today',
            'form.issue_date' => 'required|date|before_or_equal:today',
            'form.expiry_date' => 'required|date|after:issue_date',
            'form.country' => 'required',
            'form.region' => 'required',
            'form.file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:500',
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
        $this->countryList = cache()->remember('countries', 60 * 60 * 24, function () {
            return (\App\Models\Countries::select('id', 'country as name')->get()->toJson());
        });
        $country = \App\Models\Countries::select('id', 'country as name')->get();

        $this->regionList = collect();
//        $this->countryList = TableFilter::selectListNames(\App\Models\Countries::all(), 'id', 'country');


//        $this->regionList = $this->countryList->where('id',$this->form['country'])->first()->regions;
//$this->regionList=\App\Models\Regions::select('id','name as name')->where('countries_id',$this->form['country'])->get();

//dd($this->regionList);

    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.passport_number":
                $this->form['passport_number'] = Data::all_upper_case($this->form['passport_number']);
                break;
            case "form.given_name":
                $this->form['given_name'] = Data::capitalize_each_word($this->form['given_name']);
                break;
            case "form.sur_name":
                $this->form['sur_name'] = Data::capitalize_each_word($this->form['sur_name']);
                break;
        }
    }

    public function updated($field)
    {
        switch ($field) {
            case "form.passport_number":
            case "form.given_name":
            case "form.sur_name":
            case "form.date_of_birth":
            case "form.region":
            case "form.file":
                $this->validateOnly($field);
                break;
            case 'form.country':
                $this->form['region']=null;
                $this->regionList = (\App\Models\Regions::select('id', 'name as name')->where('countries_id', $this->form['country'])->get())->toJson();
//                $this->regionList = \App\Models\Regions::select('id','name as name')->where('countries_id',$this->form['country'])->get();
                $this->validateOnly($field);
                break;

//            case 'form.date_of_birth':
//                $this->form['date_of_birth']=$this->dateFormat($this->form['date_of_birth'],'human');
//                break;

        }
    }

    public function dateFormat($date, $type)
    {
        switch ($type) {

            case 'system':
                return Carbon::parse($date)->format('Y-m-d');
            case 'human':
                return Carbon::parse($date)->format('F j, Y');
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

    public function passport_create_button($modalID)
    {
        $this->clearFields();
        $this->dispatchBrowserEvent('pondReset');
    }

    public function passport_update_button($id, $modalID)
    {

        $this->crudID = $id;
        $passport = Query::passport($id);
//        $this->regionList = TableFilter::selectListNames(Query::region_sort_country($passport->countries_id), 'id', 'name');


        $this->getRecords($passport);
//        $this->regionList = $this->countryList->where('id',$this->form['country'])->first()->regions;
        $this->regionList = (\App\Models\Regions::select('id', 'name as name')->where('countries_id', $this->form['country'])->get())->toJson();
        $this->dispatchBrowserEvent('pondReset');
    }

    public function passport_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $passport = Query::passport($id);
        $this->deleteMessage = Data::deleteMessage('Passport', $passport->passport_number);
    }

// CRUD BUTTON

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function submit_passport_create($id, $modalID)
    {

//        $this->form['date_of_birth']=$this->dateFormat($this->form['date_of_birth'],'system');
//        $this->form['issue_date']=$this->dateFormat($this->form['issue_date'],'system');
//        $this->form['expiry_date']=$this->dateFormat($this->form['expiry_date'],'system');
        $this->validateTryCatch();

        $this->data_formatter($this->form, 'form');

        if (Query::check_if_auth_has_role('User')) {
            $this->form['user'] = Auth::user()->id;
            $resetActive = \App\Models\Passports::where('user_id', Auth::user()->id)->get();
            if (count($resetActive) > 0 && $this->form['active'] == true) {
                foreach ($resetActive as $reset) {
                    $reset->active = false;
                    $reset->save();
                }
            }
        } else {
            $this->form['user'] = $id;
            $resetActive = \App\Models\Passports::where('user_id', $id)->get();
            if (count($resetActive) > 0 && $this->form['active'] == true) {
                foreach ($resetActive as $reset) {
                    $reset->active = false;
                    $reset->save();
                }
            }

//            $this->submit($crud = 'update', $mID = $modalID, $records = $passport, $name = 'passport', $fields = $this->submitFields, $data = $this->form, null, null, null,);
//            if ((is_object($this->form['file']))) $passport->addMedia($this->form['file']->getRealPath())->toMediaCollection('image');
        }
        $this->data_formatter($this->form, 'form');
        $passport = new \App\Models\Passports();
        $this->submit($crud = 'create', $mID = $modalID, $records = $passport, $name = 'passport', $fields = $this->submitFields, $data = $this->form);
//        $path_info = pathinfo($this->form['file']->getRealPath());
//        $extension= $path_info['extension'];
        $filename = $passport->id . '-' . 'Passport-' . $passport->passport_number . '-' . $passport->given_name . '-' . $passport->sur_name;
        if ((is_object($this->form['file']))) $passport->addMedia($this->form['file']->getRealPath())->toMediaCollection('image');
    }

    public function submit_passport_update($id, $modalID)
    {
        $this->validateTryCatch($this->updateRules());
        if (Query::check_if_auth_has_role('User')) {
            $passport = Query::passport($id);
            $this->form['user'] = Auth::user()->id;
            $resetActive = \App\Models\Passports::where('user_id', Auth::user()->id)->get();
            if (count($resetActive) > 0 && $this->form['active'] == true) {

                foreach ($resetActive as $reset) {
                    $reset->active = false;
                    $reset->save();
                }
            }
            $this->data_formatter($this->form, 'form');
            $this->submit($crud = 'update', $mID = $modalID, $records = $passport, $name = 'passport', $fields = $this->submitFields, $data = $this->form, null, null, null,);
            if ((is_object($this->form['file']))) $passport->addMedia($this->form['file']->getRealPath())->toMediaCollection('image');

        } else {


            $passport = Query::passport($id);
            $id=$passport->user_id;
            $this->form['user'] = $id;
            $resetActive = \App\Models\Passports::where('user_id', $id)->get();
            if (count($resetActive) > 0 && $this->form['active'] == true) {

                foreach ($resetActive as $reset) {
                    $reset->active = false;
                    $reset->save();
                }
            }
            $this->data_formatter($this->form, 'form');
            $this->submit($crud = 'update', $mID = $modalID, $records = $passport, $name = 'passport', $fields = $this->submitFields, $data = $this->form, null, null, null,);
            if ((is_object($this->form['file']))) $passport->addMedia($this->form['file']->getRealPath())->toMediaCollection('image');
        }

    }

    public function updateRules()
    {
        return [
            'form.passport_number' => ['required', 'unique:passports,passport_number,' . $this->crudID],
            'form.given_name' => 'required|min:4',
            'form.sur_name' => 'required|min:4',
            'form.date_of_birth' => 'required|date|before_or_equal:today',
            'form.issue_date' => 'required|date|before_or_equal:today',
            'form.expiry_date' => 'required|date|after:issue_date',
            'form.country' => 'required',
            'form.region' => 'required',
//            'form.file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:500',
        ];
    }

// CRUD SUBMIT

    public function submit_passport_delete($id, $modalID)
    {
        $passport = Query::passport($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $passport, $name = 'Passport- ' . $passport->passport_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->passport = null;
    }

    public function file_right_icon($ref)
    {
        $ref = explode('.', $ref)[1];
        $this->form[$ref] = '';
    }

    public function passport_view_button($id, $modalID)
    {
    }

    public function passport_file_button($id, $modalID)
    {
    }

    public function inputReset($ref)
    {
        $explode = explode('.', $ref);
        $form = $explode[0];
        $input = $explode[1];
        $this->$form[$input] = '';
    }

    public function render()
    {
//        cache()->forget('countries');
        $userRole = json_decode(auth()->user()->roles->pluck('name'));

        if (in_array('Manager', $userRole)) {
            $passports = \App\Models\User::whereHas('roles',function($r){
                $r->where('name','User');
            })->with(['passports' => function ($q) {
                $q->with(['user', 'media', 'region', 'country']);
            }])
                ->where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        } elseif (in_array('User', $userRole)) {
            $passports = \App\Models\Passports::with(['user', 'media', 'region', 'country'])
                ->where('user_id', Auth::user()->id)
                ->where('given_name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
        }
//        if (in_array('Manager', $userRole)) {
//            $passports = \App\Models\Passports::with(['user','media'])
//            ->where('given_name', 'like', '%' . $this->search . '%')->latest()
//                ->orderBy($this->sortField, $this->sortDirection)
//                ->paginate($this->pageNo);
//        } elseif (in_array('User', $userRole)) {
//            $passports = \App\Models\Passports::
//            where('given_name', 'like', '%' . $this->search . '%')
//                ->orderBy($this->sortField, $this->sortDirection)
//                ->paginate($this->pageNo);
//        }
        return view($this->routeIndex,
            [
                'passports' => $passports,
                'userRoles' => $userRole,
                'currentPage' => Quicker::currentPage($passports),
                'perPage' => Quicker::perPage($passports),
                'total' => Quicker::total($passports)
            ])
            ->layout('layouts.app');
    }

    protected function messages()
    {
        return [
            'form.passport_number.required' => 'Required',
            'form.given_name.required' => 'Required',
            'form.given_name.min' => 'Name must be min 4 character long',
            'form.sur_name.required' => 'Required',
            'form.sur_name.min' => 'Name must be min 4 character long',
            'form.date_of_birth.required' => 'Required',
            'form.date_of_birth.date' => ":attribute must be valid date",
            'form.date_of_birth.date_format' => ":attribute must have 'Y-m-d' format",
            'form.date_of_birth.before_or_equal' => ":attribute must be today or before today's date",
            'form.issue_date.required' => "Required",
            'form.issue_date.date' => ":attribute must be valid date",
            'form.issue_date.date_format' => ":attribute date must have 'Y-m-d' format",
            'form.issue_date.before_or_equal' => ":attribute date must be today or before today's date",
            'form.expiry_date.required' => "Required",
            'form.expiry_date.date' => ":attribute must be valid date",
            'form.expiry_date.date_format' => ":attribute date must have 'Y-m-d' format",
            'form.expiry_date.before_or_equal' => ":attribute date must be today or before today's date",
            'form.country' => 'Required',
            'form.region' => 'Required',
            'form.file.required' => 'Upload image file for :attribute',
            'form.file.image' => ':attribute must be a image',
            'form.file.mimes' => ":attribute image allowed formats 'jpg,png,jpeg,gif,svg'",
            'form.file.max' => ":attribute must not exceed 500kb file size",
        ];
    }

    protected function validationAttributes()
    {
        return [
            'form.passport_number' => ($this->form['passport_number'] != '') ? $this->form['passport_number'] : 'Passport number',
            'form.given_name' => ($this->form['given_name'] != '') ? $this->form['given_name'] : 'Given name',
            'form.sur_name' => ($this->form['sur_name'] != '') ? $this->form['sur_name'] : 'Sur name',
            'form.date_of_birth' => ($this->form['date_of_birth'] != '') ? $this->form['date_of_birth'] : 'Date of birth',
            'form.issue_date' => ($this->form['issue_date'] != '') ? $this->form['issue_date'] : 'Issue date',
            'form.expiry_date' => ($this->form['expiry_date'] != '') ? $this->form['expiry_date'] : 'Expiry date',
            'form.country' => 'Country',
            'form.region' => 'Region',
            'form.file' => ($this->form['passport_number'] != '') ? $this->form['passport_number'] : 'Passport',
        ];
    }

}
