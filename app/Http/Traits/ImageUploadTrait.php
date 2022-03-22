<?php

namespace App\Http\Traits;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait {
    /**
     *  Taking input image as parameter
     *  Return url image.
     */
    public function imageUpload($image, $model, $object = null )
    {
        if ($object != null && $object->image != null) 
            Storage::delete($object->image);
        $fileName = time().'_'.$image->getClientOriginalName();
        $filePath = $image->storeAs($model, $fileName, 'public');
        return 'storage/'.$filePath;
    }
}