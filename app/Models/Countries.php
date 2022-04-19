<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Countries extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'iso',
        'iso3',
        'fips',
        'continent',
        'country_code',
        'postal_code',
        'languages',
        'geonameid',
        'phone_prefix',
        'currency_name',
    ];

    public function regions(){
        return $this->hasMany(Regions::class,'countries_id','id');
    }

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}
