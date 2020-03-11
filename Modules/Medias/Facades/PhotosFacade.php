<?php
namespace Modules\Medias\Facades;

use Modules\Medias\Entities\Photo;
class PhotosFacade
{
    public static function getArrayPhotoName()
    {
        $photos = Photo::where('actif', 1)->get();
        $result = array();
        foreach ($photos as $key=>$photo)
        {
            $result[$photo->uuid] = $photo->title;
        }

        return $result;
    }

    public static function getAttributes(){
        $photos = Photo::where('actif', 1)->get();
        $optionsAttributes = array();
        foreach ($photos as $key=>$photo)
        {
			$optionsAttributes[$photo->uuid] = ['data-img-src' => asset('storage/'.$photo->uuid)];
        }

        return $optionsAttributes;
    }
}