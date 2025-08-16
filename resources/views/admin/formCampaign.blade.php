@extends('layouts.formAdmin')

@section('title', isset($campaign) ? 'Edit Campaign' : 'Buat Campaign Baru')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ isset($campaign) ? 'Edit' : 'Buat' }} Campaign</h1>


    @if (session('message'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @php $isEdit = isset($campaign); @endphp

    <form action="{{ isset($campaign) ? route('campaigns.update', $campaign->id_campaign) : route('campaigns.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf

        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block mb-1 text-sm font-medium">Nama Campaign</label>
                <input type="text"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    id="nama" name="nama" value="{{ old('nama', $campaign->nama ?? '') }}" required>
                @error('nama')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>


            <div>
                <label for="id_program" class="block mb-1 text-sm font-medium">Program</label>
                <select
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    id="id_program" name="id_program" required>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id_program }}"
                            {{ old('id_program', $campaign->id_program ?? '') == $program->id_program ? 'selected' : '' }}>
                            {{ $program->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_program')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="deskripsi" class="block mb-1 text-sm font-medium">Deskripsi</label>
            <textarea
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $campaign->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>


        @php
            // Cek apakah thumbnail ada dan file-nya benar-benar tersedia
            $thumbnailPath = $campaign->image_path ?? null;
            $thumbnailFullPath = $thumbnailPath ? storage_path('app/public/' . $thumbnailPath) : null;
            $thumbnailExists = $thumbnailFullPath && file_exists($thumbnailFullPath);
        @endphp

        @if (!empty($campaign))
            {{-- Mode Edit: Tampilkan form + thumbnail jika ada --}}
            <div class="grid grid-cols-3 gap-4 mt-4">
                {{-- Kolom 1 dan 2: Upload + Caption --}}
                <div class="col-span-2 grid grid-rows-2 gap-4">
                    {{-- Upload Gambar --}}
                    <div>
                        <label for="image_path" class="block mb-1 text-sm font-medium">Gambar Campaign</label>
                        <input type="file"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="image_path" name="image_path">
                        @error('image_path')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Caption --}}
                    <div>
                        <label for="lokasi" class="block mb-1 text-sm font-medium">Lokasi</label>
                        <input type="text"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            id="lokasi" name="lokasi" value="{{ old('lokasi', $campaign->lokasi ?? '') }}" required>
                        @error('lokasi')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Kolom 3: Gambar atau Placeholder --}}
                <div class="row-span-2 flex justify-center items-center h-full">
                    <div class="h-full flex items-center">
                        @if ($thumbnailExists)
                            <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="Thumbnail lama"
                                class="max-h-32 rounded shadow" />
                        @else
                            <div
                                class="w-64 h-32 bg-gray-100 text-gray-500 text-sm flex items-center justify-center border rounded">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            {{-- Mode Tambah: Upload + Caption --}}
            <div class="grid grid-cols-2 gap-4 mt-4">
                {{-- Upload Gambar --}}
                <div>
                    <label for="image_path" class="block mb-1 text-sm font-medium">Gambar Campaign</label>
                    <input type="file"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        id="image_path" name="image_path">
                    @error('image_path')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Caption --}}
                <div>
                    <label for="lokasi" class="block mb-1 text-sm font-medium">Lokasi</label>
                    <input type="text"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        id="lokasi" name="lokasi" value="{{ old('lokasi', $campaign->lokasi ?? '') }}" required>
                    @error('lokasi')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endif

        <div class="mt-4">
            <label for="target_dana" class="block mb-1 text-sm font-medium">Target Dana (Rp) <span
                    class="text-gray-500 text-xs">(minimal 0)</span></label>
            <input type="number"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                id="target_dana" name="target_dana" value="{{ old('target_dana', $campaign->target_dana ?? '') }}"
                required>
            @error('target_dana')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="grid md:grid-cols-3 gap-6 mt-4">
            <div>
                <label for="tanggal_mulai" class="block mb-1 text-sm font-medium">Tanggal Mulai</label>
                <input type="date"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    id="tanggal_mulai" name="tanggal_mulai"
                    value="{{ old('tanggal_mulai', isset($campaign) ? \Carbon\Carbon::parse($campaign->tanggal_mulai)->format('Y-m-d') : '') }}"
                    required>
                @error('tanggal_mulai')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="tanggal_selesai" class="block mb-1 text-sm font-medium">Tanggal Selesai</label>
                <input type="date"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    id="tanggal_selesai" name="tanggal_selesai"
                    value="{{ old('tanggal_selesai', isset($campaign) ? \Carbon\Carbon::parse($campaign->tanggal_selesai)->format('Y-m-d') : '') }}"
                    required>
                @error('tanggal_selesai')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="status" class="block mb-1 text-sm font-medium">Status</label>
                <select
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    id="status" name="status" required>
                    <option value="aktif" {{ old('status', $campaign->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif
                    </option>
                    <option value="pending" {{ old('status', $campaign->status ?? '') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="selesai" {{ old('status', $campaign->status ?? '') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                </select>

                @error('status')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>


        <!-- Submit Button -->
        <div class="pt-4">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.campaigns') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                    {{ isset($campaign) ? 'Update Campaign' : 'Simpan Campaign' }}
                </button>
            </div>
        </div>
    </form>
@endsection
