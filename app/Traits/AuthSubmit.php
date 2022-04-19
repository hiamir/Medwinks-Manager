<?php

namespace App\Traits;


use App\Http\Livewire\Admin\Countries;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait AuthSubmit
{
    public $formBackup=[];
    public $adminMessage = 'Error creating new Admin user. Please contact Administrator';
    public $userMessage = 'Error creating new User. Please contact Administrator';

    /**
     * AuthSubmit constructor.
     */
    public function __construct() {
        $this->formBackup=$this->form;
    }

    // CHECK GUARD

    public static function guard(): string
    {
        return (Auth::guard('admin')->check()?'admin':'web');
    }




    public function validateRule($auth, $field)
    {
        $auth = Data::all_lower_case($auth);
        $rules = [
            'form.name' => 'required|min:4|regex:/[a-zA-Z\s]+/',
            'form.email' => 'required|email|unique:users,email,' . $this->crudID,
            'form.two_factor_code' => 'required',
            'form.two_factor_expires_at' => 'required|date',
            'form.roles.role' => $this->anyRoleSelected(),
        ];
        switch ($auth) {
            case 'admin':
            case 'admins':
                $rules['form.email'] = 'required|email|unique:admins,email,' . $this->crudID;
                break;

            case 'user':
            case 'users':
                $rules['form.email'] = 'required|email|unique:users,email,' . $this->crudID;
                break;
        }

        return ($field ? $rules[$field] : $rules);
    }

    public function validateMessage($auth, $field)
    {
        $auth = Data::all_lower_case($auth);
        $messages = [
            'form.name.required' => 'Enter full name',
            'form.name.regex' => ':attribute must have alphabets and spaces only',
            "form.name.min" => "Name require minimum 4 characters",
            'form.email.required' => ':attribute name is required',
            'form.email.email' => ':attribute is not a valid email addresses',
            "form.email.unique" => ":attribute is already exists",

            'form.roles.role.required' => 'Any role must be selected',
            'form.data.name.required' => 'Any role must be selected',
            'form.roles.role.array' => 'Any role must be selected',
        ];

        switch ($auth) {
            case 'admin':
            case 'admins':
                $messages['form.two_factor_code.required'] = $this->adminMessage;
                $messages['form.two_factor_expires_at.required'] = $this->adminMessage;
                $messages['form.two_factor_expires_at.date'] = $this->adminMessage;
                break;

            case 'user':
            case 'users':
                $messages['form.two_factor_code.required'] = $this->userMessage;
                $messages['form.two_factor_expires_at.required'] = $this->userMessage;
                $messages['form.two_factor_expires_at.date'] = $this->userMessage;
                break;
        }

        return ($field ? $messages[$field] : $messages);
    }

    public function validateAttribute($auth, $field)
    {
        $auth = Data::all_lower_case($auth);
        $attribute = [
            'form.email' => ($this->form['email'] != '') ? $this->form['email'] : 'Email'
        ];
        switch ($auth) {
            case 'admin':
            case 'admins':
                $attribute['form.name'] = ($this->form['name'] != '') ? $this->form['name'] : 'Admin';

                break;

            case 'user':
            case 'users':
                $attribute['form.name'] = ($this->form['name'] != '') ? $this->form['name'] : 'User';
                break;
        }
        return ($field ? $attribute[$field] : $attribute);
    }

    public function anyRoleSelected()
    {
        $validated = false;
        if (($this->form['roles']) != "") {
            $keys = array_keys($this->form['roles']);
            if (!empty($keys)) {
                foreach ($keys as $key) {
                    if ($this->form['roles'][$key] == 'on') {
                        $validated = true;
                    }
                }
            }
        }
        return ($validated ? '' : 'required');
    }

    public function authRecord($auth, $id = null)
    {
        switch ($auth) {
            case 'admin':
                return ($id ? Query::admin($id) : new Admin());
            case 'web':
                return ($id ? Query::user($id) : new User());
        }
    }

    public function authCreate($auth, $modalID)
    {
        $auth = Data::all_lower_case($auth);
        $newRecord = $this->authRecord($auth);

        $this->form['two_factor_code'] = Quicker::generate_two_factor_code();
        $this->form['two_factor_expires_at'] = Quicker::generate_two_factor_expiry();
        $this->validate([
            'form.name' => $this->rules('form.name'),
            'form.email' => $this->rules('form.email'),
            'form.roles.role' => $this->rules('form.roles.role'),
        ]);
        $this->validateOnly('form.two_factor_code');
        $this->validateOnly('form.two_factor_expires_at');
        $this->data_formatter($this->form, 'form');


        $hashed_random_password = Str::random(8);
        $this->form['password'] = Hash::make($hashed_random_password);
        $this->form['status'] = null;

        $this->submit($crud = "create", $mID = $modalID, $records = $newRecord, $name = "admin", $fields = $this->submitFields, $data = $this->form, $customCreate = null, $customUpdate = null, $customDelete = null);
        $newRecord->roles()->sync($this->checked[0]);

        Mail::to($this->form['email'])->send(new \App\Mail\Welcome($name, config('app.admin_email')));
        Mail::to('omj@admin.com')->send(new \App\Mail\SendResetPassword($newRecord->name, $newRecord->email, $hashed_random_password));
    }

    public function authUpdate($auth, $id, $modalID)
    {
        $auth = Data::all_lower_case($auth);
        $record = $this->authRecord($auth, $id);

        $this->validate([
            'form.name' => $this->rules('form.name'),
            'form.email' => $this->rules('form.email')
        ]);

        $this->data_formatter($this->form, 'form');

        ($this->form['status'] == 1) ? $this->form['status'] = Carbon::now() : $this->form['status'] = null;

        $customUpdate = (!empty($this->checked)) ? $customUpdate = $record->roles()->sync($this->checked[0]) : $customUpdate = null;
        if (empty($customUpdate['attached'])) {
            $customUpdate = null;
        }

        $this->submit($crud = "update", $mID = $modalID, $records = $record, $name = $record->name, $fields = $this->submitFields, $data = $this->form, $customCreate = null, $customUpdate = $customUpdate, $customDelete = null);

        if ($this->form['email'] != $this->oldEmail) {
            $twoFactorCode = $this->resetTwoFactorCode($record);
            Mail::to($this->oldEmail)->send(new \App\Mail\ChangeEmail($this->form['name'], config('app.admin_email'), $this->form['email']));
            Mail::to($this->form['email'])->send(new \App\Mail\Welcome($this->form['name'], config('app.admin_email')));
            Mail::to($this->form['email'])->send(new \App\Mail\SendTwoFactor($this->form['name'], config('app.admin_email'), $twoFactorCode));
        }

    }


    public function authDelete($auth, $id, $modalID)
    {
        $auth = Data::all_lower_case($auth);
        $record = $this->authRecord($auth, $id);
        switch ($auth) {
            case 'admin':
            case 'admins':
                $this->submit($crud = "delete", $mID = $modalID, $records = $record, $name = $record->name, $fields = $this->submitFields, $data = $this->form, $customCreate = null, $customUpdate = null, $customDelete = null);
                $this->admin = null;
                break;

            case 'user':
            case 'users':
                $this->submit($crud = "delete", $mID = $modalID, $records = $record, $name = $record->name, $fields = $this->submitFields, $data = $this->form, $customCreate = null, $customUpdate = null, $customDelete = null);
                $this->user = null;
                break;
        }
    }

    public function resetPassword($auth, $id, $modalID)
    {
        $auth = Data::all_lower_case($auth);
        $record = $this->authRecord($auth, $id);
        $this->getRecords($record);
        $hashed_random_password = Str::random(8);
        $this->form['password'] = Hash::make($hashed_random_password);
        $this->submit($crud = "update", $mID = $modalID, $records = $record, $name = $record->name, $fields = $this->submitFields, $data = $this->form, $customCreate = null, $customUpdate = null, $customDelete = null);
        Mail::to('omj@admin.com')->send(new \App\Mail\SendResetPassword($record->name, $record->email, $hashed_random_password));
    }

    public function authCreateButton($submitFields)
    {
        $this->crudID = null;
        $this->form = [];
        $this->clearFields($submitFields);
        $this->form=$this->formBackup;
    }

    public function authUpdateButton($auth, $id)
    {

        $auth = Data::all_lower_case($auth);
        $record = $this->authRecord($auth, $id);
        $this->crudID = $id;
        $this->toggleHighlight = false;
        $this->getRecords($record);
        $filteredData = ($record->roles->pluck('id'));
        $checkBox = Quicker::processRadioButton('role', $this->roles, $filteredData, $id);
        $this->form['roles'] = $checkBox['data'];
        $this->form['status'] = (Quicker::validateMySQLTimeStamp($record->blocked)) ? 1 : 0;
        $this->oldEmail = $record->email;
    }

    public function authDeleteButton($auth, $id)
    {
        $auth = Data::all_lower_case($auth);
        $record = $this->authRecord($auth, $id);
        $this->form['trash'] = false;
        $this->deleteMessage = Data::deleteMessage('Link', $record->name);
    }

}




