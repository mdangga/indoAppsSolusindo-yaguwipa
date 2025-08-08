@extends('layouts.formAdmin')

@section('title', isset($kategori) ? 'Edit Kategori Berita' : 'Tambah Kategori Berita')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php $isEdit = isset($kategori); @endphp

    <form
        action="{{ $isEdit ? route('kategoriBerita.update', $kategori->id_kategori_news_event) : route('kategoriBerita.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        <div class="grid md:grid-cols-2 gap-6 mt-4">

            <div class="mt-4">
                <label for="nama" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama ?? '') }}"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                @error('nama')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-4">
                <label for="id_kategori_program" class="block mb-1 text-sm font-medium text-gray-900">Kategori
                    Program</label>
                <select name="id_kategori_program" id="id_kategori_program"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($program as $kategoris)
                        <option value="{{ $kategoris->id_kategori_program }}"
                            {{ old('id_kategori_program', $kategori->id_kategori_program ?? '') == $kategoris->id_kategori_program ? 'selected' : '' }}>
                            {{ $kategoris->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori_program')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="pt-4">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.kategoriBerita') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                    {{ isset($kategori) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </div>
    </form>
@endsection
