<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\RecoveryMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('client.login');
    }

    public function verifyLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        if(Auth::attempt($validator->validated())){
                session()->flash('success', 'Login successful');
                return redirect()->route('profile.index');
        }else{
            return redirect()->back()->with('error', 'Invalid login info')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
    
    public function register(){
        return view('client.register');
    }

    public function storeRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:30',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|max:50',
            'confirm_password' => 'required|same:password'
        ]);

        if($validator->passes()){
            $user = User::create($validator->validated());

            Auth::login($user);
            session()->flash('success', 'Registration successful!');
            return redirect()->route('profile.index');
        }

        return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    public function forget(){
        
        return view('client.forget');
    }

    public function sentRecoveryMail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Email account not registered');
        }

        $randomHash = bin2hex(random_bytes(20));
        $user->remember_token = $randomHash;
        $user->save();

        $link = route('password.hash', $randomHash);
        
        try{
            Mail::to($user->email)->send(new RecoveryMail($link, $user->name));
        }catch(\Exception $err){
            return redirect()->back()->with('error', 'An error occured'.$err->getMessage());
        }

        return redirect()->back()->with('success', 'Password recovery email has been sent. Please check your email');
    }

    public function resetHash(Request $request, $hash){
        if($hash === ''){
            return redirect()->route('forget')->with('error', 'Invalid request. Please try again');
        }

        $user = User::where('remember_token', $hash)->first();

        if(!$user){
            return redirect()->route('forget')->with('error', 'Invalid request. Please try again');
        }

        return view('client.reset_password', ['hash' => $hash]);
    }

    public function resetPassword(Request $request, $hash){
        $user = User::where('remember_token', $hash)->first();

        if(!$user){
            return redirect()->route('forget')->with('error', 'Invalid request. Please try again');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|max:50',
            'confirm_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->remember_token = '';
        $user->save();

        return redirect()->route('login')->with('success', 'Password reset successful');
    }


}
