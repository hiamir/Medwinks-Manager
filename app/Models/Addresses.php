<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Addresses extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $fillable=[
    'address_type_id',
        'address_line1',
        'address_line2',
        'postal_code',
        'zip_code',
        'countries_id',
        'regions_id',
    ];

    public function address_type(){
        return $this->belongsTo(AddressType::class);
    }
    public function country(){
        return $this->belongsTo(Countries::class,'countries_id','id');
    }
    public function region(){
        return $this->belongsTo(Regions::class,'regions_id','id');
    }
    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function addressable(){
        return $this->morphTo();
    }
}
