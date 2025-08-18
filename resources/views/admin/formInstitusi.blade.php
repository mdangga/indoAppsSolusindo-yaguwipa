@extends('layouts.formAdmin')

@section('title', isset($institusi) ? 'Edit Institusi' : 'Tambah Institusi')

@section('content')
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($institusi) ? 'Edit' : 'Tambah' }} Institusi Terlibat
    </h1>

    <form action="{{ isset($institusi) ? route('institusi.update', $institusi->id_institusi) : route('institusi.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($institusi))
            @method('PUT')
        @endif

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Nama Institusi</label>
            <input type="text" name="nama" value="{{ old('nama', $institusi->nama ?? '') }}"
                placeholder="Masukkan nama instansi..." required
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
            @error('nama')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Alamat</label>
            <textarea name="alamat" rows="3" placeholder="Masukkan alamat instansi..." required
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">{{ old('alamat', $institusi->alamat ?? '') }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Website --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Website</label>
            <input type="url" name="website" placeholder="https://example.com"
                value="{{ old('website', $institusi->website ?? '') }}" required
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            @error('website')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Status</label>
            <select name="status"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                <option value="show" {{ old('status', $institusi->status ?? '') === 'show' ? 'selected' : '' }}>Show
                </option>
                <option value="hide" {{ old('status', $institusi->status ?? '') === 'hide' ? 'selected' : '' }}>Hide
                </option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Logo / Gambar</label>
            <input type="file" name="logo" {{ isset($institusi) ? '' : 'required' }}
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
            <small class="text-gray-500">PNG, JPG, JPEG, WEBP (Max. 2MB)</small>
            @if (isset($institusi) && $institusi->image_path)
                <p class="mt-2 text-sm text-gray-500">
                    Gambar saat ini:
                    <a href="{{ asset('storage/' . $institusi->image_path) }}" target="_blank"
                        class="text-blue-600 underline">
                        Lihat Gambar
                    </a>
                </p>
            @endif

            @error('logo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                {{ isset($institusi) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
@endsection
