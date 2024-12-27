<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function viewRegister (){
        return view('register');
    }

    function logout (){
        Auth::logout();
        return redirect()->to('/login');
    }

    function saveRegister(Request $request){
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|max:50|min:10',
            ]);

            if(!$validated){
                return redirect()->back();
            }

            $user = new User();
            $user->name = "";
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));

            if($user->save()){
                $status = "success";
                $message = "Register Success";
            }

            return redirect()->to('/register')->with($status, $message);
        } catch (\Throwable $e) {
            return redirect()->back()->with("failed", "Register failed because ".$e->getMessage());
        }
    }

    function processLogin (Request $request) {
        try {
            $data = $request->only('email', 'password');

            if (Auth::attempt($data)){
                $request->session()->regenerate();
                return redirect()->to('/home');
            }else{
                return redirect()->back()->with("failed", "Login failed");
            }
        } catch (\Throwable $e) {
            return redirect()->back()->with("failed", "Register failed because ".$e->getMessage());
        }
    }
}

