<?php

namespace App\Actions;

class SaveFile
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    public function saveFile($file)
    {
    // Check if file is present and valid
    if (!$file || !$file->isValid()) {
        return null;
    }

    // Determine the file type and set the directory accordingly
    $mimeType = $file->getMimeType();
    if (str_starts_with($mimeType, 'image/')) {
        $directory = 'uploads/images';
    } elseif (str_starts_with($mimeType, 'video/')) {
        $directory = 'uploads/videos';
    } else {
        $directory = 'uploads/documents';
    }

    // Generate a unique filename
    $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

    // Store the file in the appropriate directory in the public disk
    $path = $file->storeAs($directory, $filename, 'public');

    // Return the path or URL to the stored file
    return $path;
    }
}
