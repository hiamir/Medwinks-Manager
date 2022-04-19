<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequirements extends Model
{
    use HasFactory;

    public function logs()
    {
        return $this->morphToMany(Logs::class, 'loggable');
    }

    public function services(){
        return $this->belongsToMany(Services::class);
    }
}
