<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}