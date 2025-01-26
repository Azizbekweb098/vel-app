<?php 
namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService
{
    public function upload(UploadedFile $image, string $path = 'images'): string
    {
        $imageName = time() . '_'  . $image->getClientOriginalName();
        $image->move(public_path($path), $imageName);
        return $path . '/'. $imageName;
    }
}