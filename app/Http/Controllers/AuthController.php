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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'nullable|email|unique:users',
            'nama' => 'required|string|max:100',
            'no_tlp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $profilePath = null;
        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('profiles', 'public');
        }

        // Membuat user dengan semua field
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

    // login
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

        // Cek apakah user ada (termasuk yang terhapus)
        $user = User::withTrashed()->where('username', $credentials['username'])->first();

        // Jika user ditemukan tapi status nonaktif
        if ($user && $user->trashed()) {
            return back()->withErrors([
                'username' => 'Akun ini dinonaktifkan. Silakan pulihkan akun untuk login.',
            ])->withInput();
        }

        // Jika user tidak ditemukan atau password salah
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput();
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === null) {
            return redirect()->route('register.dataUser', ['id' => $user->id_user]);
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.berita');
        }

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
