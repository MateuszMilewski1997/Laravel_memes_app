<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function delete_file($photo)
    {
        $path = "storage/cover_images/".$photo[0]->photoPath;
        File::delete($path);

    }
    public function upload_file($request)
    {
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore= date('Y-m-d')."/".$filename.'_'.time().'.'.$extension;
        Storage::makeDirectory("public/cover_images/".date('Y-m-d'));
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        return $fileNameToStore;
    }
}
