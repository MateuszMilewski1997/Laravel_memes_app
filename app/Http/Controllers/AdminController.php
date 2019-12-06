<?php

namespace App\Http\Controllers;

Use App\Models\Meme;
Use App\Models\Comment;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function all_users()
    {
        $users = User::paginate(5);
        return view('admin/adminPanel',['users' => $users]);
    }
    public function delete_user($id)
    {
        $user = User::where('id', $id)->Delete();
        $users = User::all();

        return view('admin/adminPanel',['users' => $users, 'message' => 'User hes been delete!']);
    }
    public function change_role($id, $role)
    {   
        $user = User::find($id);
        $user->role = $role;
        $user->save();

        $users = User::paginate(5);
        return view('admin/adminPanel',['users' => $users, 'message' => 'Role has been changed!']);
    }

}