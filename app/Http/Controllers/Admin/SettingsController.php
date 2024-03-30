<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){
        $settings = '';
        return view('admin.settings', compact('settings'));
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return redirect()->back()->withError($validator->errors()->first());
        }

        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $admin->password = $request->password;
        $admin->save();

        return redirect()->back()->withSuccess('Password changed successfully');
    }
}
