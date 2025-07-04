<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class AuthController extends Controller
{
    public function showLogin() {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('login');
    }


    public function register(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:1',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->intended(url()->previous() ?? '/'); // Kembali ke halaman sebelumnya
    }

    public function login(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke halaman sebelumnya atau fallback
            return redirect()->intended(url()->previous() ?? '/');
        }

        // Jika gagal login, kembalikan dengan pesan error
        return back()->withErrors([
            'auth' => 'Email atau password salah.',
        ])->withInput();
    }

    public function dashboard() {
        return view('home', ['title' => 'Home Page']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(url()->previous() ?? '/');
    }
}