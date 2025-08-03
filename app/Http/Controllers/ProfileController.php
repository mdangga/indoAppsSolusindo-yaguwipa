<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    // fungsi untuk menampilkan halaman profile website di admin
    public function index()
    {
        $profiles = Profiles::first();

        return view('admin.generals', compact('profiles'));
    }

    
    // fungsi untuk memperbarui profile website
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
            if ($file === 'popup' && $request->input('delete_popup') == '1') {
                if ($profile->$file && Storage::disk('public')->exists($profile->$file)) {
                    Storage::disk('public')->delete($profile->$file);
                }
                $data[$file] = null;
                continue;
            }

            if ($request->hasFile($file)) {
                if ($profile->$file && Storage::disk('public')->exists($profile->$file)) {
                    Storage::disk('public')->delete($profile->$file);
                }

                $uploadedFile = $request->file($file);
                $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName = Str::slug($originalName);
                $extension = 'webp';
                $filename = "img/{$file}_{$safeName}_" . uniqid() . ".{$extension}";

                if (in_array($file, ['popup', 'background'])) {
                    $webp = Image::read($uploadedFile)->toWebp(80);
                    Storage::disk('public')->put($filename, $webp);
                } else {
                    $filename = $uploadedFile->storeAs('img', "{$file}_{$safeName}_" . uniqid() . '.' . $uploadedFile->getClientOriginalExtension(), 'public');
                }

                $data[$file] = $filename;
            } else {
                $data[$file] = $profile->$file;
            }
        }



        $profile->update($data);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}
