<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Tailwind + JS Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AOS (Animation) --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    {{-- Flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</head>

<body>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="p-4 md:ml-64 pt-20">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Tambah Berita</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Kategori & Tanggal --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Kategori</label>
                        <select name="kategori"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <option value="">Pilih Kategori</option>
                            <option value="Berita">Berita</option>
                            <option value="Kegiatan">Kegiatan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
                        <input type="date" name="tanggal"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mt-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Judul</label>
                    <input type="text" name="judul" placeholder="Masukkan judul berita.."
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>

                {{-- Konten & Gambar --}}
                <div class="mt-4">
                    {{-- Content Berita --}}
                    <label class="block mb-1 text-sm font-medium text-gray-900">Content Berita</label>
                    <textarea name="konten" rows="10"
                        class="flex-grow block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis isi berita di sini..."></textarea>
                </div>


                {{-- inputfile --}}
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    {{-- Input File --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Caption Gambar</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none "
                            id="default_size" type="file">
                    </div>

                    {{-- Caption Gambar --}}
                    <div class="col-span-1">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Caption Gambar</label>
                        <input type="text" name="caption" placeholder="Caption gambar berita..."
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                    </div>
                </div>


                {{-- Tags --}}
                <div class="mt-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Tags</label>
                    <input type="text" name="tags" placeholder="Masukkan Tags..."
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                    <small class="text-gray-500">Contoh: berita;terbaru (tanpa spasi dan tanda
                        baca)</small>
                </div>

                {{-- Meta Keywords --}}
                <div class="mt-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Meta Keywords</label>
                    <input type="text" name="meta_keywords" placeholder="Meta Keywords..."
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                </div>

                {{-- Hit & Status --}}
                <div class="grid md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Hit</label>
                        <input type="number" name="hit"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Status</label>
                        <select name="status"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <option value="Show">Show</option>
                            <option value="Hide">Hide</option>
                        </select>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('dropzone-file').addEventListener('change', function(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];

            const previewContainer = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-img');
            const previewFileName = document.getElementById('preview-filename');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewFileName.textContent = file.name;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewFileName.textContent = '';
                previewContainer.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
