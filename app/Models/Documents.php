<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Documents extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * Register the media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents')
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



    public function logs(){
        return $this->morphToMany(Logs::class,'loggable');
    }

    public function comments(){
        return $this->morphToMany(Comments::class,'commnetable');
    }

    public function service_requirements(){
        return $this->belongsTo(ServiceRequirements::class);
    }
}
