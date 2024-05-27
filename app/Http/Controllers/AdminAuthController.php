<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = Auth::guard('admin')->attempt(['username' => $username, 'password' => $password]);

        if ($user) {
            return view('admin.dashboard');
        } else {
            return back()->withErrors([
                'message' => 'Username atau password yang Anda masukkan salah. Silakan coba lagi.'
            ]);
        }
    }
}
