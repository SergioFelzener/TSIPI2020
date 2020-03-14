<?php
namespace App\Traits;

trait UploadTrait
{
    private function imageUpload($images, $imageColumn = null){

        $uploadImage = [];

        if(is_array($images)){
            foreach($images as $image){

                $uploadImage[] = [$imageColumn => $image->store('produtos', 'public')];
            }
        }else {
            $uploadImage = $images->store('logo', 'public');

        }

        return $uploadImage;

    }


}




