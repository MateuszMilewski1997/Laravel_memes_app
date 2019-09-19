<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
//use Illuminate\Support\Facades\DB;
Use App\Meme;
use DB;
Use App\Comment;
Use App\User;

class MemesController extends Controller
{
    public function memes()
    {
        $memes = Meme::orderBy('created_at','desc')->paginate(10);
        
        return view('memes/all_memes',['memes'=>$memes]);
    }
    public function my_memes()
    {
        $user_id = auth()->user()->id;
        $my_memes = Meme::where('user_id', 1)->paginate(10);
        $auth = "auth";

        return view('memes/all_memes',['memes'=>$my_memes, 'auth'=> $auth]);
    }
    public function delete_meme($id)
    {
        $meme = Meme::where('id', $id)->delete();
        $my_memes = Meme::where('user_id', 1)->paginate(10);
        $auth = "auth";

        return view('memes/all_memes',['memes'=>$my_memes, 'auth'=> $auth]);
    }
    public function create()
    {
        $post = new Meme;
        $post->title = "test";
        $post->photoPath = "photo.jpg";
        $post->user_id = auth()->user()->id;
        $post->likes = 0;
        $post->dislikes = 0;
        
        $post->save();
        return ("ok");
    }
}
