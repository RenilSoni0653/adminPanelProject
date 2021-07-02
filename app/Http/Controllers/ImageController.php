<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('theme.images.index');
    }

    public function uploadFile(Request $request)  
    {
        dd($request);
        $file = $request->file('file');
        $fileName = time().'.'.$file->extension();
        $file->move(public_path('images'),$fileName);

        $imageUpload = new Image();
        $imageUpload->filename = $filename;
        $imageUpload->save();

        return response()->json(['success'=>$fileName]);
    } 
}
