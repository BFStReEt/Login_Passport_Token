<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $formData = $request->all();

        //Xử lý

        return response()->json([
            'message' => 'True',
            'data' => $formData
        ], 200);
    }
}
