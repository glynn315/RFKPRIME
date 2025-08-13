<?php

namespace App\Http\Controllers;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // store file in storage/app/public/documents
        $path = $request->file('file')->store('documents', 'public');

        $document = Documents::create([
            'file_name' => $request->file_name,
            'file_path' => $path,
        ]);

        return response()->json([
            'message' => 'Document uploaded successfully',
            'data' => $document
        ], 201);
    }

    public function index()
    {
        return Documents::all();
    }

}
