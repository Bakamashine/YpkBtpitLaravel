<?php

namespace App\Services;

use App\Contracts\IImageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Laravel\Facades\Image;
use Request;
use Str;

class ImageService implements IImageService
{
    private int $width = 300;
    private int $height = 300;

    public function setWidth(int $width)
    {
        $this->width = $width;
        return $this;
    }

    public function setHeight(int $height)
    {
        $this->height = $height;
        return $this;
    }


    private function saveFile(ImageInterface $image, UploadedFile $upload, string $path)
    {
        $file_name = Str::random() . '.' . $upload->getClientOriginalExtension();
        $content = $image->encodeUsingFileExtension(
            $upload->getClientOriginalExtension(),
            quality: 70
        );
        $real_path = "$path/$file_name";
        if (
            Storage::disk('public')
                ->put($real_path, $content)
        ) {
            return $real_path;
        }
    }

    public function uploadImage(?UploadedFile $upload, string $path): ?string
    {
        if (!$upload)
            return null;
        $image = Image::decode($upload)
            ->resize($this->width, $this->height);

        return $this->saveFile($image, $upload, $path);
    }

    public function updateImage(?UploadedFile $upload, string $path, ?string $old_path): ?string
    {
        // Storage::disk('public')->delete($old_path);
        $this->removeImage($old_path);
        return $this->uploadImage($upload, $path);
    }

    public function removeImage(?string $path): void {
        Storage::disk('public')->delete($path);
    }

}
