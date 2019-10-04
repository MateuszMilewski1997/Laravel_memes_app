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
        $comments = Comment::where('mem_id', $id)->paginate(10);

        return view('comments/comments',['memes' => $meme, 'comments' => $comments]);
    }
}