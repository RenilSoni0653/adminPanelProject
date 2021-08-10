<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $images = DB::table('Images')->orderBy('id','DESC')->get();
        return view('theme.images.index', compact('images'));
    }

    public function uploadImage()
    {
        return view('theme.images.uploadImage');
    }

    public function uploadFile(Request $request)  
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,svg|max:2048'
        ]);

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName(); // This will give you extension of file.
        // $imgResize = Image::make($imageName)->fit(300, 300)->save();
        $image->move(public_path('images'),$imageName);

        $imageUpload = new Image();
        $imageUpload->name = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function edit($id)
    {
        $images = DB::table('images')->where('id',$id)->first();
        
        return view('theme.Images.edit', compact('images'));
    }

    public function update($id, Request $request)
    {
        dd($request);
        $query = DB::table('images')
        ->where('id',$request->id)
        ->update([
            'name' => $request->name
        ]);

        return redirect('images/index')->with('success', 'Image uploaded successfully');
    }

    public function destroy($id)
    {
        $query = DB::table('images')->where('id', $id)->first();
        $id = Image::find($query->id);

        $id->delete();

        return redirect('images/index')->with('success','Image deleted successfully');
    }
}
