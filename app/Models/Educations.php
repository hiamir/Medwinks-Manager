<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    use HasFactory;

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function education_types(){
        return $this->hasMany(EducationTypes::class);
    }
}
