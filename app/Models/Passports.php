<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Passports extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'passports';
    protected $fillable = ['given_name'];

    /**
     * Register the media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function region(){
        return $this->belongsTo(Regions::class,'regions_id','id');
    }

    public function country(){
        return $this->belongsTo(Countries::class,'countries_id','id');
    }

    public function logs()
    {
        return $this->morphToMany(Logs::class, 'loggable');
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDateOfBirthAttribute($value)
    {
        return  Carbon::parse($this->attributes['date_of_birth'])->format('F j, Y');
    }

    public function setIssueDateAttribute($value)
    {
        $this->attributes['issue_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getIssueDateAttribute($value)
    {
        return  Carbon::parse($this->attributes['issue_date'])->format('F j, Y');
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getExpiryDateAttribute($value)
    {
        return  Carbon::parse($this->attributes['expiry_date'])->format('F j, Y');
    }
}
