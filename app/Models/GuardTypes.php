<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardTypes extends Model
{
    use HasFactory;
    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}
