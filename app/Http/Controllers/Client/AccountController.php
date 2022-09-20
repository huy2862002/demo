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
        } else return redirect()->route('loginForm')->with('error', 'Thông tin không chính xác !');
    }
    public function postRegister(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->role = 1;
        $user->status = 1;
        $user->created_at = strtotime(date('Y-m-d H:i:s'));
        $user->updated_at = strtotime(date('Y-m-d H:i:s'));
        $user->save();
        return redirect()->route('loginForm')->with('success', 'Đăng Ký Thành Công !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // Huỷ toàn bộ session đi
        $request->session()->invalidate();
        // Tạo token mới
        $request->session()->regenerateToken();
        // Quay về màn login
        return redirect()->route('loginForm');
    }
}
