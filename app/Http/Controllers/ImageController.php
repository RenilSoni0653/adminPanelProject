<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function index()
    {
        return view('theme.images.index');
    }

    public function uploadFile(Request $request)  
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName(); // This will give you extension of file.
        $image->move(public_path('images'),$imageName);

        $imageUpload = new Image();
        $imageUpload->name = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    } 
}
