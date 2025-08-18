<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // form register
    public function showRegisterForm()
    {
        return view('signup');
    }


    // fungsi untuk daftar user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'nullable|email|unique:users',
            'nama' => 'required|string|max:100',
            'no_tlp' => [
                'required',
                'string',
                'max:20',
                'regex:/^(?:\+62|62|0)[8][0-9]{7,11}$/'
            ],
            'alamat' => 'required|string',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'no_tlp.regex' => 'Format nomor telepon tidak valid. Gunakan format +62 atau 08 diikuti dengan 7-11 digit angka.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $profilePath = null;
        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('profiles', 'public');
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nama' => $request->nama,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
            'profile_path' => $profilePath,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    
    // form login
    public function showLoginForm()
    {
        return view('signin');
    }


    // fungsi login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $validator = Validator::make($credentials, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::withTrashed()->where('username', $credentials['username'])->first();

        if ($user && $user->trashed()) {
            return back()->withErrors([
                'username' => 'Akun ini dinonaktifkan. Silakan pulihkan akun untuk login.',
            ])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput();
        }

        $request->session()->regenerate();
        $user = Auth::user();


        if ($user->role === 'admin') {
            return redirect()->route('admin.kerjaSama');
        }

        return redirect()->route('dashboard');
    }


    // fungsi Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
