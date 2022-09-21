<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function loginForm()
    {
        return view('client.account.login');
    }

    public function  registerForm()
    {
        return view('client.account.register');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            if($request->checkbox == 'on'){
                Cookie::queue('email', $request->email, 44640);
                Cookie::queue('password', $request->password, 44640);
            }
            return redirect()->back();
        } else return redirect()->route('loginForm')->with('error', 'Incorrect information !');
    }
    public function postRegister(Request $request)
    {
        $new_user = new User();
        $check = $new_user->check_email_exist($request);
        if($check == true){
            return redirect()->route('registerForm')->with('error', 'Email already exists !');
        }else $new_user->add_new($request);
        return redirect()->route('loginForm')->with('success', 'Sign up success !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        // Tạo token mới
        $request->session()->regenerateToken();
        // Quay về màn login
        return redirect()->route('loginForm');
    }
}
