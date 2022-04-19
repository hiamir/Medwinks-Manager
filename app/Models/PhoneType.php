<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }
}
