<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $data=$request->validated();
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->route('showPost');
        }
        return back()->withErrors(['email_or_password' => 'メールアドレスまたはパスワードが違います'])->withInput();
        }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        $data=$request->validated();
        try{
            $user=User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            Auth::login($user);
            return redirect()->route('showPost');
        }catch(Exception $e){
            return redirect()->route('registerFail');
        }    
    }
    public function registerFail(){
        return view('registerFail');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
