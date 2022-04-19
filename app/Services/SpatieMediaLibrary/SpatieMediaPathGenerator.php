<?php
namespace App\Services\SpatieMediaLibrary;
use App\Models\Passports;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;


class SpatieMediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        switch ($media->model_type){
            case Passports::class :
                return ('passports/'.(md5('passports/'.$media->id . config('app.key')).'/'));

            default:
                return md5($media->id . config('app.key')).'/';
        }
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'/conversions/';
    }


    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'/responsive/';
    }
}
