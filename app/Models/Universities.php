<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universities extends Model
{
    use HasFactory;
    protected $table='universities';

    public function logs()
    {
        return $this->morphToMany(Logs::class, 'loggable');
    }
}
