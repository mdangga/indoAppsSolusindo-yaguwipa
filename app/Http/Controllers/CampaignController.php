<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donasi;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function showSlug($slug)
    {
        $campaign = Campaign::with('Program.KategoriProgram', 'Donasi')
            ->where('slug', $slug)->firstOrFail();
        $donations = Donasi::with(['DonasiDana', 'DonasiBarang', 'DonasiJasa'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        return view('detailDonasi', compact('campaign', 'donations'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('admin.formCampaign', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'target_dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,selesai,pending',
            'lokasi' => 'required|string|max:255',
            'id_program' => 'required|exists:program,id_program'
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama']) . '-' . uniqid();

        // Handle gambar
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('campaigns', 'public');
        }

        // Buat campaign
        Campaign::create($validated);

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign berhasil dibuat');
    }


    public function edit($slug)
    {
        $programs = Program::all();
        return view('admin.formCampaign', compact('programs'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'target_dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,selesai,pending',
            'lokasi' => 'required|string|max:255',
            'id_program' => 'required|exists:program,id_program'
        ]);

        // Update slug jika nama berubah
        if ($campaign->nama !== $validated['nama']) {
            $validated['slug'] = Str::slug($validated['nama']) . '-' . uniqid();
        }

        // Handle gambar
        if ($request->hasFile('image_path')) {
            if ($campaign->image_path) {
                Storage::disk('public')->delete($campaign->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('campaigns', 'public');
        }

        $campaign->update($validated);

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign berhasil diperbarui');
    }


    public function destroy(Campaign $campaign)
    {
        // Hapus gambar jika ada
        if ($campaign->image_path) {
            Storage::disk('public')->delete($campaign->image_path);
        }

        $campaign->delete();

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign berhasil dihapus');
    }
}
