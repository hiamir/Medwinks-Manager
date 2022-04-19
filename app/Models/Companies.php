<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Companies extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = ['name'];

    public function divisions()
    {
//        return $this->belongsToMany(\App\Models\Divisions::class)->withTimestamps();
        return $this->hasMany(\App\Models\Divisions::class);
    }

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function addresses(){
        return $this->morphToMany(Addresses::class,'addressable');
    }
}
