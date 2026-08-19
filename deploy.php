<?php

/**
 * Deployment script to sync files from lanex_clone to public_html
 */

$sourceDir = __DIR__;
// Adjust the target directory relative to the current script location
// The user's structure:
// lanexsac.com/
// ├── lanex_clone/ (where this script lives)
// └── public_html/
$targetDir = realpath($sourceDir . '/../public_html');

if (!$targetDir) {
    die("Error: Target directory 'public_html' not found relative to " . $sourceDir . PHP_EOL);
}

// Essential paths to sync for this update.
// Plain entries sync to the same relative path on the target.
// 'src' => 'dst' entries let the target path differ from the source
// (public_html's document root is flattened, so public/build ships to build/).
$pathsToSync = [
    'app',
    'resources',
    'routes',
    'config',
    'database/migrations',
    'database/seeders',
    'artisan',
    'public/build' => 'build',
];

/**
 * Recursively copies source to destination
 */
function syncRecursive($src, $dst) {
    if (is_dir($src)) {
        if (!is_dir($dst)) {
            if (!mkdir($dst, 0755, true)) {
                echo "Failed to create directory: $dst\n";
                return;
            }
        }
        $files = array_diff(scandir($src), ['.', '..']);
        foreach ($files as $file) {
            syncRecursive("$src/$file", "$dst/$file");
        }
    } else {
        if (copy($src, $dst)) {
            // Successfully copied
        } else {
            echo "Failed to copy: $src to $dst\n";
        }
    }
}

echo "--- Starting Deployment Sync ---" . PHP_EOL;
echo "Source: $sourceDir" . PHP_EOL;
echo "Target: $targetDir" . PHP_EOL;

foreach ($pathsToSync as $key => $path) {
    $srcRelative = is_int($key) ? $path : $key;
    $dstRelative = $path;

    $srcPath = $sourceDir . DIRECTORY_SEPARATOR . $srcRelative;
    $dstPath = $targetDir . DIRECTORY_SEPARATOR . $dstRelative;

    if (file_exists($srcPath)) {
        echo "Syncing: $srcRelative -> $dstRelative..." . PHP_EOL;
        syncRecursive($srcPath, $dstPath);
    } else {
        echo "Skip: $srcRelative (Source not found)" . PHP_EOL;
    }
}

echo "--- Sync Completed Successfully ---" . PHP_EOL;
echo "Next step: Go to public_html and run 'php artisan migrate'" . PHP_EOL;
