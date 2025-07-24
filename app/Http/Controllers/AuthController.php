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

    // register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('register.dataUser', ['id' => $user->id_user]);
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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === null) {
                return redirect()->route('register.dataUser', ['id' => $user->id_user]);
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }


    // data user
    public function showFormUser(Request $request, $id)
    {
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        return view('formMitraDonatur', compact('user'));
    }

    public function addDataUser(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // Common
            'id_user' => 'required|numeric|exists:users,id_user',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:donatur,email|unique:mitra,email',
            'no_tlp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'role' => 'required|string|in:mitra,donatur',

            // Mitra only
            'website'                 => 'required_if:role,mitra|nullable|url',
            'penanggung_jawab'       => 'required_if:role,mitra|nullable|string|max:255',
            'jabatan_penanggung_jawab' => 'required_if:role,mitra|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find($request->id_user);
        $user->update([
            'role' => $request->role,
        ]);
        // Simpan data tambahan
        if ($request->role === 'mitra') {
            Mitra::create([
                'id_user'                 => $request->id_user,
                'nama'                    => $request->nama,
                'email'                   => $request->email,
                'no_tlp'                  => $request->no_tlp,
                'alamat'                  => $request->alamat,
                'website'                 => $request->website,
                'penanggung_jawab'        => $request->penanggung_jawab,
                'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            ]);
        } else {
            Donatur::create([
                'id_user' => $request->id_user,
                'nama'    => $request->nama,
                'email'   => $request->email,
                'no_tlp'  => $request->no_tlp,
                'alamat'  => $request->alamat,
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil.');
    }

    public function me()
    {
        return view('admin.showBerita', ['user' => Auth::user()]);
    }
}
