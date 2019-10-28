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
    public function my_account(Request $request)
    {
        if ($request->session()->has('message')) 
        {          
            $message = $request->session()->get('message');
            $request->session()->forget('message');
            return view('account/account',['message' => $message]);
        }
        
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

        $request->session()->put('message', 'Email has been changed!');

        return $this->my_account($request);
    }
    public function change_password(Request $request)
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

        $id = auth()->user()->id;
        $user = User::find($id);
        $user->password = bcrypt($request->newPassword);
        $user->save();
        
        $request->session()->put('message', 'Password has been changed!');

        return $this->my_account($request);
    }
    

}