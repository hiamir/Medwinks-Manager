<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Regions extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'countries_id',
        'time_zone',
    ];

    public function country(){
        return $this->belongsTo(Countries::class,'countries_id','id');
    }
}
