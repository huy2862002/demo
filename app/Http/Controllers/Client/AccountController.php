<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function loginForm()
    {
        return view('client.account.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            return redirect()->route('home');
        } else return redirect()->route('loginForm')->with('error', 'Thông tin không chính xác !');
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
