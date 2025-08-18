<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\KerjaSama;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // menampilkan halaman dashboard user
    public function dashboard()
    {
        $user = Auth::user();
        $recentActivities = collect();

        $donasi = Donasi::with(['DonasiDana', 'DonasiBarang', 'DonasiJasa', 'Campaign'])
            ->where('id_user', $user->id_user)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        if ($user->role === 'mitra') {
            $mitra = $user->Mitra;

            if ($mitra) {
                // Ambil kerja sama
                $kerjaSama = KerjaSama::with('kategoriKerjaSama')
                    ->where('id_mitra', $mitra->id_mitra)
                    ->orderBy('updated_at', 'desc')
                    ->take(5)
                    ->get();

                // Gabungkan dan urutkan berdasarkan updated_at
                $recentActivities = $kerjaSama->concat($donasi)
                    ->sortByDesc('updated_at')
                    ->take(5)
                    ->values();
            }
        }
        if ($user->role === 'donatur') {
            $recentActivities = $donasi
                ->sortByDesc('updated_at')
                ->take(5)
                ->values();
        }

        return view('user.user', [
            'user' => $user,
            'recentActivities' => $recentActivities,
        ]);
    }

    public function showActivityAll(Request $request)
    {
        $status = $request->get('status');
        $user = Auth::user();
        $recentActivities = collect();

        if ($status) {
            $donasi = Donasi::with(['DonasiDana', 'DonasiBarang', 'DonasiJasa', 'Campaign'])
                ->where('id_user', $user->id_user)
                ->where('status', $status)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $donasi = Donasi::with(['DonasiDana', 'DonasiBarang', 'DonasiJasa', 'Campaign'])
                ->where('id_user', $user->id_user)
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        if ($user->role === 'mitra') {
            $mitra = $user->Mitra;

            if ($mitra) {
                $kerjaSama = KerjaSama::with('kategoriKerjaSama')
                    ->where('id_mitra', $mitra->id_mitra)
                    ->where(function ($query) use ($status) {
                        if ($status) {
                            $query->where('status', $status);
                        }
                    })
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $allActivities = $kerjaSama->concat($donasi)->sortByDesc('updated_at')->values();

                // Manual pagination
                $page = LengthAwarePaginator::resolveCurrentPage();
                $perPage = 10;
                $currentItems = $allActivities->slice(($page - 1) * $perPage, $perPage)->values();
                $recentActivities = new LengthAwarePaginator(
                    $currentItems,
                    $allActivities->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            }
        } elseif ($user->role === 'donatur') {
            $allActivities = $donasi->sortByDesc('updated_at')->values();
            $page = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;
            $currentItems = $allActivities->slice(($page - 1) * $perPage, $perPage)->values();
            $recentActivities = new LengthAwarePaginator(
                $currentItems,
                $allActivities->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        return view('user.activity', [
            'user' => $user,
            'recentActivities' => $recentActivities,
        ]);
    }


    // menampilkan form untuk mengisi data user
    public function showFormMitra(Request $request, $id)
    {
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized access.');
        }

        return view('formMitra');
    }


    // menampilkan halaman edit profile user
    public function showEditProfile()
    {
        return view('user.edit-profile', ['user' => Auth::user()]);
    }


    // menampilkan form join mitra
    public function showJoinMitra()
    {
        return view('user.formMitra');
    }


    // fungsi untuk menyimpan data user
    public function addDataMitra(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()->back()->with('gagal', 'User tidak ditemukan');
        }

        $rules = [
            'website' => 'nullable|url',
            'penanggung_jawab' => 'required|string|max:255',
            'jabatan_penanggung_jawab' => 'required|string|max:255',
        ];

        if (!$user->email) {
            $rules['email'] = 'required|email|unique:users,email';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!$user->email && $request->filled('email')) {
            $user->email = $request->email;
            $user->save();
        }

        Mitra::create([
            'id_user' => $id,
            'website' => $request->website,
            'penanggung_jawab' => $request->penanggung_jawab,
            'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
        ]);

        $user->update([
            'role' => 'mitra',
        ]);

        Auth::login($user->fresh());

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
    }


    // fungsi untuk memperbarui info akun
    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id_user . ',id_user',
            'no_tlp' => [
                'required',
                'string',
                'max:20',
                'regex:/^(?:\+62|62|0)[8][0-9]{7,11}$/'
            ],
            'alamat' => 'nullable|string',

            // Mitra only fields
            'website' => 'nullable|url',
            'penanggung_jawab' => $user->role === 'mitra' ? 'required|string|max:255' : 'nullable',
            'jabatan_penanggung_jawab' => $user->role === 'mitra' ? 'required|string|max:255' : 'nullable',
        ], [
            'no_tlp.regex' => 'Format nomor telepon tidak valid. Gunakan format +62 atau 08 diikuti dengan 7-11 digit angka.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_tlp = $request->no_tlp;
        $user->alamat = $request->alamat;
        $user->save();

        if ($user->role === 'mitra' && $user->Mitra) {
            $user->Mitra->update([
                'website' => $request->website,
                'penanggung_jawab' => $request->penanggung_jawab,
                'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
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

        if ($user->profile_path) {
            Storage::disk('public')->delete($user->profile_path);
        }

        $path = $request->file('profile_path')->store('profile_user', 'public');
        $user->profile_path = $path;
        $user->save();

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

            if ($user->role === 'mitra' && $user->Mitra) {
                $user->Mitra->delete();
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
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();

        // Verifikasi username sesuai
        if ($user->username !== $request->username) {
            return back()->withErrors(['username' => 'Username tidak sesuai']);
        }

        DB::beginTransaction();
        try {
            // Force delete relasi terlebih dahulu
            if ($user->role === 'mitra' && $user->Mitra) {
                $user->Mitra->forceDelete();
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
            }
        });

        return redirect('/login')->with('success', 'Akun berhasil dipulihkan. Silakan login kembali.');
    }


    /**
     * admin
     */
    // fungsi menampilan data user di halaman admin
    public function index()
    {
        return view('admin.showUser');
    }


    // fungsi untuk membuat datatable data user
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $users = User::with(['Mitra'])
            ->where('role', '!=', 'admin')
            ->select(['id_user', 'username', 'nama', 'role', 'deleted_at'])
            ->withTrashed();

        return DataTables::of($users)
            ->addColumn('nama', function ($row) {
                return $row->nama;
            })
            ->addColumn('status', function ($row) {
                return $row->trashed()
                    ? '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Nonaktif</span>'
                    : '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Aktif</span>';
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }


    // fungsi untuk menonaktifkan user di admin
    public function deactivateUser($id)
    {
        try {
            $user = User::findOrFail($id);

            DB::transaction(function () use ($user) {
                $user->delete();

                if ($user->role === 'mitra' && $user->Mitra) {
                    $user->Mitra->delete();
                }
            });

            return back()->with('success', 'Akun berhasil dinonaktifkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menonaktifkan akun: ' . $e->getMessage());
        }
    }


    // fungsi untuk mengaktifkan user diadmin
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
                }
            });

            return back()->with('success', 'Akun berhasil diaktifkan kembali');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengaktifkan akun: ' . $e->getMessage());
        }
    }
}
