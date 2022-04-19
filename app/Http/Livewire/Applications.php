<?php

namespace App\Http\Livewire;

use App\Models\Documents;
use App\Models\Status;
use App\Traits\AuthorizesRoleOrPermission;
use App\Traits\Data;
use App\Traits\FormValidation;
use App\Traits\Query;
use App\Traits\Quicker;
use App\Traits\TableFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;
use Throwable;

class Applications extends Component
{
    use AuthorizesRoleOrPermission;
    use withPagination;
    use FormValidation;
    use Quicker;
    use TableFilter;
    use Data;


    use WithFileUploads;

    public $pageName = "application";
    public $sortField = 'updated_at';
    public $pageNoList;
    public $pageNo = 10;
    public $sortDirectionList;
    public $sortDirection = 'desc';
    public $search = '';
    public $searchFields = [
        'id' => 'ID',
        'passports_id' => 'Passport',
        'services_id' => 'Service',
        'universities_id' => 'University',
    ];
    public $submitFields = [
        'passports_id' => 'passport',
        'services_id' => 'service',
        'universities_id' => 'university',
        'statuses_id' => 'statuses_id',
        'users_id' => 'user'
    ];
    public $form = [
        'passport' => null,
        'service' => null,
        'university' => null,
        'statuses_id' => null,
        'trash' => false,
        'timestamps' => true
    ];
    public $form1 = [
        'applicationID' => '',
        'requirementID' => '',
        'file' => '',
        'trash' => false,
        'timestamps' => true
    ];
    public $submitFields1 = [
        'applications_id' => 'applicationID',
        'service_requirements_id' => 'requirementID',
        'file' => 'file',
    ];
    public $statusID = [];
    public $selectedCheckbox = [];
    public $formBackup;
    public $form1Backup;
    public $crudID = null;
    public $deleteMessage;
    public $readyToLoad = false;
    public $menuList = [];
    public $services;
    public $application;
    public $documents;
    public $showInput = true;
    public $status_incomplete_id;
    public $status_submitted_id;
    public $hasDocuments;
    public $documentError = false;
    public $service_requirements;
    public $passportList = [];
    public $serviceList = [];
    public $universityList = [];
    public $menuCategory = [];
    public $files = [];
    public $errorMessages = [];
    public $currentPage = 0;
    public $terms = null;
    public $modalID = null;
    public $status_id = 5;
    public $statusSelected = false;
    public $userRole;
    public $type;
    public $multiStep = [
        0 => ['heading' => 'Service',
            'subheading' => 'Choose a service you want to enroll'
        ],
        1 => ['heading' => 'Passport',
            'subheading' => 'Choose your active passport'
        ],
        2 => ['heading' => 'University',
            'subheading' => 'Choose your current university'
        ],
        3 => ['heading' => 'Documents',
            'subheading' => 'Upload all the required documents'
        ],
        4 => ['heading' => 'Submit',
            'subheading' => 'Submit your application to finalize the process'
        ]
    ];

    public $disabled = 'false';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => 'refreshPage', 'acceptDocument'];

    public function rules()
    {

        return [
            'form.passport' => ['required'],
            'form.service' => ['required'],
            'form.university' => ['required'],
            'terms' => ['required']
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
        $this->passportList = (\App\Models\Passports::select('id', 'passport_number as name')->where('user_id', Auth::user()->id)->where('active', true)->get()->toJson());
        $this->services = (\App\Models\Services::select('id', 'name as name')->with('service_requirements')->get());
        $this->serviceList = ($this->services->toJson());
        $this->universityList = (\App\Models\Universities::select('id', 'name as name')->get()->toJson());
        $this->pageNoList = $this->pageNoListTrait;
        $this->sortDirectionList = $this->sortDirectionListTrait;
        $this->errorMessages = [
            'form.passport.required' => 'Required',
            'form.service.required' => 'Required',
            'form.university.required' => 'Required',
            'form1.file.required' => 'File is Required',
            'terms.required' => 'You must agree to the terms & condition to continue',
        ];
    }

    public function inputFinisher($field)
    {
        switch ($field) {
            case "form.name":
                $this->form['name'] = Data::capitalize_each_word($this->form['name']);
                break;
        }
    }

    public function updated($field)
    {
//
        switch ($field) {
            case "form.passport":

            case "form.university":
                $this->validateOnly($field);
                break;

            case "form.service":
                $this->service_requirements = \App\Models\Services::with('service_requirements')->where('id', $this->form['service'])->first();

                $this->files = [];
                foreach ($this->service_requirements->service_requirements as $requirement) {
                    $this->files['file_' . $requirement->id] = null;
                }
                break;

            case "form1.file":
                if ($this->application != null) {
//                    $this->documents = \App\Models\Applications::has('documents')->where('id', $this->application->id)->get();
//                    $this->documents = \App\Models\Applications::with('documents')->where('id', $this->application->id)->first();
                }
                break;
            case "terms":
                if ($this->terms == false) $this->terms = null;
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

    public function application_create_button($id, $modalID)
    {
        $this->modalID = $modalID;
        $this->application = null;
        $this->currentPage = 0;
        $this->service_requirements = null;
        $this->terms = null;
        $this->clearFields();
    }

    public function application_update_button($id, $modalID)
    {
        $this->currentPage = 0;
        $this->crudID = $id;
        $this->application = Query::application($id);
        $this->getRecords($this->application);
        $this->service_requirements = \App\Models\Services::with('service_requirements')->where('id', $this->application->services_id)->first();
        $this->documents = \App\Models\Applications::with(['documents' => function ($e) {
            $e->with('service_requirements');
        }])->where('id', $this->application->id)->first();
        $this->files = [];
        $documentsPresent = $this->documents->documents->pluck('service_requirements_id')->toArray();
        foreach ($this->service_requirements->service_requirements as $requirement) {
            if (!in_array($requirement->id, $documentsPresent)) {
                $this->files['file_' . $requirement->id] = null;
            }
        }

        if (in_array('Manager', $this->userRole)) {
            $this->passportList = (\App\Models\Passports::select('id', 'passport_number as name')->where('user_id', $this->application->users_id)->get()->toJson());
        } else {
            $passportActive = (\App\Models\Passports::where('user_id', $this->application->users_id)->where('active', 1)->first());
            if (strcmp($passportActive->id, $this->application->passports_id)) {
                $this->form['passport'] = null;
            }
        }

    }

    public function application_delete_button($id, $modalID)
    {
        $this->form['trash'] = false;
        $application = Query::application($id);
        $this->deleteMessage = Data::deleteMessage('application', 'Application');
    }

    public function termsconditions_button()
    {

    }

    public function previousButton()
    {
        $this->previousPage();
    }

    public function previousPage()
    {
        $this->currentPage = $this->currentPage - 1;
    }

    public function submit_application_service_create()
    {
        $this->validateOnly('form.service');
        $this->validateOnly('terms');

        $this->nextPage();
    }

// CRUD BUTTON


    public function nextPage()
    {
        $this->currentPage = $this->currentPage + 1;
    }

    public function submit_application_passport_create()
    {
        $this->validateOnly('form.passport');
        $this->nextPage();
    }

    public function submit_application_create($id, $modalID)
    {
        $this->validate();
        $this->data_formatter($this->form, 'form');
        $this->form['user'] = Auth::user()->id;
        $this->form['statuses_id'] = $this->status_incomplete_id;
        if ($this->application != null) {
            $this->submit($crud = 'update', $mID = $modalID, $records = $this->application, $name = 'application', $fields = $this->submitFields, $data = $this->form, null, null, null, $close = false, $showToast = false);
        } else {
            $this->application = new \App\Models\Applications();
            $this->submit($crud = 'create', $mID = $modalID, $records = $this->application, $name = 'application', $fields = $this->submitFields, $data = $this->form, null, null, null, $close = false, $showToast = false);
        }

        $this->documents = \App\Models\Applications::with('documents')->where('id', $this->application->id)->first();
        $this->nextPage();
    }

    public function submit_application_update($id, $modalID)
    {
        $status = Query::status($this->application->statuses_id);

        switch ($status->reference) {
            case "application-revision" :

                $this->documents = \App\Models\Applications::with(['documents' => function ($e) {
                    $e->with('service_requirements');
                }])->where('id', $this->application->id)->first();
                $check_reject_status=($this->documents->documents->pluck('rejected')->toArray());
                if (array_unique($check_reject_status) === array(0)) {
                    $status = Query::status_by_reference('application-author-revised');
                    $this->application->statuses_id=$status->id;
                    $this->application->save();
                    $this->modalClose($modalID);
                  $this->modalBackgroundClose();
                }
                break;

            case "application-author-revised" :
                $this->documents = \App\Models\Applications::with(['documents' => function ($e) {
                    $e->with('service_requirements');
                }])->where('id', $this->application->id)->first();
                $check_accept_status=($this->documents->documents->pluck('accepted')->toArray());
                $check_reject_status=($this->documents->documents->pluck('rejected')->toArray());
                if (array_unique($check_accept_status) === array(1)) {
                    $status = Query::status_by_reference('application-accepted');
                    $this->application->statuses_id=$status->id;
                    $this->application->save();
                    $this->modalClose($modalID);
                    $this->modalBackgroundClose();
                }elseif(in_array(1,$check_reject_status)){
                    $status = Query::status_by_reference('application-revision');
                    $this->application->statuses_id=$status->id;
                    $this->application->save();
                    $this->modalClose($modalID);
                    $this->modalBackgroundClose();
                }


                break;
            case "application-accepted" :

                break;
            case "application-submitted" :
                if (in_array('Manager', $this->userRole)) {
                    $decision = $this->documents->documents->pluck('accepted')->toArray();
                    (array_unique($decision) === array(1)) ? $success = true : $success = false;
                    if ($success) {
                        $statusRef = Query::status_by_reference('application-accepted');
                        $this->application->statuses_id = $statusRef->id;
                        $this->application->save();
                    } else {
                        $statusRef = Query::status_by_reference('application-revision');
                        $this->application->statuses_id = $statusRef->id;
                        $this->application->save();
                    }
                } else {
                    $this->validate();
                    $this->data_formatter($this->form, 'form');
                    $application = Query::application($id);
                    $this->submit($crud = 'update', $mID = $modalID, $records = $application, $name = 'application', $fields = $this->submitFields, $data = $this->form, null, null, null,);
                }
                $this->modalClose($modalID);
                $this->modalBackgroundClose();
                break;

            default:
//                if (in_array('Manager', $this->userRole)) {
//                    $decision = $this->documents->documents->pluck('accepted')->toArray();
//                    (array_unique($decision) === array(1)) ? $success = true : $success = false;
//                    if ($success) {
//                        $statusRef = Query::status_by_reference('application-accepted');
//                        $this->application->statuses_id = $statusRef->id;
//                        $this->application->save();
//                    } else {
//                        $statusRef = Query::status_by_reference('application-revision');
//                        $this->application->statuses_id = $statusRef->id;
//                        $this->application->save();
//                    }
//                } else {
//                    $this->validate();
//                    $this->data_formatter($this->form, 'form');
//                    $application = Query::application($id);
//                    $this->submit($crud = 'update', $mID = $modalID, $records = $application, $name = 'application', $fields = $this->submitFields, $data = $this->form, null, null, null,);
//                }
                break;
        }


    }


    public function submit_application_delete($id, $modalID)
    {
        $application = Query::application($id);
        $this->submit($crud = 'delete', $mID = $modalID, $records = $application, $name = 'Passport- ' . $application->application_number, $fields = $this->submitFields, $data = $this->form, null, null, null,);
        $this->application = null;
    }

// CRUD SUBMIT

    public function submit_document_create($id, $modalID)
    {

        $this->validate($this->requirement_rules($id));

        $this->form1['applicationID'] = $this->application->id;
        $this->form1['requirementID'] = $id;
        $search = Documents::where('applications_id', $this->application->id)->where('service_requirements_id', $id)->first();

//        $this->validate($this->requirement_rules());
        $this->data_formatter($this->form1, 'form1');
        if ($search != null) {
            $doc = Documents::where('applications_id', $this->application->id)->where('service_requirements_id', $id)->first();

        } else {
            $doc = new \App\Models\Documents();
        }

        try {
            DB::transaction(function () use ($id, $modalID, $search, $doc) {
                if ($search != null) {
                    $this->form1['file'] = $this->files['file_' . $id];
                    $this->submit($crud = 'update', $mID = $modalID, $records = $doc, $name = 'document', $fields = $this->submitFields1, $data = $this->form1, null, null, null, $close = false);
                    $search->clearMediaCollection('documents');
                    if ((is_object($this->files['file_' . $id]))) $search->addMedia($this->files['file_' . $id]->getRealPath())->toMediaCollection('documents');
                } else {
                    $this->form1['file'] = $this->files['file_' . $id];
                    $this->submit($crud = 'create', $mID = $modalID, $records = $doc, $name = 'document', $fields = $this->submitFields1, $data = $this->form1, null, null, null, $close = false);
                    if ((is_object($this->files['file_' . $id]))) $doc->addMedia($this->form1['file']->getRealPath())->toMediaCollection('documents');
                }

                $this->documents = \App\Models\Applications::with('documents')->where('id', $this->application->id)->first();
//                $this->hasDocuments=\App\Models\Applications::with('documents')->has('documents')->where('id', $this->application->id)->first();
                $this->hasDocuments = \App\Models\Documents::where('id', $this->application->id)->first();
            });
        } catch (Throwable $e) {
            $alert = 'error';
            $message = Data::capitalize_first_word('Application creation failed! Please contact administrator');
            DB::rollback();
            $doc->logs()->create([
                'log_type_id' => Query::log_type_id_by_slug('create'),
                'guard_id' => Query::guard_type_id_from_auth_guard(),
                'auth_id' => auth()->user()->id,
                'message' => $e->getMessage()
            ]);
            return false;
        }

    }

    public function requirement_rules($id = null)
    {
        $arr = [];
        $msg = [];
        if (!empty($this->files)) {
            foreach ($this->files as $key => $file) {
                if ($id == null) {
                    $arr['files.' . $key] = 'required';
                } else {
                    if ('file_' . $id == $key) {
                        $arr['files.' . $key] = 'required';
                    }
                }
            }
        }

        foreach ($this->service_requirements->service_requirements as $requirement) {
            ($id) ? ($requirement->id == $id) ? $msg['files.file_' . $requirement->id . '.required'] = $requirement->name . ' is required. Please upload a file' : $msg['files.file_' . $requirement->id . '.required'] = '' : $msg['files.file_' . $requirement->id . '.required'] = $requirement->name . ' is required. Please upload a file';
        }
        $this->errorMessages = array_merge($this->errorMessages, $msg);
        return $arr;
    }

    public function submit_document_select_update($id, $modalID = null)
    {


        if (isset($this->files['revised_file_' . $id])) {

        $doc = Documents::where('id', $id)->first();
        $this->form1['applicationID'] = $doc->applications_id;
        $this->form1['requirementID'] = $doc->service_requirements_id;
        $this->form1['file'] = $this->files['revised_file_' . $id];

        $this->submit($crud = 'update', $mID = $modalID, $records = $doc, $name = 'document', $fields = $this->submitFields1, $data = $this->form1, null, null, null, $close = false);
        $doc->clearMediaCollection('documents');
        $doc->accepted=false;
            $doc->rejected=false;
            $doc->revised=true;
            $doc->save();
        if ((is_object($this->files['revised_file_' . $id]))) $doc->addMedia($this->files['revised_file_' . $id]->getRealPath())->toMediaCollection('documents');
            $this->documents = \App\Models\Applications::with(['documents' => function ($e) {
                $e->with('service_requirements');
            }])->where('id', $this->application->id)->first();
    }
    }


    public function submit_document_update($id, $modalID)
    {
        if (!empty($this->requirement_rules($id))) $this->validate($this->requirement_rules($id));

        $this->form1['applicationID'] = $this->application->id;
        $this->form1['requirementID'] = $id;
        $search = Documents::where('applications_id', $this->application->id)->where('service_requirements_id', $id)->first();

//        $this->validate($this->requirement_rules());
        $this->data_formatter($this->form1, 'form1');
        if ($search != null) {
            $doc = Documents::where('applications_id', $this->application->id)->where('service_requirements_id', $id)->first();

        } else {
            $doc = new \App\Models\Documents();
        }

        try {
            DB::transaction(function () use ($id, $modalID, $search, $doc) {
                if ($search != null) {
                    $this->form1['file'] = $this->files['file_' . $id];
                    $this->submit($crud = 'update', $mID = $modalID, $records = $doc, $name = 'document', $fields = $this->submitFields1, $data = $this->form1, null, null, null, $close = false);
                    $search->clearMediaCollection('documents');
                    if ((is_object($this->files['file_' . $id]))) $search->addMedia($this->files['file_' . $id]->getRealPath())->toMediaCollection('documents');
                } else {
                    $this->form1['file'] = $this->files['file_' . $id];
                    $this->submit($crud = 'create', $mID = $modalID, $records = $doc, $name = 'document', $fields = $this->submitFields1, $data = $this->form1, null, null, null, $close = false);
                    if ((is_object($this->files['file_' . $id]))) $doc->addMedia($this->form1['file']->getRealPath())->toMediaCollection('documents');
                }

                $this->documents = \App\Models\Applications::with('documents')->where('id', $this->application->id)->first();
//                $this->hasDocuments=\App\Models\Applications::with('documents')->has('documents')->where('id', $this->application->id)->first();
                $this->hasDocuments = \App\Models\Documents::where('id', $this->application->id)->first();
            });
        } catch (Throwable $e) {
            $alert = 'error';
            $message = Data::capitalize_first_word('Application creation failed! Please contact administrator');
            DB::rollback();
            $doc->logs()->create([
                'log_type_id' => Query::log_type_id_by_slug('create'),
                'guard_id' => Query::guard_type_id_from_auth_guard(),
                'auth_id' => auth()->user()->id,
                'message' => $e->getMessage()
            ]);
            return false;
        }

    }

    public function submit_document_created($id, $modalID)
    {
        if (!empty($this->requirement_rules($id))) $this->validate($this->requirement_rules($id));
        $application = \App\Models\Applications::with('documents')->where('id', $id)->first();
        $service = \App\Models\Services::with('service_requirements')->where('id', $application->services_id)->first();
        $documentUploaded = json_decode($application->documents->pluck('service_requirements_id'), true);
        $requiredDocuments = json_decode($service->service_requirements->pluck('id'), true);
        (array_diff($requiredDocuments, $documentUploaded)) ? $this->documentError = true : $this->documentError = false;
        if (!$this->documentError) $this->nextPage();
    }

    public function submit_application_finalize_submit($id, $modalID)
    {
        if ($this->application != null && $this->application->statuses_id != $this->status_submitted_id) {
            $this->application->statuses_id = $this->status_submitted_id;
            $this->application->save();
            session()->flash('submitted', 'Application submitted successfully!.');
        } else {
            session()->flash('already-submitted', 'Application already submitted !');
        }
        $modalID = 'application_update_modal_' . $this->application->id;
        $this->modalClose($modalID);

    }

    public function statusClick($id)
    {
        $this->status_id = $id;
        $status = Query::status($id);
        switch ($status->reference) {
//            case "application-submitted" :
//
//                $this->type = 'edit';
//                break;
            case "application-submitted" :
            case "application-revision" :
            case "application-author-revised" :
                $this->type = 'twoforms';
                break;
            case "application-accepted" :
                $this->type = 'view';
                break;


        }

    }

    public function document_file($document)
    {
        $downloads = $document->getMedia('file');
//        $document->getFirstMedia('documents')->getUrl();
        return MediaStream::create('my-files.zip')->addMedia($downloads);
    }

    public function accept_document($documentID)
    {

        $document = Documents::where('id', $documentID)->first();
        $document->accepted = true;
        $document->rejected = false;
        $document->save();
        $this->getDocumentRecords($this->application->id);
    }

    private function getDocumentRecords($id)
    {
        $this->documents = \App\Models\Applications::with(['documents' => function ($e) {
            $e->with('service_requirements');
        }])->where('id', $id)->first();
    }

    public function reject_document($documentID)
    {

        $document = Documents::where('id', $documentID)->first();
        $document->accepted = false;
        $document->rejected = true;
        $document->save();
        $this->getDocumentRecords($this->application->id);
    }

    //REQUIREMENTS

    public function render()
    {
        $this->userRole = json_decode(auth()->user()->roles->pluck('name'));
        $this->status_incomplete_id = Status::where('reference', 'application-incomplete')->first()->id;
        $this->status_submitted_id = Status::where('reference', 'application-submitted')->first()->id;


        if (in_array('Manager', $this->userRole)) {
            $applications = \App\Models\Applications::with(['user', 'statuses', 'passports', 'services', 'universities'])
                ->where('statuses_id', $this->status_id)->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);
            $statuses = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities']);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->get();
        } else {
            $applications = \App\Models\Applications::with(['user', 'statuses', 'passports', 'services', 'universities'])
                ->where('users_id', Auth::user()->id)
                ->where('statuses_id', $this->status_id)->latest()
//                ->where('name', 'like', '%' . $this->search . '%')->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->pageNo);

            $statuses = Status::with(['applications' => function ($a) {
                $a->with(['user', 'passports', 'services', 'universities'])->where('users_id', Auth::user()->id);
            }])->with(['models' => function ($q) {
                $q->where('name', 'Application');
            }])->where('models_id', 1)->get();
        }
//$service=\App\Models\Services::with(['applications'=>function($q){
//    $q->with(['services'=>function($d){
//        $d->with('service_requirements');
//    }])->where('id',13);
//}])->get();
//dd($service);
        return view($this->routeIndex,
            [
                'applications' => $applications,
                'statuses' => $statuses,
                'currentPage' => Quicker::currentPage($applications),
                'perPage' => Quicker::perPage($applications),
                'total' => Quicker::total($applications)
            ])
            ->layout('layouts.app');
    }

    protected function messages()
    {

        return $this->errorMessages;
    }

    protected function validationAttributes()
    {
        return [
//            'form.name' => ($this->form['name'] != '') ? $this->form['name'] : 'application',
        ];
    }

}
