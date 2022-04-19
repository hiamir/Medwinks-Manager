<?php

namespace App\Traits;


use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

trait Quicker
{
    protected $code;
    protected $array = [];

//  TOASTR DISPLAY

    static public function toastr($t, $type, $message)
    {
        $t->dispatchBrowserEvent('alert',
            ['type' => $type, 'message' => $message]);

        session()->forget('success');
        session()->forget('info');
        session()->forget('warning');
        session()->forget('error');
    }


//  SWEETALERT DISPLAY

    public static function sweetalert($title, $message, $icon)
    {
        return redirect()->back()->with('sweet-alert',
            [
                'title' => $title,
                'message' => $message,
                'icon' => $icon
            ]);
    }

//  SWEETALERT DISPLAY

    public static function validateMySQLTimeStamp($timeStamp)
    {
        if ($timeStamp != null) {
            return DateTime::createFromFormat('Y-m-d H:i:s', $timeStamp);
        } else {
            return false;
        }
    }

//  CONVERT QUERY TO ARRAY

    public static function convertArray($query, $field)
    {
        $array = [];
        foreach ($query as $record) {
            $array[$record->id] = $record->$field;
        }
        return $array;
    }


    //  Checkbox Processes Create
    public static function processCheckboxCreate($form, $data, $id, $name, $sub, $queryName, $names = false)
    {
        $array = [];
        $list = [];


        // PROCESS CHECKBOXS
        foreach ($data as $key => $value) {
            $list[$sub . '-' . $id . '-' . $key] = $key;

            if (isset($form[$name][$sub . '-' . $id . '-' . $key])) {
                if ($form[$name][$sub . '-' . $id . '-' . $key] === true) {
                    $array[$name][$sub . '-' . $id . '-' . $key] = true;
                } else {
                    $array[$name][$sub . '-' . $id . '-' . $key] = false;
                }
            }
        }

        // PUSH ALL CHECK VALUES IN TO NEW ARRAY
        $checked = [];
        foreach ($form[$name] as $key => $value) {
            if ($value === true) {
                array_push($checked, $list[$key]);
            }
        }
        // CHECK IF OUTPUT NAMES ARE REQUIRED
        if ($names) {
            $namesArray = [];
            foreach ($checked as $key) {
                array_push($namesArray, Query::$queryName($key));

            }

            return json_encode($namesArray);
        } else {
            return $checked;
        }
    }

    public static function processCheckbox($name, $record, $data, $id)
    {
        $arrayWithKeys = [];
        if (!is_array($record)) {
            foreach ($data as $key => $value) {
                if (in_array($value, json_decode($record, true))) {
                    $d = $key;
                    array_push($arrayWithKeys, $d);
                }
            }
        } else {
            $arrayWithKeys = $record;
        }


        $array = [];
        $list = [];
        foreach ($data as $key => $value) {
            $list[$name . '-' . $id . '-' . $key] = $key;

            if (in_array($key, $arrayWithKeys, true)) {
                $array[$name . '-' . $id . '-' . $key] = true;
            } else {
                $array[$name . '-' . $id . '-' . $key] = false;
            }
        }
        return $array;
    }


    //  RADIOBUTTON SELECT

    public static function processRadioButton($child, $data, $filteredData, $id)
    {
        $array = [];
        $list = [];
        foreach ($data as $key => $value) {
            $list[$child . '-' . $id . '-' . $key] = $key;

            if (in_array($key, json_decode(json_encode($filteredData), true))) {
                $array[$child . '-' . $id . '-' . $key] = "on";
            } else {
                $array[$child . '-' . $id . '-' . $key] = "off";
            }
        }

        $checked = [];
        foreach ($array as $key => $value) {
            if ($value === 'on') {
                array_push($checked, $list[$key]);
            }
        }
        return ['data' => $array, 'checked' => $checked];

    }


//  CHECKBOX PROCESS

    public static function finalizeRadioButton($data, $filteredData)
    {
        $checked = [];
        foreach ($data as $key => $value) {
            if ($value === 'on') {

                array_push($checked, $filteredData[$key]);
            }
        }
        return $checked;
    }


    //  CheckRadioButton Processes

    static public function capatilizeFirst($text)
    {
        return ucfirst($text);
    }


    //  RadioButton Submit

    static public function capatilizeEach($text)
    {
        return ucwords($text);
    }


//  CAPITALIZE FIRST WORD

    static public function currentPage($data)
    {
        return ($data->currentPage() - 1) * $data->perPage() + ($data->total() ? 1 : 0);
    }

//  CAPITALIZE FIRST EACH WORD

    static public function perPage($data)
    {
        return ($data->currentPage() - 1) * $data->perPage() + count($data);
    }

//  PAGINATION FIRST PAGE

    static public function total($data)
    {
        return ($data->total());
    }

//  PAGINATION PER PAGE

    static public function generate_two_factor_code()
    {
        return rand(100000, 999999);
    }


//  PAGINATION TOTAL PAGE

    static public function generate_two_factor_expiry()
    {
        return now()->addMinutes(10);
    }

//  TWO FACTOR GENERATE

    public static function sortArray($array, $sortKey, $direction, $json = null)
    {

        ($direction == 'DESC') ? $direction = SORT_DESC : $direction = SORT_ASC;
        $sortArray = array();

        foreach ($array as $item) {
            if ($json === true) $item = json_decode($item, true);
//        dd(json_decode($item,true));
            foreach ($item as $key => $value) {

                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        //change this to whatever key you want from the array

        array_multisort($sortArray[$sortKey], $direction, $array);

        return $array;
    }

//  TWO FACTOR EXPIRY DATE

    public static function routeCheck($route)
    {
        return (Route::has($route) ? true : false);
    }




//  SWEETALERT COMPONENT TITLE

    public function radioButton($id, $rid, $parentName, $childName)
    {
        $selected = $childName . '-' . $id . '-' . $rid;

        foreach ($this->form[$parentName] as $key => $value) {
            if ($key === $selected) {
                $this->form[$parentName][$key] = "on";
                $this->checked = [];

                array_push($this->checked, $rid);
            } else {
                $this->form[$parentName][$key] = "off";
            }
        }
    }

//  SWEETALERT COMPONENT MESSAGE

    public function resetTwoFactorCode($t)
    {
        $t->timestamps = false;
        $t->email_verified_at = null;
        $t->two_factor_code = $this->code = rand(100000, 999999);
        $t->two_factor_expires_at = now()->addMinutes(10);
        $t->save();
        return $this->code;
    }

//  BOOTSTRAP MODAL CLOSE

    public function sweetAlertComponentTitle($type)
    {
        return 'Component <strong>' . $type . '</strong>  Error!';
    }

//  BOOTSTRAP MODAL CLOSE BACKGROUND

    public function sweetAlertComponentMessage($var)
    {
        return '<strong>' . $var . '</strong>' . ' variable missing! Contact administrator!';
    }

// MODEL BACKGROUND CLOSE

    public function modalClose($modalID)
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('modalClose', $modalID);
    }

// LIST CLOSE

    public function modalBackgroundClose()
    {
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('modalBackgroundClose');
    }

// GUARD GET ADMIN

    public function listClose($listName)
    {
        $this->$listName = 'none';
    }

    // GET ROUTE

    public static function route_name(){
       return Request::route()->getName();
    }

    //GET PREVIOUS ROUTE NAME
    public static function route_previous_name(){
        $back_route = app('router')->getRoutes()->match(app('request')->create(redirect()->back()->getTargetUrl()));
        return $back_route->getName();
    }

    //GET PREVIOUS ROUTE  PARAMS
    public static function route_previous_params(){
        $back_route = app('router')->getRoutes()->match(app('request')->create(redirect()->back()->getTargetUrl()));
        return $back_route->parameters();
    }

    //CRUD LOG MESSAGES

    public static function log_message($crud,$name){
        switch($crud){
            case 'create':
                return $name.' was created';
            case 'update':
                return $name.' was updated';
            case 'delete':
                return $name.' was delated';

            default:
                return 'Unknown';
        }
    }


    //VALIDATION TRY CATCH

    public function validateTryCatch($form=null,$emitValidationName=null){
        if($emitValidationName==null)$emitValidationName='validation-error';
        try {
            $this->validate($form);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emitSelf($emitValidationName,$e);
            $this->validate($form);
        }
    }
}
