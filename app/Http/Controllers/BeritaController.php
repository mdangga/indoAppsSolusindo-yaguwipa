<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('is_dipublish', true)
            ->orderBy('tanggal_publish', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $berita
        ]);
    }

    public function beranda()
    {
        $berita = Berita::where('is_dipublish', true)
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();
        $gallery = Gallery::orderBy('created_at', 'desc')->take(5)->get();
        return view('beranda', compact('berita', 'gallery'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'keyword'=> 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Inisialisasi data
        $data = $request->only(['judul', 'isi_berita']);
        $data['slug'] = Str::slug($request->judul);

        if ($request->has('keyword')) {
            $data['keyword'] = $request->keyword;
        }

        // Upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('img/thumbnail-berita', 'public');
            $data['thumbnail'] = $path;
        }

        // Handle publish
        $data['is_dipublish'] = $request->boolean('is_dipublish', false);
        $data['tanggal_publish'] = $data['is_dipublish'] ? now() : null;

        // Create berita
        $berita = Berita::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita created successfully',
            'data' => $berita
        ], 201);
        // return redirect('/berita/' . $berita->slug);
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita not found'
            ], 404);
        }

        // Increment view count
        $berita->increment('dibaca');

        return response()->json([
            'success' => true,
            'data' => $berita
        ]);

        // return view('berita', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|required|string|max:255',
            'isi_berita' => 'sometimes|required|string',
            'thumbnail' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        // Update slug if title changed
        if ($request->has('judul')) {
            $data['slug'] = Str::slug($request->judul);
        }

        // Set publish date if publishing
        if ($request->has('is_dipublish') && $request->is_dipublish && !$berita->is_dipublish) {
            $data['tanggal_publish'] = now();
        }

        $berita->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita updated successfully',
            'data' => $berita
        ]);
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita not found'
            ], 404);
        }

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita deleted successfully'
        ]);
    }
}