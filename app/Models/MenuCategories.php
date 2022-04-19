<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class MenuCategories extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name','position',
    ];

    public function links(){
        return $this->hasMany(MenuLinks::class,'category_id','id');
    }
    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}
