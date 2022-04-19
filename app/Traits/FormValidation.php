<?php

namespace App\Traits;

use App\Rules\MatchPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\CheckRoute;

trait FormValidation
{
    protected $selected = [], $selected_messages = [], $validationFinal, $selectedRules;
    protected $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/';
    protected $uctitle;

    public function formValidation($t, $title, $names, $id = null)
    {
        $uctitle = ucfirst($title);


        switch ($title) {

            case 'registration' || 'login' || 'userCreate' || 'userUpdate' || 'adminCreate' || 'adminUpdate' || 'country' || 'role' || 'permission' || 'menu_link' :
                if ($title === 'login') {

                    $rules = [
                        'form.email' => 'required|email',
                        'form.password' => 'required',
                    ];

                } elseif ($title === 'registration') {

                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.email' => 'required|email|unique:users,email,' . $id,
                        'form.admin-email' => 'required|email|unique:admins,email,' . $id,
                        'form.password' => 'required|min:6|confirmed|regex:' . $this->password_regex,
                        'form.password_confirmation' => 'required|min:6',
                    ];
                } elseif ($title === 'role') {

                    $rules = [
                        'form.name' => 'required|min:4|unique:roles,name,' . $id,
                        'form.slug' => 'required|min:4|unique:roles,slug_name,' . $id,
                        'form.guard' => 'required',
                    ];
                } elseif ($title === 'permission') {

                    $rules = [
                        'form.name' => 'required|min:4|unique:permissions,name,' . $id,
                        'form.guard' => 'required',
                    ];
                }elseif ($title === 'company') {

                    $rules = [
                        'form.name' => 'required|min:4',
                    ];
                }
                elseif ($title === 'division') {
                    $rules = [
                        'form2.name' => 'required|min:4',
                    ];
                }

                elseif ($title === 'country') {
                    $rules = [
                        'form.country_name' => 'required|min:4|unique:countries,country,' . $id,
                        'form.iso' => 'required|alpha|min:2|max:2|unique:countries,iso,' . $id,
                        'form.iso3' => 'required|alpha|min:3|max:3|unique:countries,iso3,' . $id,
                        'form.fips' => 'required|alpha|min:2|max:2|max:2|unique:countries,fips,' . $id,
                        'form.continent' => 'required|alpha||min:2|max:2',
                        'form.currency_code' => 'required|alpha|min:3|max:3',
                        'form.currency_name' => 'required|min:2',
                        'form.phone_prefix' => 'required|min:2|regex:/^([0-9\s\-\+\(\)]*)$/',
                        'form.postal_code' => '',
                        'form.languages' => 'required|regex:/^[A-Za-z,\-]+$/',
                        'form.geonameid' => 'required|numeric|unique:countries,geonameid,' . $id,
                    ];
                } elseif ($title === 'region') {

                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.country' => 'required|integer|gt:0|min:1',
                        'form.timezone' => 'required|min:4|timezone',
                    ];
                } elseif ($title === 'menu_folder') {

                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.position' => 'required|integer|gt:0|min:1|unique:menu_folders,position,' . $id,
                    ];
                } elseif ($title === 'menu_list') {

                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.position' => 'required|integer|min:1',
                        'form.folder' => 'required|integer|min:1',
                        'form.category' => 'required|integer|min:1',
                    ];
                } elseif ($title === 'menu_link') {
                    $rules = [
                        'form.name' => 'required|alpha|min:4',
                        'form.route' => 'required|regex:/^[A-Za-z.]+$/',
//                        'form.route' => ['required',new CheckRoute()],
//                        'form.roles.role' => ['required', ['regex', '/^[a-zA-Z|(?=\s)]+$/']],
//                        'form.roles.role' => ['required'],
                        'form.permissions' => 'required|min:4',
                        'form.folder' => 'required|integer|min:1',
                        'form.category' => 'required|integer|min:1',
                        'form.position' => 'required|integer|gt:0|min:1',
                    ];
                } elseif ($title === 'menu_category') {

                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.position' => 'required|integer|gt:0|min:1|unique:menu_categories,position,' . $id,
                    ];
                } elseif ($title === 'adminCreate' || 'adminUpdate') {

                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.email' => 'required|email|unique:admins,email,' . $id,
                        'form.admin-email' => 'required|email|unique:admins,email,' . $id,
                        'form.current_password' => 'required|current_password',
                        'form.password' => 'required|min:6|confirmed|regex:' . $this->password_regex,
                        'form.password_confirmation' => 'required|min:6',
                    ];
                } elseif ($title === 'userCreate' || 'userUpdate') {
                    $rules = [
                        'form.name' => 'required|min:4',
                        'form.email' => 'required|email|unique:users,email,' . $id,
                        'form.current_password' => 'required|current_password',
                        'form.password' => 'required|min:6|confirmed|regex:' . $this->password_regex,
                        'form.password_confirmation' => 'required|min:6',
                    ];
                }

                $messages = [
                    "form.name.required" => "Name is required",
                    "form.name.alpha" => "Name allowed only alphabetic characters",
                    "form.name.min" => "Name require minimum 4 characters",
                    "form.name.unique" => $uctitle . " name already exists",

                    "form2.name.required" => "Name is required",
                    "form2.name.min" => "Name require minimum 4 characters",

                    "form.slug.required" => "Slug name is required",
                    "form.slug.unique" => "Slug name already exists",
                    "form.slug.min" => "Name require minimum 4 characters",

                    "form.nationality.required" => "Nationality is required",
                    "form.nationality.min" => "Nationality require minimum 4 characters",
                    "form.nationality.unique" => "Nationality already exits",

                    "form.code.required" => "Code is required",
                    "form.code.unique" => "Code already exits",
                    "form.code.min" => "Code require minimum 2 characters",
                    "form.code.max" => "Code require maximum 3 characters",

                    "form.guard.required" => "Guard name is required",
                    "form.email.required" => "Email addresses is required",
                    "form.email.email" => "Invalid email addresses",
                    "form.email.unique" => "Email ID already exists",

                    "form.admin-email.required" => "Email addresses is required",
                    "form.admin-email.email" => "Invalid email addresses",
                    "form.admin-email.unique" => "Email ID already exists",

                    "form.current_password.required" => "Current password is required",
                    "form.current_password.current_password" => "Current password didn't match",

                    "form.password.required" => "Password is required",
                    "form.password.min" => "Password require minimum 6 characters",
                    "form.password.confirmed" => "New Password and Confirm Password didn't match",
                    "form.password.regex" => "Password must contain minimum 6, at least one uppercase letter, one lowercase letter, one number and one special character",
                    "form.password_confirmation.required" => "Confirm Password is required",
                    "form.password_confirmation.min" => "Confirm Password require minimum 6 characters",

                    "form.position.required" => "Position is required",
                    "form.position.integer" => "Position must be integer",
                    "form.position.min" => "Position must start from 1",
                    "form.position.gt" => "Position must greater than 0",
                    "form.position.unique" => "Position already taken",


//                    "form.folder.required" => "Select folder",
                    "form.folder.integer" => "Folder ID must be integer",
                    "form.folder.min" => "Folder ID must start from 1",
                    "form.folder.gt" => "Position must greater than 0",
                    "form.folder.unique" => "Position already taken",


                    "form.category.required" => "Select category",
                    "form.category.integer" => "Category ID must be integer",
                    "form.category.min" => "Category ID must start from 1",
                    "form.category.unique" => "Category position already taken",

                    "form.roles.required" => "Roles filed is required",
                    "form.roles.min" => "Roles requires minimum 4 characters",
                    "form.roles.regex" => "Role allowed only alphabetic characters and pipeline character '|' ",

                    "form.permissions.required" => "Roles field is required",
                    "form.permissions.min" => "Roles requires minimum 4 characters",
                    "form.route.required" => "Route name is required",
                    "form.route.regex" => "Route allowed only alphabetic characters and dot '.' ",

                    "form.link.integer" => "Folder ID must be integer",
                    "form.link.min" => "Folder ID must start from 1",
                    "form.link." => "Folder ID must start from 1",

                    "form.country.required" => "Please select country",
                    "form.country.integer" => "Country ID must be integer",

                    "form.country.gt" => "Country ID must be greater than 0",
                    "form.country.min" => "Country ID must have minimum 1",

                    "form.timezone.required" => "Time Zone is required",
                    "form.timezone.min" => "Time Zone requires minimum 4 characters",
                    "form.timezone.timezone" => "Invalid Time Zone",

                    "form.country_name.required" => "Country name is required",
                    "form.country_name.min" => "Country name required minimum 4 characters",
                    "form.country_name.unique" => "Country name already exists",
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
                    "form.continent.required"=>"Continent is required",
                    "form.continent.alpha" => "Continent must be alphabets",
                    "form.continent.min" => "Continent requires minimum characters",
                    "form.continent.max" => "Continent requires  maximum 2 characters",
                    "form.currency_code.required"=>"Continent is required",
                    "form.currency_code.alpha" => "Currency Code must be alphabets",
                    "form.currency_code" => "Currency Code must be alphabets",
                    "form.currency_code.min" => "Continent requires minimum 3 characters",
                    "form.currency_code.max" => "Continent requires maximum 3 characters",
                    "form.currency_name.required"=>"Continent is required",
                    "form.currency_name.min" => "Continent requires minimum 2 characters",
                    "form.postal_code.required"=>"Postal code is required",
                    "form.languages.required"=>"Languages is required",
                    "form.languages.regex"=>"Languages must only have alhpa characters and dash",
                    "form.phone_prefix.required"=>"Phone prefix is required",
                    "form.phone_prefix.min" => "Phone prefix requires minimum 2 characters",
                    "form.phone_prefix.regex" => "Phone prefix must only contain integers [0-9], +, -",

                    "form.geonameid.required"=>"Geonameid is required",
                    "form.geonameid.numeric"=>"Geonameid must be integers",
                    "form.geonameid.unique" => "Geonameid already exists",


                ];
                $this->selectedRules($rules, $names);

                $validation['rules'] = $this->selectedRules;

                $validation['messages'] = $this->getRuleMessage($title, $this->selectedRules, $messages);

        }


        $validate = $t->validate(
            $validation['rules'],
            $validation['messages']
        );

        return $validate;
    }

    public function validateForm($t, $submitFields, $validationName, $form=null,$crudID = null)
    {
        $array = [];
        ($form==null)?$form='form.':$form=$form.'.';

        foreach ($submitFields as $recordFields => $formFields) {
            array_push($array, $form.$formFields);
        }
        if ($crudID != null && count($array) > 0) {
            $this->formValidation($t, $validationName, $array, $crudID);
        } else {
            $this->formValidation($t, $validationName, $array);
        }
    }

    protected function selectedRules($rules, $names)
    {
        $arrayRules = array_keys($rules);
        foreach ($names as $name) {
            if (in_array($name, $arrayRules)) {
                $this->selectedRules[$name] = $rules[$name];
            }
        }
    }

    protected function getRuleMessage($title, $rules, $messages)
    {
        foreach ($rules as $name => $validation) {
            if (is_array($validation)) {
                foreach ($validation as $validationPoint) {

                    if (is_array($validationPoint)) {

                        $selected_rule_break[$validationPoint[0]] = $validationPoint[1];
                        foreach ($selected_rule_break as $key => $value) {
                            $this->getMessage($title, $key, $name, $messages);
                        }
                    } else {
                        $this->getMessage($title, $validationPoint, $name, $messages);
                    }
                }
            } elseif (str_contains($validation, '|')) {

                $validationExpand = explode('|', $validation);

                foreach ($validationExpand as $validationPoint) {


                    if (str_contains($validationPoint, ':')) {
                        $validationExpandColon = explode(':', $validationPoint);
                        $selected_rule_break = [];
                        $selected_rule_break[$validationExpandColon[0]] = $validationExpandColon[1];
                        foreach ($selected_rule_break as $key => $value) {
                            $this->getMessage($title, $key, $name, $messages);
                        }
                    } else {
                        $this->getMessage($title, $validationPoint, $name, $messages);
                    }
                }

            } elseif (str_contains($validation, ':')) {

                $validationExpandColon = explode(':', $validation);
                $selected_rule_break = [];
                $selected_rule_break[$validationExpandColon[0]] = $validationExpandColon[1];
                foreach ($selected_rule_break as $key => $value) {
                    $this->getMessage($title, $key, $name, $messages);
                }
            } else {
                $this->getMessage($title, $validation, $name, $messages);
            }

        }
        return $this->validationFinal;
    }

    protected function getMessage($title, $validationPoint, $name, $messages)
    {
        switch ($validationPoint) {
            case 'required' || 'confirmed' || 'min' || 'email' || 'unique' || 'regex' || 'iso' || 'iso3' ||
                'continent' || 'phone_prefix' || 'postal_code' || 'currency_code' || 'currency_name' || 'languages' ||
                'geonameid':
                $this->validationFinal[$name . '.' . $validationPoint] = $messages[$name . '.' . $validationPoint];
                break;
        }


//        foreach ($names as $key => $value) {
//            $selected[$key] = $rules[$key];
//            $selected_rules = explode('|', $selected[$key]);
//            foreach ($selected_rules as $selected_rule) {
//                if (str_contains($selected_rule, ':')) {
//                    $selected_rule_break = [];
//                    $str = explode(':', $selected_rule);
//                    $selected_rule_break[$str[0]] = $str[1];
//                    foreach ($selected_rule_break as $k => $v) {
//                        $message = $this->message($title, $value, $k, $v);
//                        $selected_messages[$key . '.' . $k] = $message;
//                    }
//                } else {
//                    $message = $this->message($title, $value, $selected_rule);
//                    $selected_messages[$key . '.' . $selected_rule] = $message;
//                }
//            }
//        }
//        return $selected_messages;
    }


}
