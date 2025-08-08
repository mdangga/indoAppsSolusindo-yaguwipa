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
            <label class="block font-medium mb-1">Nama Institusi</label>
            <input type="text" name="nama" value="{{ old('nama', $institusi->nama ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
            @error('nama')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Alamat</label>
            <textarea name="alamat" rows="3" re\
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">{{ old('alamat', $institusi->alamat ?? '') }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Website --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Website</label>
            <input type="url" name="website" value="{{ old('website', $institusi->website ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
            @error('website')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select name="status"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
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
            <label class="block font-medium mb-1">Logo / Gambar</label>
            <input type="file" name="logo" {{ isset($institusi) ? '' : 'required' }}
                class="w-full border border-gray-300 rounded-lg px-4 py-2">

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
