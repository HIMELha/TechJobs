<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        return view('client.profile');
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email|max:50|unique:users,email,'.auth()->user()->id.',id',
            'designation' => 'required|max:255',
            'mobile' => 'required|min:10|max:20'
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::find(auth()->user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->mobile = $request->mobile;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|max:50',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find(auth()->user()->id);

        
        if(!Hash::check($request->old_password, $user->password)){
            return redirect()->back()->with('error', 'Wrong old password');
        }

        $user->password = Hash::make($request->new_password);;
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function updateAvatar(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|max:1024|mimes:png,jpg,webp,jpeg'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->first()
            ]);
        }
        if($request->hasFile('image')){

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $newName = time() . auth()->user()->id . '.'.$ext;

            $image->move(public_path('uploads/avatars/'), $newName);

            $user = User::find(auth()->user()->id);
            $oldImage = public_path('uploads/avatars/' . $user->image);
            if($user->image != '' && file_exists($oldImage)){
                File::delete($oldImage);
            }

            $user->image = $newName;
            $user->save();

            return response()->json([
                'status' => true,
                'success' => 'Avatar successfully updated',
                'image' =>  $newName
            ]);
        }
    }

    public function appliedJobs(){
        $appliedJobs = JobApplication::with('job')->where(['user_id' => auth()->user()->id])->paginate(12);
        
        return view('client.my_applied_jobs', ['appliedJobs' => $appliedJobs]);
    }

    public function savedJobs(){
        $savedJobs = SavedJob::with('job')->where(['user_id' => auth()->user()->id])->paginate(12);
        
        return view('client.saved_jobs', ['savedJobs' => $savedJobs]);
    }

     
}
