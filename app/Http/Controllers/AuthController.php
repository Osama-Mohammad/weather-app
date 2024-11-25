<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('verify.Register');
    }

    public function register()
    {
        $validated = request()->validate([
            'name' => 'required|min:1|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role'=>'user',
        ]);

        Auth::login($user);
        return view('user.show',compact('user'));
    }

    public function logPage(){
        return view('verify.Login');
    }

    public function login(){
        $validated = request()->validate([
            'password' => 'required|min:1',
            'email' => 'required|email',
        ]);
        if(Auth::attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('registerPage');
        }else{
            dd('couldst log in');
        }

    }

    public function logout(){
    Auth::logout();
    return redirect()->route('logPage');
    }
}
