@extends('layouts.formAdmin')

@section('title', isset($jenis_publikasi) ? 'Edit Jenis Publikasi' : 'Tambah Jenis Publikasi')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Jenis Publikasi</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php $isEdit = isset($jenis_publikasi); @endphp

    <form
        action="{{ $isEdit ? route('jenisPublikasi.update', $jenis_publikasi->id_jenis_publikasi) : route('jenisPublikasi.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif
        <div class="mt-4">
            <label for="nama" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $jenis_publikasi->nama ?? '') }}"
                placeholder="Masukkan jenis publikasi..."
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
            @error('nama')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.jenisPublikasi') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                    {{ isset($jenis_publikasi) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </div>
    </form>
@endsection
