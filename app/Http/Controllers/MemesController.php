<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
Use App\Meme;

class MemesController extends Controller
{
    public function memes()
    {
        $memes = Meme::Paginate(15);;
        return view('memes/all_memes',['memes'=>$memes]);
    }
}
