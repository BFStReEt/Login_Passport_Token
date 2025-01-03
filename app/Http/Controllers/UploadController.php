<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


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
            $request->validate([
                'file' => 'required|max:2048',
            ]);
            $fileName = time() . '.' . $request->file->extension();

            $request->file->move(public_path('storage/uploads'), $fileName);
            return response()->json([
                'message' => 'true',
                'file' => $fileName
            ]);
        } else {
            return response()->json([
                'message' => 'false'
            ], 400);
        }
    }

    public function downloadFile($fileName)
    {
        $filePath = public_path('storage/uploads/' . $fileName);
        //dd($fileName);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json([
                'message' => 'File not found.'
            ], 404);
        }
    }
}
