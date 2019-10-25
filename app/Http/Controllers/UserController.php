<?php

namespace App\Http\Controllers;

Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Validator,Redirect,Response,File;

class UserController extends Controller
{
    public function my_account()
    {
        return view('account/account');
    }
    public function change_email(Request $request)
    {
        $request->validate([
            'oldEmail' => 'required|in:'.auth()->user()->email,
            'newEmail' => 'required|unique:users,email',
        ],
        [
            'oldEmail.in' => 'Email is not valid',
        ]
        );
        
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->email = $request->newEmail;
        $user->save();

        return $this->my_account();
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:7',
            'repeatPassword' => 'required|same:newPassword',
        ]
        );

        $id = auth()->user()->id;
        $user = User::find($id);
        $user->password = bcrypt($request->newPassword);
        $user->save();
        
        return $this->my_account();
    }
    

}