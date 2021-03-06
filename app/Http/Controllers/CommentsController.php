<?php

namespace App\Http\Controllers;

Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
Use App\Http\Controllers\ValidationController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CommentsController extends Controller
{
    public function all_comments($id, request $request)
    {
        $meme = Meme::where('id', $id)->get();
        $comments = Comment::where('mem_id', $id)->orderBy('created_at','desc')->paginate(10);
        $count = $comments->count();
        if($count == 0)  return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'message' => "Add first comment!"]);

        if ($request->session()->has('add')) 
        {          
            $request->session()->forget('add');
            return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'create' => 1]);
        }

        return view('comments/comments',['memes' => $meme, 'comments' => $comments]);
    }
    public function add_comment($id, Request $request, ValidationController $validation)
    {        
        $validation->comment_validate($request);
        
        $comment = new Comment;
        $comment->mem_id = $id;
        $comment->user_id = auth()->user()->id; 
        $comment->content = $request->content;
        $comment->save();

        $meme = Meme::where('id', $id)->get();
        $comments = Comment::where('mem_id', $id)->orderBy('created_at','desc')->paginate(10);
        $count = $comments->count();
        if($count == 0)  return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'message' => "Add first comment!"]);

        $request->session()->put('add', 1);

        return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'back' => 1]);
    }
    public function delete_comment($id)
    {  
        $comment = Comment::where('id', $id)->get();
        $user = $comment[0]->user_id;
        $meme = $comment[0]->mem_id;

        if( auth()->user()->role != "admin" || auth()->user()->id != $user) return("Forbidden access!");

        $comment = Comment::where('id', $id)->delete();

        return $this->all_comments($meme);  
    }
    public function edit_comment($id, $comment)
    {
        $comm = Comment::find($id);
        
        if( auth()->user()->id != $comm->user_id ) return response("Forbidden access!");

        $comm->content = $comment;
        $comm->save();

        return response("ok");
    }
}
