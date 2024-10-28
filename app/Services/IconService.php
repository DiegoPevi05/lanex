<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class IconService
{
    public static function getAllSvgIcons(): array
    {
        // Define the SVG directory path
        $svgDirectory = 'images/svgs';

        // Get all SVG files in the directory
        $svgFiles = Storage::disk('public')->files($svgDirectory);

        $icons = [];

        foreach ($svgFiles as $file) {
            // Extract only the file name
            $filename = basename($file);

            // Store the relative path for each SVG file
            $icons[$filename] = '/' . $file;

        }

        return $icons;
    }
}
