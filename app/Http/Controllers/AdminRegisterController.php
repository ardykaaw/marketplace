<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
