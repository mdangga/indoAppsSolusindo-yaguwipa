<?php

namespace App\Http\Controllers;

use App\Models\KataKotor;
use Illuminate\Http\Request;

class KataKotorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $kataKotor = KataKotor::when($search, function ($query) use ($search) {
            return $query->where('kata', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(50);

        $kataEdit = session('kataEdit', null);

        return view('admin.showKata', compact('kataKotor', 'kataEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kata' => 'required|string|max:255|unique:kata_kotor,kata'
        ]);

        KataKotor::create($request->only('kata'));

        return redirect()->route('admin.kataKotor')
            ->with('success', 'Kata kotor berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kata' => 'required|string|max:255|unique:kata_kotor,kata,' . $id . ',id_kata'
        ]);

        $kataKotor = KataKotor::findOrFail($id);
        $kataKotor->update($request->only('kata'));

        return redirect()->route('admin.kataKotor')
            ->with('success', 'Kata kotor berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kataKotor = KataKotor::findOrFail($id);
        $kataKotor->delete();

        return redirect()->route('admin.kataKotor')
            ->with('success', 'Kata kotor berhasil dihapus');
    }
}
