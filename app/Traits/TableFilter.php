<?php

namespace App\Traits;


trait TableFilter
{
    public $sortDirectionListTrait=['asc'=>'Ascending','desc'=>'Descending'];
    public $pageNoListTrait=['5'=>'5','10'=>'10','20'=>'20','50'=>'50','100'=>'100'];
    public $guardListTrait=['web'=>'Web', 'admin'=>'Administrator'];


    public static function guardSelect($roleOrPermission){
       return (AuthorizesRoleOrPermission::authorizeBol($roleOrPermission))?$guardListTrait=['web'=>'Web', 'admin'=>'Administrator']:
            $guardListTrait=['web'=>'Web'];;
    }

    public static function guardFilter(){
        $userRole=json_decode(auth()->user()->roles->pluck('name'));

        if(in_array('Super Admin', $userRole) || in_array('Admin', $userRole)) {

            if (in_array('Super Admin', $userRole)) {
                return ['admin' => 'Admin'];
            } else if (in_array('Admin', $userRole)) {
                return ['web' => 'Web'];
            }
        }else{
            return ['error' => 'Not authorized'];
        }
    }

    public static function selectListNames($records,$keyID,$field){
       $array=[];
       if(!empty($records)) {
           foreach ($records as $key => $record) {
               $array[$record->$keyID] = $record->$field;
           }
       }
       return ($array);
    }




//    public function sortBy($field)
//    {
//        $this->sortDirection = $this->sortField === $field
//            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
//            : 'asc';
//
//        $this->sortField;
//    }

}
