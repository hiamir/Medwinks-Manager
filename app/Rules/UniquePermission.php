<?php

namespace App\Rules;

use App\Traits\Query;
use Illuminate\Contracts\Validation\Rule;

class UniquePermission implements Rule
{
    public $record;
    public $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($record,$id)
    {
        $this->record=$record;
        $this->id=$id;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $assignedPermissions=json_decode($this->record->pluck('id'));
        if(!in_array($this->id,$assignedPermissions)){
            return true;
        }
//        if(!Query::permission_check_by_name($value)) {
//            return true;
//        }
//            $id=Query::permission_id_by_name($value);
//            dd($id);

//            if(Query::permission_check_by_id($this->record->id)){
//                return true;
//            }


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ":attribute does'nt exists";
    }
}
