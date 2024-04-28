<?php

namespace App\Http\Controllers;

use App\Enums\ResponseType;
use App\Models\Attachment;
use App\Services\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filenameWithExt = $file->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $file->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $file->storeAs('public/image/attachments', $fileNameToStore);

            return response()->json([
                'url' => Storage::url($path),
            ], ResponseType::HTTP_OK);
        }
    }
}
