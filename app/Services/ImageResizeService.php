<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

//Intervention image ver 4.0.1。

class ImageResizeService{

public function resizeAndSave($file,int $width,int $height,string $directory){
    $filename=uniqid().'.'.$file->getClientOriginalExtension();
    $manager=ImageManager::usingDriver(Driver::class);

    $image=$manager->decodePath($file)->resize($width,$height,function($constraint){
        $constraint->aspectRatio();
        $constraint->upsize();
    })
    ->encode();

    $path=$directory.'/'.$filename;
    Storage::disk('public')->put($path,$image);

    return $path;
    }

}
