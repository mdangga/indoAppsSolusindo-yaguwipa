<?php

namespace App\Http\Controllers;

use App\Models\Institusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Laravel\Facades\Image;

class InstitusiController extends Controller
{
    // fungsi untuk menampilkan halaman sosial media di admin
    public function index()
    {
        return view('admin.showInstitusi');
    }


    // fungsi untuk membuatkan datatable sosial media
    public function getDataTables(Request $request)
    {
        if (!$request->ajax()) {
            return abort(403, 'Akses tidak diizinkan');
        }

        $institusi = Institusi::select(['id_institusi', 'nama', 'image_path', 'status']);

        return DataTables::of($institusi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
            <div class="flex items-center">
            <button class="cursor-pointer editBtn bg-blue-500 text-white px-2 py-1 rounded text-sm" data-id="' . e($row->id_institusi) . '">Edit</button>
            <button class="cursor-pointer deleteBtn bg-red-500 text-white px-2 py-1 rounded text-sm ml-2" data-id="' . e($row->id_institusi) . '">Hapus</button>
            </div>
        ';
            })
            ->editColumn('status', function ($row) {
                return $row->status;
            })
            ->editColumn('image_path', function ($row) {
                if (!$row->image_path) {
                    return null;
                }
                return asset('storage/' . $row->image_path);
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }


    // fungsi untuk menampilkan form menambahkan data
    public function showFormStore()
    {
        return view('admin.formInstitusi');
    }


    // fungsi untuk menampilkan form memperbarui data
    public function showFormEdit($id)
    {
        $institusi = Institusi::findOrFail($id);
        return view('admin.formInstitusi', compact('institusi'));
    }


    // fungsi untuk menambahkan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();
        Institusi::createFromRequest($data);
        return redirect()->route('admin.institusi')->with('success', 'Institusi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $institusi = Institusi::find($id);

        if (!$institusi) {
            return redirect()->back()->with('gagal', 'Institusi tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:show,hide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Validasi gagal.');
        }

        $data = $validator->validated();

        if (!empty($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
            if ($institusi->image_path && Storage::disk('public')->exists($institusi->image_path)) {
                Storage::disk('public')->delete($institusi->image_path);
            }
            try {
                $namaFile = 'img/institusi/' . uniqid() . '.webp';
                $gambarWebp = Image::read($data['logo'])->toWebp(80);
                Storage::disk('public')->put($namaFile, $gambarWebp);
                $data['image_path'] = $namaFile;
            } catch (\Throwable $e) {
                return redirect()->back()->with('gagal', 'Gagal mengunggah logo baru: ' . $e->getMessage());
            }
        } else {
            $data['image_path'] = $institusi->image_path;
        }

        $institusi->update([
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'website' => $data['website'],
            'image_path' => $data['image_path'],
            'status' => $data['status'],
        ]);

        return redirect()->route('admin.institusi')->with('success', 'Institusi berhasil diedit!');
    }


    public function destroy(string $id)
    {
        $institusi = Institusi::find($id);

        if (!$institusi) {
            return redirect()->back()->with('gagal', 'Institusi tidak ditemukan');
        }

        if ($institusi->image_path && Storage::disk('public')->exists($institusi->image_path)) {
            Storage::disk('public')->delete($institusi->image_path);
        }

        $institusi->delete();

        return redirect()->route('admin.institusi')->with('success', 'Institusi berhasil dihapus!');
    }
}
