<?php

namespace App\Http\Livewire\Traits;

use App\Traits\Data;
use App\Traits\Quicker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Submits extends Component
{
    use Data;
//    public function submit_record($t, $crud, $id, $record, $validationName, $name = null, $fields = null, $data = null)
//    {
//        $crud = Submit::all_lower_case($crud);
//        $table = $record->getTable();
//        $difference = false;
//        if ($crud == 'create' || $crud == 'update') {
//            $t->validateForm($t, $fields, $validationName, $id);
//            $t->validation();
//        }
//        if ($crud == 'create') {
//            $difference = true;
//        } elseif ($crud == 'update') {
//            foreach ($fields as $recordField => $formField) {
//                if ($record->$recordField != $data[$formField]) {
//                    $difference = true;
//                }
//            }
//        }
//        if (isset($record)) {
//            try {
//                DB::transaction(function () use ($t, $difference, $crud, $table, $name, $record, $fields, $data) {
//                    $alert = '';
//                    $message = '';
//                    switch ($crud) {
//                        case 'create':
//                        case 'update':
//                            if (!$difference) {
//                                $t->modalClose($t->modalID);
//                                $alert = 'info';
//                                $message = Data::capitalize_first_word('Nothing to update!');
//                            } else {
//                                foreach ($fields as $recordField => $formField) {
//                                    if (Schema::hasColumn($table, $recordField)) {
//                                        $record->$recordField = $data[$formField];
//                                    }
//                                }
//                                if (!$data['timestamps']) $record->timestamps = false;
//                                $record->save();
//                                $alert = 'success';
//                                $message = Data::capitalize_first_word($name) . ' was updated successfully!';
//                            }
//                            break;
//                        case 'delete':
//                            if ($data['trash'] === true) {
//                                $record->delete();
//                                $alert = 'success';
//                                $message = Data::capitalize_first_word($name) . ' was deleted successfully!';
//                            } else {
//                                $alert = 'info';
//                                $message = Data::capitalize_first_word($name) . ' was not deleted!';
//                            }
//
//                            break;
//                    }
//
//                    $t->modalClose($t->modalID);
//                    Quicker::toastr($t, $alert, $message);
//                    $t->modalBackgroundClose();
//                });
//            } catch (Throwable $e) {
//                DB::rollback();
//                Quicker::toastr($t, 'error', 'Update Error! Please contact administrator');
//                return false;
//            }
//        }
//    }


    public function render()
    {
        return view('livewire.traits.data');
    }
}
