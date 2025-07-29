<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Psy\TabCompletion\Matcher\FunctionsMatcher;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // menampilkan halaman dashboard user
    public function dashboard()
    {
        return view('user.user', ['user' => Auth::user()]);
    }


    // menampilkan form untuk mengisi data user
    public function showFormUser(Request $request, $id)
    {
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        return view('formMitraDonatur', compact('user'));
    }


    // menampilkan edit profile user
    public function showEditProfile()
    {
        return view('user.edit-profile', ['user' => Auth::user()]);
    }


    // fungsi untuk menyimpan data user
    public function addDataUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Common
            'id_user' => 'required|numeric|exists:users,id_user',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:donatur,email|unique:mitra,email',
            'no_tlp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'profile_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|string|in:mitra,donatur',

            // Mitra only
            'website' => 'nullable|url',
            'penanggung_jawab' => 'required_if:role,mitra|nullable|string|max:255',
            'jabatan_penanggung_jawab' => 'required_if:role,mitra|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->id_user);
        $user->update([
            'role' => $request->role,
        ]);

        // Simpan file profil jika ada
        $profilePath = null;
        if ($request->hasFile('profile_path')) {
            $profilePath = $request->file('profile_path')->store('profile_user', 'public');
        }

        // Simpan data tambahan sesuai role
        if ($request->role === 'mitra') {
            Mitra::create([
                'id_user' => $request->id_user,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_tlp' => $request->no_tlp,
                'email' => $request->email,
                'website' => $request->website,
                'profile_path' => $profilePath,
                'penanggung_jawab' => $request->penanggung_jawab,
                'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            ]);
        } elseif ($request->role === 'donatur') {
            Donatur::create([
                'id_user' => $request->id_user,
                'nama' => $request->nama,
                'no_tlp' => $request->no_tlp,
                'email' => $request->email,
                'profile_path' => $profilePath,
                'alamat' => $request->alamat,
            ]);
        }

        $user->refresh();
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
    }

    /*
    ============
    Profile User
    ============
    */

    // fungsi untuk memperbarui info akun
    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:donatur,email,' . ($user->UserToDonatur ? $user->UserToDonatur->id_donatur : 'NULL') . ',id_donatur|unique:mitra,email,' . ($user->UserToMitra ? $user->UserToMitra->id_mitra : 'NULL') . ',id_mitra',
            'no_tlp' => 'required|string|max:20',
            'alamat' => 'nullable|string',

            // Mitra only fields
            'website' => 'nullable|url',
            'penanggung_jawab' => $user->role === 'mitra' ? 'required|string|max:255' : 'nullable',
            'jabatan_penanggung_jawab' => $user->role === 'mitra' ? 'required|string|max:255' : 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->username = $request->username;
        $user->save();

        if ($user->role === 'mitra' && $user->UserToMitra) {
            $user->UserToMitra->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'website' => $request->website,
                'penanggung_jawab' => $request->penanggung_jawab,
                'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            ]);
        } elseif ($user->role === 'donatur' && $user->UserToDonatur) {
            $user->UserToDonatur->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }


    // fungsi untuk memperbarui photo 
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_path' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->role === 'mitra' && $user->UserToMitra) {
            $model = $user->UserToMitra;
        } elseif ($user->role === 'donatur' && $user->UserToDonatur) {
            $model = $user->UserToDonatur;
        } else {
            return back()->with('error', 'Profil tidak ditemukan.');
        }

        if ($model->profile_path) {
            Storage::disk('public')->delete($model->profile_path);
        }

        $path = $request->file('profile_path')->store('profile_user', 'public');
        $model->profile_path = $path;
        $model->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }


    // fungsi untuk memperbarui password
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }


    // fungsi untuk menonaktifkan akun 
    public function deactivate(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'current_password'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            if ($user->role === 'mitra' && $user->UserToMitra) {
                $user->UserToMitra->delete();
            } elseif ($user->role === 'donatur' && $user->UserToDonatur) {
                $user->UserToDonatur->delete();
            }

            // Soft delete user
            $user->delete();

            DB::commit();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Akun Anda telah dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus akun: ' . $e->getMessage());
        }
    }

    public function forceDelete(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|current_password', // Verifikasi password saat ini
        ]);

        $user = Auth::user();

        // Verifikasi username sesuai
        if ($user->username !== $request->username) {
            return back()->withErrors(['username' => 'Username tidak sesuai']);
        }

        DB::beginTransaction();
        try {
            // Force delete relasi terlebih dahulu
            if ($user->role === 'mitra' && $user->UserToMitra) {
                $user->UserToMitra->forceDelete();
            } elseif ($user->role === 'donatur' && $user->UserToDonatur) {
                $user->UserToDonatur->forceDelete();
            }

            // Force delete user
            $user->forceDelete();

            DB::commit();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('warning', 'Akun telah dihapus permanen');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['force_delete' => 'Gagal menghapus permanen: ' . $e->getMessage()]);
        }
    }

    // fungsi untuk mengaktifkan akun
    public function restore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required',
        ]);

        $user = User::onlyTrashed()
            ->where('username', $request->username)
            ->first();

        if (!$user) {
            return back()->with('error', 'Akun tidak ditemukan atau tidak dapat dipulihkan');
        }

        // Verifikasi password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        // Restore user dan relasinya
        DB::transaction(function () use ($user) {
            $user->restore();

            if ($user->role === 'mitra') {
                Mitra::onlyTrashed()->where('id_user', $user->id_user)->restore();
            } elseif ($user->role === 'donatur') {
                Donatur::onlyTrashed()->where('id_user', $user->id_user)->restore();
            }
        });

        return redirect('/login')->with('success', 'Akun berhasil dipulihkan. Silakan login kembali.');
    }


    // admin
    public function index(){
        return view('admin.showUser');
    }

    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $users = User::with(['UserToDonatur', 'UserToMitra'])
            ->select(['id_user', 'username', 'role', 'deleted_at'])
            ->withTrashed(); // Include soft deleted users

        return DataTables::of($users)
            ->addColumn('nama', function ($row) {
                // Ambil nama dari relasi sesuai role
                if ($row->role === 'mitra' && $row->UserToMitra) {
                    return $row->UserToMitra->nama;
                } elseif ($row->role === 'donatur' && $row->UserToDonatur) {
                    return $row->UserToDonatur->nama;
                }
                return '-';
            })
            ->addColumn('status', function ($row) {
                return $row->trashed()
                    ? '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Nonaktif</span>'
                    : '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Aktif</span>';
            })
            ->addColumn('aksi', function ($row) {
                if ($row->trashed()) {
                    // Tombol restore untuk user yang nonaktif
                    return '
                <div class="flex items-center">
                    <button class="cursor-pointer restoreBtn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm" 
                            data-id="' . e($row->id_user) . '">
                        <i class="fas fa-undo mr-1"></i> Aktifkan
                    </button>
                    <button class="cursor-pointer forceDeleteBtn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm ml-2" 
                            data-id="' . e($row->id_user) . '">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus Permanen
                    </button>
                </div>';
                } else {
                    // Tombol deactivate untuk user aktif
                    return '
                <div class="flex items-center">
                    <button class="cursor-pointer editBtn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" 
                            data-id="' . e($row->id_user) . '">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button class="cursor-pointer deactivateBtn bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm ml-2" 
                            data-id="' . e($row->id_user) . '">
                        <i class="fas fa-ban mr-1"></i> Nonaktifkan
                    </button>
                </div>';
                }
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }

    public function deactivateUser($id)
    {
        try {
            $user = User::findOrFail($id);

            DB::transaction(function () use ($user) {
                $user->delete();

                if ($user->role === 'mitra' && $user->UserToMitra) {
                    $user->UserToMitra->delete();
                } elseif ($user->role === 'donatur' && $user->UserToDonatur) {
                    $user->UserToDonatur->delete();
                }
            });

            return back()->with('success', 'Akun berhasil dinonaktifkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menonaktifkan akun: ' . $e->getMessage());
        }
    }

    public function restoreUser($id)
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);

            DB::transaction(function () use ($user) {
                $user->restore();

                if ($user->role === 'mitra') {
                    Mitra::onlyTrashed()
                        ->where('id_user', $user->id_user)
                        ->restore();
                } elseif ($user->role === 'donatur') {
                    Donatur::onlyTrashed()
                        ->where('id_user', $user->id_user)
                        ->restore();
                }
            });

            return back()->with('success', 'Akun berhasil diaktifkan kembali');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengaktifkan akun: ' . $e->getMessage());
        }
    }
}
