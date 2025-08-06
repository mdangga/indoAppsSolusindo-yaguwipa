<?php

namespace App\Http\Controllers;

use App\Models\Institusi;
use App\Models\KategoriProgram;
use App\Models\Program;
use App\Models\Berita;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    // fungsi untuk menampilkan halaman program di beranda
    public function show()
    {
        $kategoriList = KategoriProgram::with([
            'Program.institusiTerlibat'
        ])->get();

        $kategoriPrograms = KategoriProgram::with(['program' => function ($query) {
            $query->with('institusiTerlibat', 'KategoriProgram');
        }])->get()->filter(function ($kategori) {
            return $kategori->program->isNotEmpty();
        });

        $kategoriProgramIds = KategoriProgram::has('program')->pluck('id_kategori_program');

        $beritaTerkait = Berita::whereHas('kategoriNewsEvent', function ($query) use ($kategoriProgramIds) {
            $query->whereIn('id_kategori_program', $kategoriProgramIds);
        })
            ->where('status', 'show')
            ->latest()
            ->take(8)
            ->get();

        return view('program', compact('kategoriList', 'beritaTerkait', 'kategoriPrograms'));
    }


    // // fungsi untuk menampilkan halaman program di beranda berdasarkan id
    public function showProgam($id)
    {
        $campaigns = Campaign::where('id_program', $id)
            ->latest()
            ->take(3)
            ->get();
        $program = Program::with('institusiTerlibat')
            ->find($id);

        return view('halprogram', compact('program', 'campaigns'));
    }


    // fungsi untuk menampilkan halaman program per kategori dengan slug di beranda
    public function showSlug($slug)
    {
        $kategori = KategoriProgram::where('slug', $slug)->with('program')->firstOrFail();
        return view('programShowAll', compact('kategori'));
    }


    // fungsi untuk menampilkan halaman program di admin
    public function index()
    {
        return view('admin.showProgram');
    }


    // fungsi untuk membuatkan datatable program
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $programs = Program::with('KategoriProgram')->select(['id_program', 'nama', 'status', 'id_kategori_program'])
            ->orderBy('updated_at', 'desc');


        return DataTables::of($programs)
            ->addColumn('aksi', function ($row) {
                return '
                <div class="flex items-center">
                <button class="cursor-pointer editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_program) . '">Edit</button>
                <button class="cursor-pointer deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_program) . '">Hapus</button>
                </div>
            ';
            })
            ->addColumn('kategori', function ($row) {
                return $row->KategoriProgram->nama ?? '-';
            })
            ->editColumn('status', function ($row) {
                return $row->status;
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        $kategoriProgram = KategoriProgram::all();
        $institusiList = Institusi::all();
        return view('admin.formProgram', compact('kategoriProgram', 'institusiList'));
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $program = Program::with('institusiTerlibat')->findOrFail($id);
        $kategoriProgram = KategoriProgram::all();
        $institusiList = Institusi::all();
        return view('admin.formProgram', compact('program', 'kategoriProgram', 'institusiList'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'id_kategori_program' => 'nullable|exists:kategori_program,id_kategori_program',
            'institusi' => 'nullable|array',
            'institusi.*.id' => 'nullable|exists:institusi_terlibat,id_institusi',
            'institusi.*.nama' => 'required_without:institusi.*.id|string|nullable',
            'institusi.*.alamat' => 'required_without:institusi.*.id|string|nullable',
            'institusi.*.website' => 'required_without:institusi.*.id|url|nullable',
            'institusi.*.tanggal' => 'required|date',
            'institusi.*.logo' => 'required_without:institusi.*.id|image|mimes:jpeg,png,jpg,webp|max:2048|nullable',
        ]);

        DB::transaction(function () use ($request) {
            $dataProgram = $request->only(['nama', 'deskripsi', 'status', 'id_kategori_program']);

            if ($request->hasFile('image_path')) {
                $gambar = $request->file('image_path');
                $namaFile = 'img/program/' . uniqid() . '.webp';
                $gambarWebp = Image::read($gambar)->toWebp(80);
                Storage::disk('public')->put($namaFile, $gambarWebp);
                $dataProgram['image_path'] = $namaFile;
            }

            $program = Program::create($dataProgram);

            if ($request->filled('institusi')) {
                foreach ($request->institusi as $dataInstitusi) {
                    if (!empty($dataInstitusi['id'])) {
                        $program->institusiTerlibat()->attach($dataInstitusi['id'], [
                            'tanggal' => $dataInstitusi['tanggal']
                        ]);
                    } elseif (!empty($dataInstitusi['nama'])) {
                        $institusiBaru = Institusi::createFromRequest($dataInstitusi);

                        $program->institusiTerlibat()->attach($institusiBaru->id_institusi, [
                            'tanggal' => $dataInstitusi['tanggal']
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.program')->with('success', 'Program berhasil ditambahkan.');
    }



    // fungsi untuk memperbarui data lama
    public function update(Request $request, $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return redirect()->back()->with('gagal', 'Program tidak ditemukan');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'id_kategori_program' => 'nullable|exists:kategori_program,id_kategori_program',
            'institusi' => 'nullable|array',
            'institusi.*.id' => 'nullable|exists:institusi_terlibat,id_institusi',
            'institusi.*.nama' => 'required_without:institusi.*.id|string|nullable',
            'institusi.*.alamat' => 'required_without:institusi.*.id|string|nullable',
            'institusi.*.website' => 'required_without:institusi.*.id|url|nullable',
            'institusi.*.tanggal' => 'required|date',
            'institusi.*.logo' => 'required_without:institusi.*.id|image|mimes:jpeg,png,jpg,webp|max:2048|nullable',
        ]);

        DB::transaction(function () use ($request, $program) {
            $dataProgram = $request->only(['nama', 'deskripsi', 'status', 'id_kategori_program']);

            if ($request->hasFile('image_path')) {
                $gambar = $request->file('image_path');
                $namaFile = 'img/program/' . uniqid() . '.webp';
                $gambarWebp = Image::read($gambar)->toWebp(80);
                Storage::disk('public')->put($namaFile, $gambarWebp);
                $dataProgram['image_path'] = $namaFile;
            }

            $program->update($dataProgram);

            $idInstitusiInput = [];

            if ($request->filled('institusi')) {
                foreach ($request->institusi as $dataInstitusi) {
                    if (!empty($dataInstitusi['id'])) {
                        $idInstitusiInput[] = $dataInstitusi['id'];
                        $program->institusiTerlibat()->syncWithoutDetaching([
                            $dataInstitusi['id'] => ['tanggal' => $dataInstitusi['tanggal']]
                        ]);
                    } elseif (!empty($dataInstitusi['nama'])) {
                        $institusiBaru = Institusi::createFromRequest($dataInstitusi);
                        $idInstitusiInput[] = $institusiBaru->id_institusi;
                        $program->institusiTerlibat()->attach($institusiBaru->id_institusi, [
                            'tanggal' => $dataInstitusi['tanggal']
                        ]);
                    }
                }
            }

            // Hapus institusi yang tidak termasuk dalam input
            $idTersimpan = $program->institusiTerlibat()->pluck('institusi_terlibat.id_institusi')->toArray();
            $idRelasiDihapus = array_diff($idTersimpan, $idInstitusiInput);

            if (!empty($idRelasiDihapus)) {
                $program->institusiTerlibat()->detach($idRelasiDihapus);
            }
        });

        return redirect()->route('admin.program')->with('success', 'Program berhasil diperbarui.');
    }



    // fungsi untuk menghapus data
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $program = Program::findOrFail($id);

            $program->institusiTerlibat()->detach();

            if ($program->image_path && Storage::disk('public')->exists($program->image_path)) {
                Storage::disk('public')->delete($program->image_path);
            }

            $program->delete();
        });

        return redirect()->route('admin.program')->with('success', 'Program berhasil dihapus.');
    }
}
