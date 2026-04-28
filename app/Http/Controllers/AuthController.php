<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
            return redirect()->route('DashboardAdmin');
            }

             if (Auth::user()->role_id == 2) {
            return redirect()->route('DashboardPetugas');
            }

            if (Auth::user()->role_id == 3) {
            return redirect()->route('katalog');
            }
        }


        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function register(Request $request)
    {
        // Coba aktifkan baris di bawah ini untuk tes:
        // dd($request->all());

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|unique:users|max:25',
            'password' => 'required|min:6',
            'telp' => 'required|numeric',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
            'role_id' => 3, // Pastikan di tabel 'roles' id 3 adalah masyarakat
        ]);

        if($user) {
            return redirect()->route('login')->with('success', 'Berhasil!');
        }

        return back()->with('error', 'Gagal mendaftar.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Ubah dari redirect('/login') menjadi redirect ke route landing
        return redirect()->route('landing')->with('success', 'Anda telah berhasil keluar.');
    }
}
