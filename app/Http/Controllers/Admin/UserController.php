<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(12);

        return view('admin.users', compact('users'));
    }

    public function destroy($id){
        $user = User::find($id);

        if(!$user){
            return redirect()->back()->withError('User not found');
        }

        $user->delete();
        return redirect()->back()->withSuccess('User deleted successfully');
    }
}
