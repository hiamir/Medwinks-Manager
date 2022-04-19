<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function models(){
        return $this->belongsTo(Models::class);
    }

    public function applications(){
        return $this->hasMany(Applications::class,'statuses_id','id');
    }
}
