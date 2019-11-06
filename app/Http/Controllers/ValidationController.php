<?php

namespace App\Http\Controllers;

Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Validator,Redirect,Response,File;

class ValidationController extends Controller
{
    public function old_password_validate($request)
    {
        $request->validate([
            'oldPassword' =>  ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, auth()->user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'newPassword' => 'required|min:7',
            'repeatPassword' => 'required|same:newPassword',
        ]
        );
    }
    public function email_validate($request)
    {
        $request->validate([
            'oldEmail' => 'required|in:'.auth()->user()->email,
            'newEmail' => 'required|unique:users,email',
        ],
        [
            'oldEmail.in' => 'Email is not valid',
        ]
        );
    }
    public function comment_validate($request)
    {
        $request->validate([
            'content' => 'required|min:5|max:200',
        ]);
    }
    public function create_meme_validate($request)
    {
        $request->validate([
            'title' => 'required|max:50|min:5',
            'cover_image' => 'required',
        ]);
    }
    public function meme_title_validate($request)
    {
        $request->validate([
            'title' => 'required|max:50|min:5',
        ]);
    }
    public function meme_photo_validate($request)
    {
        $request->validate([
            'cover_image' => 'required',
        ]);
    }
}
