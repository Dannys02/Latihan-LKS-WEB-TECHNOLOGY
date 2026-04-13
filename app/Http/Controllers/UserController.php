<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // 'confirmed' cari input password_confirmation
        ]);

        // Simpan ke DB dengan password yang di-HASH
        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }

    public function showLogin()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Auth::attempt otomatis cek email & password yang sudah di-bcrypt/Hash::make
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Mencegah Session Fixation
            return redirect()->intended('/dashboard/user');
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // CSRF token baru untuk keamanan
        return redirect('/login');
    }
}
