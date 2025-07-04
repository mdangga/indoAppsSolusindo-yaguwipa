<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Quill Snow Theme --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    {{-- Highlight.js Theme --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />

    {{-- KaTeX CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

</head>

<body>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="p-4 md:ml-64 pt-20">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }}</h1>

            @if (session('message'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @php $isEdit = isset($berita); @endphp

            <form action="{{ $isEdit ? route('berita.update', $berita->id_berita) : route('berita.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="id_kategori_news_event" class="block mb-1 text-sm font-medium">Kategori</label>
                        <select name="id_kategori_news_event" id="id_kategori_news_event"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoriList as $kategori)
                                <option value="{{ $kategori->id_kategori_news_event }}"
                                    {{ old('id_kategori_news_event', $berita->id_kategori_news_event ?? '') == $kategori->id_kategori_news_event ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_news_event')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_publish" class="block mb-1 text-sm font-medium">Tanggal Publish</label>
                        <input type="datetime-local" name="tanggal_publish" id="tanggal_publish"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            value="{{ old('tanggal_publish', $berita->tanggal_publish ?? '') }}" />
                        @error('tanggal_publish')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="judul" class="block mb-1 text-sm font-medium">Judul</label>
                    <input type="text" name="judul" id="judul" placeholder="Judul berita..."
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        value="{{ old('judul', $berita->judul ?? '') }}" required />
                    @error('judul')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Isi Berita</label>

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
                        {!! old('isi_berita', $berita->isi_berita ?? '') !!}
                    </div>

                    <!-- Input hidden yang akan disubmit ke backend -->
                    <input type="hidden" name="isi_berita" id="isi_berita">
                    @error('isi_berita')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                @if (!empty($berita) && !empty($berita->thumbnail))
                    {{-- Mode Edit: Tampilkan gambar --}}
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        {{-- Kolom 1 dan 2: Upload + Caption --}}
                        <div class="col-span-2 grid grid-rows-2 gap-4">
                            {{-- Upload Gambar --}}
                            <div>
                                <label for="thumbnail" class="block mb-1 text-sm font-medium">Upload Gambar</label>
                                <input type="file" name="thumbnail" id="thumbnail"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
                                @error('thumbnail')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Caption --}}
                            <div>
                                <label for="caption" class="block mb-1 text-sm font-medium">Caption Gambar</label>
                                <input type="text" name="caption"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                    value="{{ old('caption', $berita->caption ?? '') }}" />
                                @error('caption')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Kolom 3: Gambar --}}
                        <div class="row-span-2 flex justify-center items-center h-full">
                            <div class="h-full flex items-center">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Thumbnail lama"
                                    class="max-h-32 rounded shadow" />
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Mode Tambah: Upload + Caption berdampingan --}}
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        {{-- Upload Gambar --}}
                        <div>
                            <label for="thumbnail" class="block mb-1 text-sm font-medium">Upload Gambar</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
                            @error('thumbnail')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Caption --}}
                        <div>
                            <label for="caption" class="block mb-1 text-sm font-medium">Caption Gambar</label>
                            <input type="text" name="caption"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                value="{{ old('caption') }}" />
                        </div>
                    </div>
                @endif




                <div class="mt-4">
                    <label for="keyword" class="block mb-1 text-sm font-medium">Keyword</label>
                    <input type="text" name="keyword" id="keyword"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        value="{{ old('keyword', $berita->keyword ?? '') }}" />
                    <small class="text-gray-500">Contoh: berita;terbaru (tanpa spasi dan tanda baca)</small>
                    @error('keyword')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-6 mt-4">
                    {{-- Meta Title --}}
                    <div>
                        <label for="meta_title" class="block mb-1 text-sm font-medium">Meta Title</label>
                        <input name="meta_title" id="meta_title" type="text"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            value="{{ old('meta_title', $berita->meta_title ?? '') }}" required />
                        @error('meta_title')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Meta Description --}}
                    <div>
                        <label for="meta_description" class="block mb-1 text-sm font-medium">Meta Description</label>
                        <input type="text" name="meta_description" id="meta_description"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            value="{{ old('meta_description', $berita->meta_description ?? '') }}" required />
                        @error('meta_description')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="hit" class="block mb-1 text-sm font-medium">Hit</label>
                        <input id="hit" type="number" name="hit"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            value="{{ old('hit', $berita->hit ?? '') }}" required>
                        @error('hit')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block mb-1 text-sm font-medium">Status</label>
                        <select id="status" name="status"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <option value="show"
                                {{ old('status', $berita->status ?? '') == 'show' ? 'selected' : '' }}>Show</option>
                            <option value="hide"
                                {{ old('status', $berita->status ?? '') == 'hide' ? 'selected' : '' }}>Hide</option>
                        </select>
                        @error('status')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        {{ $isEdit ? 'Update Berita' : 'Simpan Berita' }}
                    </button>
                </div>
            </form>
        </div>
    </main>

    {{-- Quill Setup --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.min.js"></script>

    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Compose an epic...',
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

        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const isi_berita = document.querySelector('#isi_berita');
            isi_berita.value = quill.root.innerHTML;
        });
    </script>
    </script>
</body>

</html>
