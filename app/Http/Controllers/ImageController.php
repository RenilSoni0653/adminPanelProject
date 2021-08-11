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
            'file' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName(); // This will give you extension of file.
        // $imgResize = Image::make([$image])->fit(300, 300)->save();
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

    public function update(Request $request)
    {
        $path = public_path('images');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        $query = DB::table('images')
        ->where('id',$request->id)
        ->update([
            'name' => $request->file('file')->getClientOriginalName()
        ]);
        
        
        $file = $request->file('file');
        $imgname = $file->getClientOriginalName();
        $file->move($path, $imgname);

        return response()->json([
            'name'          => $imgname,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function destroy($id)
    {
        $query = DB::table('images')->where('id', $id)->first();
        $id = Image::find($query->id);

        $id->delete();

        return redirect('images/index')->with('success','Image deleted successfully');
    }
}
