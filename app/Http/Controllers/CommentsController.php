<?php

namespace App\Http\Controllers;

Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CommentsController extends Controller
{
    public function all_comments($id)
    {
        $meme = Meme::where('id', $id)->get();
        $comments = Comment::where('mem_id', $id)->orderBy('created_at','desc')->paginate(10);
        $count = $comments->count();
        if($count == 0)  return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'message' => "Add first comment!"]);

        return view('comments/comments',['memes' => $meme, 'comments' => $comments]);
    }
    public function add_comment($id, Request $request)
    {
        $request->validate([
            'content' => 'required|max:200',
        ]);
        
        $comment = new Comment;
        $comment->mem_id = $id;
        $comment->user_id = auth()->user()->id; 
        $comment->content = $request->content;
        $comment->save();

        //return back();
        $meme = Meme::where('id', $id)->get();
        $comments = Comment::where('mem_id', $id)->orderBy('created_at','desc')->paginate(10);
        $count = $comments->count();
        if($count == 0)  return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'message' => "Add first comment!"]);

        return view('comments/comments',['memes' => $meme, 'comments' => $comments, 'back' => 1]);
    }
    public function delete_comment($id)
    {  
        $comment = Comment::where('id', $id)->get();
        $meme = $comment[0]->mem_id;
        $comment = Comment::where('id', $id)->delete();

        return $this->all_comments($meme);
    }
}
