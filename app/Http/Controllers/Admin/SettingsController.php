<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){
        $settings = Setting::first();
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

    public function updateSetting(Request $request){
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:25',
            'site_hero_title' => 'required|string|max:100',
            'site_hero_desc' => 'required|string|max:255',
        ]);

        // Find or create the settings record
        $settings = Setting::firstOrCreate([]);

        // Update the settings record with the validated data
        $settings->update($validatedData);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully');
    }
}
