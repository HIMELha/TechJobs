<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function verifyLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:50',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if(!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password] )){
            return redirect()->back()->withError('Invalid login info');
        }

        return redirect()->route('admin.index');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
