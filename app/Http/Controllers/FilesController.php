<?php

namespace App\Http\Controllers;

use DB;
Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Validator,Redirect,Response,File;

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
