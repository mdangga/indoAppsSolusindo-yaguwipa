@extends('layouts.formAdmin')

@section('title', isset($publikasi) ? 'Edit Publikasi' : 'Tambah Publikasi')
@section('quill')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endsection
@section('highlight')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
@endsection
@section('katex')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
@endsection

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ isset($publikasi) ? 'Edit publikasi' : 'Tambah publikasi' }}</h1>

    @if (session('message'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @php $isEdit = isset($publikasi); @endphp

    <form id="formPublikasi"
        action="{{ $isEdit ? route('publikasi.update', $publikasi->id_publikasi) : route('publikasi.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="id_jenis_publikasi" class="block mb-1 text-sm font-medium">Jenis Publikasi</label>
                <select name="id_jenis_publikasi" id="id_jenis_publikasi"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    required>
                    <option value="">-- Pilih --</option>
                    @foreach ($jenisPublikasi as $kategori)
                        <option value="{{ $kategori->id_jenis_publikasi }}"
                            {{ old('id_jenis_publikasi', $publikasi->id_jenis_publikasi ?? '') == $kategori->id_jenis_publikasi ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_jenis_publikasi')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="tanggal_terbit" class="block mb-1 text-sm font-medium">Tanggal Terbit</label>
                <input type="datetime-local" name="tanggal_terbit" id="tanggal_terbit"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    value="{{ old('tanggal_terbit', $publikasi->tanggal_terbit ?? '') }}" />
                @error('tanggal_terbit')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <label for="judul" class="block mb-1 text-sm font-medium">Judul</label>
            <input type="text" name="judul" id="judul" placeholder="Judul publikasi..."
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                value="{{ old('judul', $publikasi->judul ?? '') }}" required />
            @error('judul')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-4">
            <label class="block mb-1 text-sm font-medium">Deskripsi</label>
            {{-- toolbar --}}
            <div id="toolbar-container" class="rounded-t-lg">
                <span class="ql-formats">
                    <select class="ql-font"></select>
                    <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                    <select class="ql-color"></select>
                    <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-script" value="sub"></button>
                    <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-header" value="1"></button>
                    <button class="ql-header" value="2"></button>
                    <button class="ql-blockquote"></button>
                    <button class="ql-code-block"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-list" value="ordered"></button>
                    <button class="ql-list" value="bullet"></button>
                    <button class="ql-indent" value="-1"></button>
                    <button class="ql-indent" value="+1"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-direction" value="rtl"></button>
                    <select class="ql-align"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                    <button class="ql-video"></button>
                    <button class="ql-formula"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-clean"></button>
                </span>
            </div>

            <!-- Editor tampil di sini -->
            <div id="editor" class="bg-gray-50 border rounded-t-none rounded-b-lg p-2.5 min-h-[200px]">
                {!! old('deskripsi', $publikasi->deskripsi ?? '') !!}
            </div>

            <!-- Input hidden yang akan disubmit ke backend -->
            <input type="hidden" name="deskripsi" id="deskripsi">
            @error('deskripsi')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="grid md:grid-cols-4 gap-6 mt-4">
            <div class="col-span-2">
                <label for="file" class="block mb-1 text-sm font-medium">Upload File</label>
                <input type="file" name="file" id="file"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
                @error('file')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="halaman" class="block mb-1 text-sm font-medium">Jumlah Halaman</label>
                <input name="halaman" id="halaman" type="number"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    value="{{ old('halaman', $publikasi->halaman ?? '') }}" required />
                @error('halaman')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="download" class="block mb-1 text-sm font-medium">Downloads</label>
                <input name="download" id="download" type="number"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    value="{{ old('download', $publikasi->download ?? '') }}" required />
                @error('download')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mt-4">
            {{-- Meta Title --}}
            <div>
                <label for="meta_title" class="block mb-1 text-sm font-medium">Meta Title</label>
                <input name="meta_title" id="meta_title" type="text"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    value="{{ old('meta_title', $publikasi->meta_title ?? '') }}" required />
                @error('meta_title')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="status" class="block mb-1 text-sm font-medium">Status</label>
                <select id="status" name="status"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    <option value="show" {{ old('status', $publikasi->status ?? '') == 'show' ? 'selected' : '' }}>
                        Show</option>
                    <option value="hide" {{ old('status', $publikasi->status ?? '') == 'hide' ? 'selected' : '' }}>
                        Hide</option>
                </select>
                @error('status')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Meta Description --}}
        <div class="mt-4">
            <label for="meta_description" class="block mb-1 text-sm font-medium">Meta Description</label>
            <textarea type="text" name="meta_description" id="meta_description"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                required>{{ old('meta_description', $publikasi->meta_description ?? '') }}</textarea>
            @error('meta_description')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="pt-4">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.publikasi') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                    {{ isset($publikasi) ? 'Update Publikasi' : 'Simpan Publikasi' }}
                </button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Ketik disini....',
            modules: {
                syntax: true, // Syntax highlighting
                formula: true, // KaTeX formula
                toolbar: '#toolbar-container'
            }
        });

        // Optional: re-highlight code blocks after content change
        quill.on('text-change', function() {
            document.querySelectorAll('pre code').forEach(block => {
                hljs.highlightElement(block);
            });
        });

        const form = document.querySelector('#formPublikasi');
        form.addEventListener('submit', function() {
            const deskripsi = document.querySelector('#deskripsi');
            deskripsi.value = quill.root.innerHTML;
        });
    </script>
@endpush
