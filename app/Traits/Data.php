<?php

namespace App\Traits;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Validator;
use Throwable;

trait Data
{
    public $backupForm;
    private $DBerror;
    private $log_name;

    public static function capitalize_each_word($data)
    {
        return ucwords($data);
    }

    public static function all_upper_case($data)
    {
        return strtoupper($data);
    }

    public static function deleteMessage($parentName, $parentField, $childName = null, $count = null)
    {
        if ($count > 0) {
            return "Are you sure you want to delete $parentField? There are $count $childName linked this $parentName";
        } else {
            return "Are you sure you want to delete $parentField";
        }
    }

    public function form($formName)
    {

        switch ($formName) {
            case 'form':
                return $this->form;
            case 'form1':
                return $this->form1;
            case 'form2':
                return $this->form2;
            case 'form3':
                return $this->form3;
            case 'form4':
                return $this->form4;
            case 'form5':
                return $this->form5;
            default:
                return $this->form;
        }
    }

    // RECORD FIELDS

    public function clearFields($form = null)
    {
        switch ($form) {
            case 'form1':
                $this->form1 = $this->form1Backup;
                break;
            case 'form2':
                $this->form2 = $this->form2Backup;
                break;
            case 'form3':
                $this->form3 = $this->form3Backup;
                break;
            case 'form4':
                $this->form4 = $this->form4Backup;
                break;
            case 'form5':
                $this->form5 = $this->form5Backup;
                break;
            case 'form6':
                $this->form6 = $this->form6Backup;
                break;
            default:
                $this->form = $this->formBackup;
                break;
        }
//        foreach ($submitFields as $recordField => $formField) {
//            if (is_Array($this->form($form)[$formField])) {
//                $this->form($form)[$formField] = [];
//            } else {
//                $this->form($form)[$formField] = '';
//            }
//        }
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function getRecords($record, $submitFields = null, $getForm = null)
    {
        if ($submitFields == null) {
            $submitFields = $this->submitFields;
        }
        switch ($getForm) {


            case 'form1':
                foreach ($submitFields as $recordField => $formField) {
                    $this->form1[$formField] = $record->$recordField;
                }

                break;
            case 'form2':
                foreach ($submitFields as $recordField => $formField) {
                    $this->form2[$formField] = $record->$recordField;
                }
                break;
            case 'form3':
                foreach ($submitFields as $recordField => $formField) {
                    $this->form3[$formField] = $record->$recordField;
                }
                break;
            case 'form4':
                foreach ($submitFields as $recordField => $formField) {
                    $this->form4[$formField] = $record->$recordField;
                }
                break;
            case 'form5':
                foreach ($submitFields as $recordField => $formField) {
                    $this->form5[$formField] = $record->$recordField;
                }
                break;
            case 'form':
            default:
                foreach ($submitFields as $recordField => $formField) {
                    $this->form[$formField] = $record->$recordField;
                }
                break;
        }


    }

    public function submit_record($crud, $id, $modalID, $records, $validationName, $name = null, $fields = null, $data = null, $customCreate = null, $customDelete = null)
    {
        $crud = Data::all_lower_case($crud);
        $table = $records->getTable();

        $difference = false;
        if ($crud == 'create' || $crud == 'update') {
            $this->validateForm($this, $fields, $validationName, $id);

        }
        if ($crud == 'create') {
            $difference = true;
        } elseif ($crud == 'update') {
            foreach ($fields as $recordField => $formField) {
                if ($records->$recordField != $data[$formField]) {
                    $difference = true;
                }
            }
        }

        if (isset($records)) {
            try {
                DB::transaction(function () use ($difference, $modalID, $id, $crud, $table, $name, $records, $fields, $data, $customDelete) {

                    $alert = '';
                    $message = '';
                    switch ($crud) {
                        case 'create':
                        case 'update':
                            if (!$difference) {
                                $this->modalClose($modalID);
                                $alert = 'info';
                                $message = Data::capitalize_first_word('Nothing to update!');
                            } else {
                                foreach ($fields as $recordField => $formField) {
                                    if (Schema::hasColumn($table, $recordField)) {
                                        $records->$recordField = $data[$formField];
                                    }
                                }
                                if (!$data['timestamps']) $records->timestamps = false;

                                $records->save();
                                $alert = 'success';
                                $message = Data::capitalize_first_word($name) . ' was updated successfully!';
                            }
                            break;
                        case 'delete':
                            if ($data['trash'] === true) {
                                if ($customDelete == null) {
                                    $records->delete();
                                    $alert = 'success';
                                    $message = Data::capitalize_first_word($name) . ' was deleted successfully!';
                                } else {
                                    $alert = $customDelete['alert'];
                                    $message = $customDelete['message'];
                                }
                            }
                            break;
                    }

                    $this->modalClose($modalID);
                    Quicker::toastr($this, $alert, $message);
                    $this->modalBackgroundClose();
                });
            } catch (Throwable $e) {
                DB::rollback();
                Quicker::toastr($this, 'error', $e . 'Update Error! Please contact administrator');
                return false;
            }
        }
    }

    public static function all_lower_case($data)
    {
        return strtolower($data);
    }

    //   DATA DIFFERENCE

    public static function capitalize_first_word($data)
    {
        return ucfirst($data);
    }

    // DATA FORMATTER

    public function data_difference($array1, $array2)
    {
        if (array_diff($array2, $array1) != [] || array_diff($array1, $array2) != []) return true;
        return false;
    }


    //DATA SUBMIT

    public function data_formatter($array, $sub)
    {
        foreach (array_keys($array) as $value) {

            $this->inputFinisher($sub . '.' . $value);
        }
    }

    public function submit($crud, $mID, $records, $name = null, $fields = null, $data = null, $customCreate = null, $customUpdate = null, $customDelete = null, $close = true, $showToast=true)
    {
        $crud = Data::all_lower_case($crud);
        (is_string(current($data))) ? $this->log_name = current($data) : $this->log_name = $name;
        ($customCreate != null || $customUpdate != null || $customDelete != null) ? ($difference = true) : ($difference = false);
        $table = $records->getTable();

        if ($crud == 'create' || $crud == 'update') {
            if ($crud == 'create') {
                $difference = true;
            } elseif ($crud == 'update') {
                foreach ($fields as $recordField => $formField) {
                    if ($records->$recordField != $data[$formField]) {
                        $difference = true;
                    }
                }
            }
        }

        if (isset($records)) {
            try {
                DB::transaction(function () use ($difference, $mID, $crud, $table, $name, $records, $fields, $data, $customCreate, $customUpdate, $customDelete,$close,$showToast) {

                    $alert = '';
                    $message = '';
                    switch ($crud) {
                        case 'create':
                        case 'update':

                            if (!$difference) {

                                $alert = 'info';
                                $message = Data::capitalize_first_word('Nothing to update!');
                            } else {


                                try {
                                    DB::transaction(function () use ($records, $name, $crud, $fields, $table, $data, $customCreate, $customUpdate,$showToast) {
                                        if ($customCreate == null && $customUpdate == null) {
                                            foreach ($fields as $recordField => $formField) {
                                                if (Schema::hasColumn($table, $recordField)) {
                                                    $records->$recordField = $data[$formField];
                                                }
                                            }
                                            (!$data['timestamps']) ? $records->timestamps = false : $records->timestamps = true;

                                            $records->save();

                                        } else {
                                            if (!$data['timestamps']) $records->timestamps = false;
                                            if ($customCreate) {
                                                $customCreate->save();
                                            } elseif ($customUpdate) {
                                                $customUpdate->save();
                                            }
                                        }


                                    });

                                    $alert = 'success';
                                    $message = "'" . Data::capitalize_first_word($name) . "'" . ' was updated successfully!';
                                } catch (Throwable $e) {
                                    $records->logs()->create([
                                        'log_type_id' => Query::log_type_id_by_slug($crud),
                                        'guard_id' => Query::guard_type_id_from_auth_guard(),
                                        'auth_id' => auth()->user()->id,
                                        'message' => $e->getMessage()
                                    ]);
                                    $this->DBerror = true;
                                    Quicker::toastr($this, 'error', $e . 'Update Error! Please contact administrator');
                                }
                                if ($records) {
                                    try {
                                        DB::transaction(function () use ($records, $name, $crud) {
                                            $records->logs()->create([
                                                'log_type_id' => Query::log_type_id_by_slug($crud),
                                                'guard_id' => Query::guard_type_id_from_auth_guard(),
                                                'auth_id' => auth()->user()->id,
                                                'message' => Quicker::log_message($crud, $this->log_name)
                                            ]);
                                        });
                                    } catch (Throwable $e) {
                                        $records->logs()->create([
                                            'log_type_id' => Query::log_type_id_by_slug($crud),
                                            'guard_id' => Query::guard_type_id_from_auth_guard(),
                                            'auth_id' => auth()->user()->id,
                                            'message' => $e->getMessage()
                                        ]);
                                        $this->DBerror = true;
                                        Quicker::toastr($this, 'error', 'Update Error! Please contact administrator');
                                    }
                                }
                            }
                            break;
                        case 'delete':
                            if ($data['trash'] === true) {
                                if ($customDelete == null) {
                                    $records->delete();
                                    $data['trash'] = false;
                                    $alert = 'success';
                                    $message = "'" . Data::capitalize_first_word($name) . "'" . ' was deleted successfully!';
                                    $records->logs()->create([
                                        'log_type_id' => Query::log_type_id_by_slug($crud),
                                        'guard_id' => Query::guard_type_id_from_auth_guard(),
                                        'auth_id' => auth()->user()->id,
                                        'message' => Quicker::log_message($crud, $this->log_name)
                                    ]);

                                } else {
                                    $alert = $customDelete['alert'];
                                    $message = $customDelete['message'];
                                }
                            } else {
                                $alert = 'info';
                                $message = Data::capitalize_first_word("'" . $name . "'" . ' was not deleted!');
                            }
                            break;
                    }
                    if ($this->DBerror == true) {
                        DB::rollback();
                        $this->error = false;
                    } else {
                        if($showToast) Quicker::toastr($this, $alert, $message);
                    }

                    if ($close) {
                        $this->modalClose($mID);
                        if ($crud == 'delete') $this->modalBackgroundClose();
                    }
                });
            } catch (Throwable $e) {
                if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                    $alert = 'error';
                    $message = Data::capitalize_first_word("'" . $name . "'" . ' has linked foreign key!');
                } else {
                    $alert = 'error';
                    $message = Data::capitalize_first_word('Update Error! Please contact administrator');
                }
                DB::rollback();

                $records->logs()->create([
                    'log_type_id' => Query::log_type_id_by_slug($crud),
                    'guard_id' => Query::guard_type_id_from_auth_guard(),
                    'auth_id' => auth()->user()->id,
                    'message' => $e->getMessage()
                ]);

                return false;
            }
        }
    }

    public function syncPermissions($record, $modalID, $formArray, $arrayKeys)
    {
        try {
            DB::transaction(function () use ($record, $modalID, $formArray, $arrayKeys) {
                $checked = Quicker::finalizeCheckbox($formArray, $arrayKeys);
                $record->syncPermissions($checked);
                $this->modalClose($modalID);
                Quicker::toastr($this, 'success', ' PermissionExtends for ' . $record->name . ' was updated!');
            });
        } catch (Throwable $e) {

            DB::rollback();
            $record->logs()->create([
                'log_type_id' => Query::log_type_id_by_slug('error'),
                'guard_id' => Query::guard_type_id_from_auth_guard(),
                'auth_id' => auth()->user()->id,
                'message' => $e->getMessage()
            ]);
            $this->modalClose($modalID);
            Quicker::toastr($this, 'error', $e . 'Update Error! Please contact administrator');
            return false;
        }
    }

    // ROUTE NAMES WITH SEARCH

    public function routeNames($guard): array
    {
        $actions = [];

        foreach (Route::getRoutes()->get() as $value) {
            array_push($actions, $value->getAction('as'));
//            if ($this->startsWith($value->getAction('as'), $guard . ".")) {
//                array_push($actions, $value->getAction('as'));
//            }
        }
        return $actions;
    }

    // ROUTE NAMES WITH SEARCH

    public function all_routes(): array
    {
        $actions = [];
        foreach (Route::getRoutes()->get() as $value) {
            array_push($actions, $value->getAction('as'));
        }
        return $actions;
    }


    public function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}
