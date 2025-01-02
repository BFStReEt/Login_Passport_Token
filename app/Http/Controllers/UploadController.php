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
}
