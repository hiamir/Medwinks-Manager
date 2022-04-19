<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Divisions extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = ['name'];

    public function country()
    {
        return $this->belongsToMany(Countries::class);
    }

//    public function division()
//    {
//        return $this->belongsToMany(Divisions::class);
//    }

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function addresses(){
        return $this->morphToMany(Addresses::class,'addressable');
    }
}
