<?php
namespace App\Services\Image\ImageUpload;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Save uploaded file images
     */
    public function store(UploadedFile $uploadedFile, string $folderName, string $disk, string $prefix = ''): string
    {
        $fileName = $prefix !== '' ? "{$prefix}_{$uploadedFile->hashName()}" : $uploadedFile->hashName();
        return $uploadedFile->storeAs($folderName, $fileName, [
            'disk' => $disk
        ]);
    }

    /**
     * Delete given file path
     */
    public function delete($path, string $disk): bool
    {
        return Storage::disk($disk)->delete($path);
    }
}