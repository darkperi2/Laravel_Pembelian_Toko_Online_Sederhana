<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan form login 
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login (cek di tabel admin lalu users)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // cek admin
        $admin = Admin::where('email', $email)->first();
        if ($admin && $admin->password === $password) {
            session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
            return redirect('/admin')->with('success', 'Login admin berhasil.');
        }

        // cek user
        $user = User::where('email', $email)->first();
        if ($user && $user->password === $password) {
            session(['user_id' => $user->id, 'user_name' => $user->name]);
            return redirect('/user')->with('success', 'Login user berhasil.');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // Logout sederhana (hapus session keys)
    public function logout()
    {
        session()->forget(['admin_id', 'admin_name', 'user_id', 'user_name']);
        session()->flush();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
