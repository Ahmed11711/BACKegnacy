<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Upload file
     */
    public function upload(UploadedFile $file, string $folder = 'uploads', ?string $disk = null): string
    {
        $disk = $disk ?? config('filesystems.default');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $extension;
        $path = $file->storeAs($folder, $filename, $disk);

        return $path;
    }

    /**
     * Upload image
     */
    public function uploadImage(UploadedFile $file, string $folder = 'images', ?string $disk = null): string
    {
        return $this->upload($file, $folder, $disk);
    }

    /**
     * Upload multiple files
     */
    public function uploadMultiple(array $files, string $folder = 'uploads', ?string $disk = null): array
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->upload($file, $folder, $disk);
        }
        return $paths;
    }

    /**
     * Delete file
     */
    public function delete(string $path, ?string $disk = null): bool
    {
        $disk = $disk ?? config('filesystems.default');
        return Storage::disk($disk)->delete($path);
    }

    /**
     * Get file URL
     */
    public function url(string $path, ?string $disk = null): string
    {
        $disk = $disk ?? config('filesystems.default');
        return Storage::disk($disk)->url($path);
    }
}
