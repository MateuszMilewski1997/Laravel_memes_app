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
}
