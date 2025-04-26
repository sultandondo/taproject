<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke dashboard atau halaman lain setelah login berhasil
            return redirect()->intended('/dashboard');
        }

        // Jika login gagal
        return back()->with('error', 'Email atau password salah');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
