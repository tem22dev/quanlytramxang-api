<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    public function storeImage($imageFile, $folder, $isThumb = false)
    {
        $hash = date('YmdHis') . Str::random(10);
        $imageFileName = 'image_' . $hash . '.jpg';
        $imageFileNameThumb = 'thumb_image_' . $hash . '.jpg';
        $imagePath = "assets/$folder/";
        $imageFullPath = $imagePath . $imageFileName;
        $imageFullPathThumb = $imagePath . $imageFileNameThumb;

        if (!Storage::disk('public_path')->exists($imagePath)) {
            Storage::disk('public_path')->makeDirectory($imagePath);
        }

        $img = Image::make($imageFile);
        $img->orientate()->save($imageFullPath, 100);

        // Check is allow store thumb image
        if ($isThumb) {
            $img = Image::make($imageFile);
            $img->orientate();
            $img->save($imageFullPathThumb, 60);
        }

        return [
            'url' => $imageFullPath,
            'thumb_url' => $imageFullPathThumb,
        ];
    }

    public function deleteImage($imagePath)
    {
        return Storage::disk('public_path')->delete($imagePath);
    }
}