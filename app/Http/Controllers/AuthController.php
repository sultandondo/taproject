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
            
            if ($request->filled('data_id')) {
            $dataId = $request->input('data_id');

            // Update user_id di data tersebut
            $data = \App\Models\Data::find($dataId);

            if ($data) {
                $data->user_id = Auth::id();
                $data->save();
            }
        }
            // Redirect ke halaman sebelumnya atau fallback
            return redirect()->route('history');;
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

        return view('home');
    }
}