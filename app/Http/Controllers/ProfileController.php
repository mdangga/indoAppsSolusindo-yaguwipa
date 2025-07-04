<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profiles::first();

        return view('admin.generals', compact('profiles'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profiles::find($id);

        if (!$profile) {
            return redirect()->back()->with('gagal', 'Profil tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,svg,ico|max:2048',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'popup' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'company' => 'nullable|string',
            'website' => 'nullable|string',
            'telephone' => 'nullable|string',
            'fax' => 'nullable|string',
            'email' => 'nullable|string|email',
            'address' => 'nullable|string',
            'map' => 'nullable|string',
            'intro' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'copyright' => 'nullable|string',
            'tentang' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'makna_logo' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        foreach (['logo', 'favicon', 'background', 'popup'] as $file) {
            if ($request->hasFile($file)) {
                $oldFilePath = $profile->$file;
                if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
                $data[$file] = $request->file($file)->store('img', 'public');
            } else {
                $data[$file] = $profile->$file;
            }
        }

        $profile->update($data);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}
