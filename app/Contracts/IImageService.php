<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;


interface IImageService
{
    public function uploadImage(?UploadedFile $upload, string $path): ?string;
    public function updateImage(?UploadedFile $upload, string $path, ?string $old_path): ?string;
    public function removeImage(?string $path): void;
}
