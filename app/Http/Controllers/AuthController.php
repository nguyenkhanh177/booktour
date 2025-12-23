<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // form login
    public function showLogin()
    {
        return view('clients.auth.login');
    }

    public function showRegister()
    {
        return view('clients.auth.register');
    }
    public function Register(Request $request)
    {
        $user = User::create([
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
            'name' => $request->get('name'),
        ]);

        return redirect('/login');
    }

    // xử lý login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // phân quyền
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'taikhoan' => 'tài khoản hoặc mật khẩu sai',
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
