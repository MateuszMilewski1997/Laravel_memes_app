<?php

namespace App\Http\Controllers;

use DB;
Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Validator,Redirect,Response,File;
use App\Http\Controllers\Controller;

class MemesController extends Controller
{
    public function memes()
    {
        $memes = Meme::where('waiting_room', 0)->orderBy('created_at','desc')->paginate(5);
        
        return view('memes/all_memes',['memes'=>$memes]);
    }
    public function waiting_room()
    {
        $memes = Meme::where('waiting_room', 1)->orderBy('created_at','desc')->paginate(10);
        
        return view('memes/all_memes',['memes'=>$memes]);
    }
    public function my_memes()
    {
        $user_id = auth()->user()->id;
        $my_memes = Meme::where('user_id', $user_id)->paginate(10);
        $auth = "auth";

        return view('memes/all_memes',['memes'=>$my_memes, 'auth'=> $auth]);
    }
    public function delete_meme($id)
    {
        $photo = Meme::select('photoPath')->where('id', $id)->get();
        $meme = Meme::where('id', $id)->delete();
        $this->delete_file($photo);

        return $this->my_memes();
    }
    public function create_form()
    {
        return view('memes/add_meme');
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'cover_image' => 'required',
        ]);
        
        //$path = $request->file('cover_image')->store('photos'); php artisan storage:link
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore= date('Y-m-d')."/".$filename.'_'.time().'.'.$extension;
        Storage::makeDirectory("public/cover_images/".date('Y-m-d'));
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        $post = new Meme;
        $post->title = $request->title;
        $post->photoPath = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->likes = 0;
        $post->dislikes = 0;
        $post->waiting_room = 1;  
        $post->save();

        return $this->my_memes();
    }
    public function like($meme, Request $request)
    {        
        $id = $meme;
        $meme = Meme::find($meme);
        $count = $meme->likes;
        $count++;
        $meme->likes = $count;
        $meme->save();
        
        //$request->session()->put('thumbs', [
        //    'id' => $id
        //]);

        //dd(request()->session()->get('thumbs'));

        return ("ok");
    }
    public function dislike($meme)
    {
        $meme = Meme::find($meme);
        $count = $meme->dislikes;
        $count++;
        $meme->dislikes = $count;
        $meme->save();

        return ("ok");
    }
    public function del_waiting_room($meme)
    {
        $meme = Meme::find($meme);
        $meme->waiting_room = 0;
        $meme->save();
        
        return $this->waiting_room();
    }
    public function delete_file($photo)
    {
        $path = "storage/cover_images/".$photo[0]->photoPath;
        File::delete($path);

    }
}
