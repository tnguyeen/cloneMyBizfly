<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class AuthController extends Controller
{



    public function getLogin()
    {
        if (Auth::check()) {
            // nếu đăng nhập thàng công thì 
            return view('home');
        } else {
            return view('auth.login');
        }
    }

    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($login)) {
            $request->session()->regenerate();
            // dd(Auth::check());
            return response()->json([
                'result' => true,
                'message' => 'Đăng nhập thành công',
            ]);
        } else{
            return response()->json([
                'result' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng',
            ]);
        }
                
    }

    public function logout(Request $request)
    {
        // dd(Auth::check());
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'result' => true,
            'message' => 'Đăng xuất thành công',
        ]);
    }

}
