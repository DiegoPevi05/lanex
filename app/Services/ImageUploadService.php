<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageUploadService
{
    /**
     * Store or replace an uploaded image in a type-specific folder.
     *
     * @param UploadedFile $image The new image file to upload.
     * @param string $type The type-specific folder to save the image in.
     * @param string|null $existingImagePath Optional existing image path to replace.
     * @return string The path of the saved image.
     * @throws \Exception if the upload fails.
     */
    public static function storeOrReplaceImage(UploadedFile $image, string $type, string $existingImagePath = null): string
    {
        // Validate the type and get the folder name
        $folderName = self::getType($type);
        $storagePath = "/images/{$folderName}";
        Log::info("Storing image in folder: {$storagePath}");

        // Delete the existing image if a path is provided
        if ($existingImagePath && Storage::exists("{$existingImagePath}")) {
            Storage::delete("{$existingImagePath}");
            if (!Storage::delete("{$existingImagePath}")) {
                        Log::error("Failed to delete the existing image at path: public/{$existingImagePath}");
            }
        }

        // Generate a unique filename and store the new image
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
        Log::info("Generated filename: {$filename}");
        if (!$image->storeAs($storagePath, $filename,'public')) {
            Log::error("Failed to store the image in path: {$storagePath}");
            throw new \Exception("Failed to store the image.");
        }

        // Return the stored path (relative to public)
        Log::info("Image successfully stored at: images/{$folderName}/{$filename}");
        return "/images/{$folderName}/{$filename}";
    }

    /**
     * Determine the type folder name based on entity type.
     *
     * @param string $type
     * @return string The validated folder name.
     * @throws \Exception if the type is not allowed.
     */
    public static function getType(string $type): string
    {
        $allowedTypes = ['service', 'product','supplier', 'user','blog']; // Update allowed types as needed
        if (!in_array($type, $allowedTypes)) {
            throw new \Exception("Invalid type specified.");
        }
        return $type;
    }
}
