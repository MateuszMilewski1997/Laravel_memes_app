<?php

namespace App\Http\Controllers;

Use App\Meme;
Use App\Comment;
Use App\User;
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
        $comment = new Comment;
        $comment->mem_id = $id; 
        $comment->content = $request->content;
        $comment->save();

        return $this->all_comments($id);
    }
}
