<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        $directory = public_path('images');

        if (! File::isDirectory($directory)) {
            return response()->json(['data' => []]);
        }

        $images = collect(File::files($directory))
            ->filter(fn ($file) => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']))
            ->map(fn ($file) => [
                'name' => $file->getFilename(),
                'path' => '/images/' . $file->getFilename(),
                'url' => url('/images/' . $file->getFilename()),
            ])
            ->values();

        return response()->json(['data' => $images]);
    }
}
