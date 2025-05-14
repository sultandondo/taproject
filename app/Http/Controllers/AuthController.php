<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Login gagal. Cek kembali email dan password.',
        ]);
    }

    public function dashboard() {
        return view('home', ['title' => 'Home Page']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}