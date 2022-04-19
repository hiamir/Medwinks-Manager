<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    public function logs()
    {
        return $this->morphToMany(Logs::class, 'loggable');
    }
    public function applications(){
        return $this->hasMany(Applications::class);
    }



    public function service_requirements(){
        return $this->belongsToMany(ServiceRequirements::class);
    }
}
