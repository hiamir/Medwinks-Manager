<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function comments(){
        return $this->morphToMany(Comments::class,'commnetable');
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function statuses(){
        return $this->belongsTo(Status::class);
    }

    public function documents(){
        return $this->hasMany(Documents::class);
    }

    public function passports(){
        return $this->belongsTo(Passports::class);
    }
    public function universities(){
        return $this->belongsTo(Universities::class);
    }
    public function services(){
        return $this->belongsTo(Services::class);
    }

}
