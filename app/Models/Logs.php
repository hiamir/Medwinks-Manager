<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

//    public $timestamps = false;
    protected $fillable = ['log_type_id', 'guard_id', 'auth_id', 'message'];

    public function loggable()
    {
        return $this->morphTo();
    }
}

