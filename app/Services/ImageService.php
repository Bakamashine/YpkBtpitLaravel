<?php

namespace App\Services;

use App\Contracts\IImageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Laravel\Facades\Image;
use Request;
use Str;

/**
 * Сервис для работы с изображениями: загрузка, изменение размера, обновление и удаление.
 */
class ImageService implements IImageService
{
    /** Ширина изображения после ресайза (по умолчанию 300). */
    private int $width = 300;

    /** Высота изображения после ресайза (по умолчанию 300). */
    private int $height = 300;

    /**
     * Установить ширину изображения.
     */
    public function setWidth(int $width): static
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Установить высоту изображения.
     */
    public function setHeight(int $height): static
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Сохранить обработанное изображение в хранилище.
     *
     * @param ImageInterface $image  Обработанное изображение.
     * @param UploadedFile   $upload Исходный загруженный файл (для определения расширения).
     * @param string         $path   Директория в хранилище.
     *
     * @return string|null Путь к сохранённому файлу или null в случае ошибки.
     */
    private function saveFile(ImageInterface $image, UploadedFile $upload, string $path): ?string
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

    /**
     * Загрузить изображение, изменить его размер и сохранить.
     *
     * @param UploadedFile|null $upload Загруженный файл.
     * @param string            $path   Директория в хранилище.
     *
     * @return string|null Путь к сохранённому файлу или null.
     */
    public function uploadImage(?UploadedFile $upload, string $path): ?string
    {
        if (!$upload)
            return null;
        $image = Image::decode($upload)
            ->resize($this->width, $this->height);

        return $this->saveFile($image, $upload, $path);
    }

    /**
     * Обновить изображение: удалить старое и загрузить новое.
     *
     * @param UploadedFile|null $upload   Новый файл.
     * @param string            $path     Директория в хранилище.
     * @param string|null       $old_path Путь к старому файлу для удаления.
     *
     * @return string|null Путь к новому файлу или null.
     */
    public function updateImage(?UploadedFile $upload, string $path, ?string $old_path): ?string
    {
        $this->removeImage($old_path);
        return $this->uploadImage($upload, $path);
    }

    /**
     * Удалить изображение из хранилища.
     *
     * @param string|null $path Путь к файлу в хранилище.
     */
    public function removeImage(?string $path): void
    {
        Storage::disk('public')->delete($path);
    }

}
