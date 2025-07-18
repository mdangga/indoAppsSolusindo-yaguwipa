<?php

namespace App\Http\Controllers;

use App\Models\Institusi;
use App\Models\KategoriProgram;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function create()
    {
        $program = KategoriProgram::all();
        $institusiList = Institusi::all();
        return view('testing', compact('institusiList', 'program'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'id_kategori_program' => 'nullable|exists:kategori_program,id_kategori_program',

            'institusi' => 'array',
            'institusi.*.id' => 'nullable|exists:institusi_terlibat,id_institusi',
            'institusi.*.nama' => 'required_without:institusi.*.id|string|nullable',
            'institusi.*.tanggal_mulai' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $data = $request->only(['nama', 'deskripsi', 'status', 'id_kategori_program']);

            // Konversi dan simpan file sebagai .webp
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $filename = 'img/program/' . uniqid() . '.webp';

                $img = Image::read($image)
                    ->toWebp(80);
                Storage::disk('public')->put($filename, $img);
                $data['image_path'] = $filename;
            }

            $program = Program::create($data);

            if ($request->has('institusi')) {
                foreach ($request->institusi as $item) {
                    if (!empty($item['id'])) {
                        $program->institusiTerlibat()->attach($item['id'], [
                            'tanggal' => $item['tanggal_mulai']
                        ]);
                    } elseif (!empty($item['nama'])) {
                        $new = Institusi::create([
                            'nama' => $item['nama'],
                            'alamat' => $item['alamat'] ?? null,
                            'website' => $item['website'] ?? null,
                        ]);

                        $program->institusiTerlibat()->attach($new->id_institusi, [
                            'tanggal' => $item['tanggal_mulai']
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.berita')->with('success', 'Program berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'id_kategori_program' => 'nullable|exists:kategori_program,id_kategori_program',

            'institusi' => 'array',
            'institusi.*.id' => 'nullable|exists:institusi_terlibat,id_institusi',
            'institusi.*.nama' => 'required_without:institusi.*.id|string|nullable',
            'institusi.*.tanggal_mulai' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $id) {
            $program = Program::findOrFail($id);

            $data = $request->only(['nama', 'deskripsi', 'status', 'id_kategori_program']);

            // Update gambar jika ada
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $filename = 'img/program/' . uniqid() . '.webp';

                $img = Image::read($image)->toWebp(80);
                Storage::disk('public')->put($filename, $img);
                $data['image_path'] = $filename;
            }

            $program->update($data);

            // Simpan ID institusi yang dikirim dari form
            $inputInstitusiIds = [];

            if ($request->has('institusi')) {
                foreach ($request->institusi as $item) {
                    if (!empty($item['id'])) {
                        $inputInstitusiIds[] = $item['id'];
                        $program->institusiTerlibat()->syncWithoutDetaching([
                            $item['id'] => ['tanggal' => $item['tanggal_mulai']]
                        ]);
                    } elseif (!empty($item['nama'])) {
                        $new = Institusi::create([
                            'nama' => $item['nama'],
                            'alamat' => $item['alamat'] ?? null,
                            'website' => $item['website'] ?? null,
                        ]);

                        $inputInstitusiIds[] = $new->id_institusi;
                        $program->institusiTerlibat()->attach($new->id_institusi, [
                            'tanggal' => $item['tanggal_mulai']
                        ]);
                    }
                }
            }

            // Ambil ID institusi yang sudah terhubung di pivot
            $existingInstitusiIds = $program->institusiTerlibat()->pluck('institusi_terlibat.id_institusi')->toArray();

            // Cari relasi yang dihapus (tidak dikirim lagi)
            $deletedPivotIds = array_diff($existingInstitusiIds, $inputInstitusiIds);

            if (!empty($deletedPivotIds)) {
                // Hapus hanya dari pivot table (bukan dari institusi_terlibat)
                $program->institusiTerlibat()->detach($deletedPivotIds);
            }
        });

        return redirect()->route('admin.berita')->with('success', 'Program berhasil diperbarui.');
    }
}
