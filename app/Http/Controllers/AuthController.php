<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aktivitas' => 'Login',
                'keterangan' => 'User ' . Auth::user()->nama_lengkap . ' berhasil login.',
            ]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_user,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,petugas,owner',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        LogAktivitas::create([
            'user_id' => $user->id,
            'aktivitas' => 'Register',
            'keterangan' => 'User ' . $user->nama_lengkap . ' mendaftar sebagai ' . $user->role . '.',
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Logout',
            'keterangan' => 'User ' . Auth::user()->nama_lengkap . ' telah logout.',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

