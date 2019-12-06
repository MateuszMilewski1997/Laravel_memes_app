<?php

namespace App\Http\Controllers;

use DB;
Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
Use App\Http\Controllers\FilesController;
use App\Http\Controllers\Controller;
Use App\Http\Controllers\ValidationController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Validator,Redirect,Response,File;

class MemesController extends Controller
{
    public function memes()
    {
        $memes = Meme::where('waiting_room', 0)->orderBy('created_at','desc')->paginate(5);
        
        return view('memes/all_memes',['memes'=>$memes]);
    }
    public function waiting_room()
    {
        $memes = Meme::where('waiting_room', 1)->orderBy('created_at','desc')->paginate(5);
        
        return view('memes/all_memes',['memes'=>$memes, 'waiting_room' => 1]);
    }
    public function my_memes(Request $request)
    {
        $user_id = auth()->user()->id;
        $my_memes = Meme::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(10);
        $auth = "auth";

        if ($request->session()->has('message')) 
        {          
            $request->session()->forget('message');
            return view('memes/all_memes',['memes'=>$my_memes, 'auth'=> $auth, 'message' => 1]);
        }
        return view('memes/all_memes',['memes'=>$my_memes, 'auth'=> $auth]);
    }
    public function delete_meme($id)
    {   
        $meme = Meme::find($id);
        if( auth()->user()->role != "admin" && auth()->user()->id != $meme->user_id) return("Forbidden access!");

        $photo = Meme::select('photoPath')->where('id', $id)->get();
        $meme = Meme::where('id', $id)->delete();
        $filescontroller->delete_file($photo);
       
        return $this->my_memes();     
    }
    public function create_form()
    {
        return view('memes/add_meme');
    }
    public function create(Request $request, FilesController $filescontroller, ValidationController $validation)
    {
        $validation->create_meme_validate($request);
        $fileNameToStore = $filescontroller->upload_file($request);

        $post = new Meme;
        $post->title = $request->title;
        $post->photoPath = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->likes = 0;
        $post->dislikes = 0;
        $post->waiting_room = 1;  
        $post->save();
        $request->session()->put('message', 'Mem has been created!');

        return $this->my_memes($request);
    }
    public function like($meme)
    {         
        $meme = Meme::find($meme);
        $count = $meme->likes;
        $count++;
        $meme->likes = $count;
        $meme->save();
        
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
    public function edit_meme($id)
    {
        $meme = Meme::find($id);
        if( auth()->user()->id != $meme->user_id) return("Forbidden access!");
        
        $meme = Meme::find($id);

        return view('memes/edit_meme',['meme'=>$meme]);
    }
    public function edit_title($id,Request $request, ValidationController $validation)
    {
        $meme = Meme::find($id);
        if( auth()->user()->id != $meme->user_id) return("Forbidden access!");
        
        $validation->meme_title_validate($request);
        
        $meme = Meme::find($id);
        $meme->title = $request->title;
        $meme->save();

        return view('memes/edit_meme',['meme'=>$meme, 'message' => "Title has been changed!"]);
    }
    public function edit_photo($id, Request $request, FilesController $filescontroller, ValidationController $validation)
    {
        $meme = Meme::find($id);
        if( auth()->user()->id != $meme->user_id) return("Forbidden access!");
        
        $validation->meme_photo_validate($request);
        
        $meme = Meme::find($id);
        $oldPhoto = $meme->photoPath;         
        $photo = Meme::select('photoPath')->where('id', $id)->get();
        
        $filescontroller->delete_file($photo);
        $fileNameToStore = $filescontroller->upload_file($request);

        $meme->photoPath = $fileNameToStore;
        $meme->save();

        return view('memes/edit_meme',['meme'=>$meme, 'message' => "Photo has been changed!"]);
    }
}
