<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();

            // Store file in storage/app/public/uploads
            $path = $file->storeAs('uploads', $filename, 'public');

            // Generate full public URL
            $url = asset('storage/'.$path);

            return response()->json([
                'message' => 'Image uploaded successfully',
                'url' => $url,
                'path' => $path,
            ], 201);
        }

        return response()->json([
            'message' => 'No image file provided',
        ], 400);
    }
}
