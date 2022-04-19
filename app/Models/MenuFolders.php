<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class MenuFolders extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;
    protected $table = 'menu_folders';
    protected $fillable = [
        'id',
        'name',
    ];

    public function links(){
        return $this->hasMany(\App\Models\MenuLinks::class,'folder_id','id');
    }

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}
