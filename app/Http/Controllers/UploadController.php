<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image', 'public');
        }
        return response()->json([
            'message' => 'True',
            'name' => $validated['name'],
            'image_path' => $path ?? null,
        ], 201);
    }
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $fileName);

            return response()->json([
                'message' => 'true',
                'file' => $fileName,
            ]);
        } else {
            return response()->json([
                'message' => 'false',
            ], 400);
        }
    }

    public function dowloadFile($fileName)
    {
        if (Storage::exists('public/uploads' . $fileName)) {
            return response()->download(storage_path('app/public/uploads' . $fileName));
        } else {
            return response()->json([
                'message' => 'false'
            ], 404);
        }
    }
}
