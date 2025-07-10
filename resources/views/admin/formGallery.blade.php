<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="p-6 sm:ml-64 pt-24 transition-all ">
        <div class="w-full bg-white p-6 rounded shadow">
            @if (session('message'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @php
                $isEdit = isset($gallery);
            @endphp

            <h2 class="text-2xl font-bold mb-4">{{ $isEdit ? 'Update' : 'Tambah' }} Gallery</h2>

            <form action="{{ $isEdit ? route('gallery.update', $gallery->id_gallery) : route('gallery.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div id="form-wrapper" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 transition-all duration-300">
                    <!-- Kiri: Form Input -->
                    <div id="form-input" class="flex flex-col space-y-6 col-span-1 transition-all duration-300">

                        <div class="mb-4">
                            <label for="kategori" class="block font-semibold">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                required>
                                <option value="foto"
                                    {{ old('kategori', $gallery->kategori ?? '') == 'foto' ? 'selected' : '' }}>
                                    Foto
                                </option>
                                <option value="youtube"
                                    {{ old('kategori', $gallery->kategori ?? '') == 'youtube' ? 'selected' : '' }}>
                                    YouTube
                                </option>
                            </select>
                            @error('kategori')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4" id="youtube-link-container" style="display: none;">
                            <label for="youtube_link" class="block font-semibold">YouTube URL</label>
                            <input type="url" name="youtube_link" id="youtube_link"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                value="{{ old('youtube_link') }}">
                            <small class="text-gray-500">Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ</small>
                            @error('youtube_link')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alt_text" class="block font-semibold">Caption</label>
                            <input type="text" name="alt_text" id="alt_text"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                value="{{ old('alt_text', $gallery->alt_text ?? '') }}" required>
                            @error('alt_text')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block font-semibold">Status</label>
                            <select name="status" id="status"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                <option value="show"
                                    {{ old('status', $gallery->status ?? '') == 'show' ? 'selected' : '' }}>
                                    Show</option>
                                <option value="hide"
                                    {{ old('status', $gallery->status ?? '') == 'hide' ? 'selected' : '' }}>
                                    Hide</option>
                            </select>
                            @error('status')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Kanan: Upload Card -->
                    <div id="file-upload-container" class="flex flex-col h-full">
                        <div id="file-upload"
                            class="flex-1 flex flex-col justify-between group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md overflow-hidden">
                            <div class="relative">
                                <div
                                    class="relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                    <img src="{{ isset($gallery->link) ? asset('storage/' . $gallery->link) : asset('storage/img/img-placeholder.webp') }}"
                                        class="object-contain w-full h-32 {{ empty($gallery->link) ? 'opacity-40 grayscale' : '' }}">
                                </div>

                                <div class="absolute top-1 left-1">
                                    @if (empty($gallery->link))
                                        <span
                                            class="block px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                            Belum diunggah
                                        </span>
                                    @else
                                        <span
                                            class="block px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            Sudah diunggah
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6 flex-grow flex flex-col justify-between">
                                <div class="space-y-1">
                                    <div class="relative">
                                        <input type="file" name="link" id="link-upload" accept="image/*"
                                            data-field="link"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input">

                                        <div
                                            class="flex items-center justify-center w-full h-12 px-4 bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-dashed border-blue-200 rounded-xl hover:from-blue-100 hover:to-purple-100 hover:border-blue-300 transition-all duration-300 cursor-pointer group">
                                            <div
                                                class="flex items-center space-x-2 text-blue-600 group-hover:text-blue-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span class="text-sm font-medium">
                                                    {{ empty($gallery->link) ? 'Pilih File Gambar' : 'Ganti Gambar' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-file-info="link"
                                        class="hidden bg-blue-50 border border-blue-200 rounded-lg p-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <div>
                                                    <p data-file-name="link"
                                                        class="text-sm font-medium text-blue-800"></p>
                                                    <p data-file-size="link" class="text-xs text-blue-600"></p>
                                                </div>
                                            </div>
                                            <button type="button" onclick="clearFile('link')"
                                                class="text-blue-600 hover:text-blue-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">Format: JPG, JPEG, PNG, atau WEBP. Maks 5MB.</p>
                                    </div>

                                    @error('link')
                                        <div
                                            class="flex items-center space-x-2 text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <small class="text-sm">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
            </form>
        </div>
    </main>
    <script>
        function updateFileUI(fieldName, file) {
            const elements = {
                fileInfo: document.querySelector(`[data-file-info="${fieldName}"]`),
                fileName: document.querySelector(`[data-file-name="${fieldName}"]`),
                fileSize: document.querySelector(`[data-file-size="${fieldName}"]`),
                uploadArea: document.querySelector(`[data-upload-area="${fieldName}"]`),
                uploadIcon: document.querySelector(`[data-upload-icon="${fieldName}"]`),
                uploadText: document.querySelector(`[data-upload-text="${fieldName}"]`),
                statusBadge: document.querySelector(`[data-status="${fieldName}"]`)
            };

            // Show file info
            elements.fileName.textContent = file.name;
            elements.fileSize.textContent = formatFileSize(file.size);
            elements.fileInfo.classList.remove('hidden');

            // Update upload area
            elements.uploadArea.className =
                'flex items-center justify-center w-full h-12 px-4 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-solid border-green-200 rounded-xl transition-all duration-300 cursor-pointer';

            // Update icon to check
            elements.uploadIcon.innerHTML =
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>`;
            elements.uploadIcon.className = 'w-5 h-5 text-green-600';

            // Update text
            elements.uploadText.textContent = 'File siap diupload';
            elements.uploadText.className = 'text-sm font-medium text-green-600';

            // Update status badge
            elements.statusBadge.textContent = 'Siap diupload';
            elements.statusBadge.className =
                'block items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200';
        }

        function clearFile(fieldName) {
            const elements = {
                input: document.getElementById(`${fieldName}-upload`),
                fileInfo: document.querySelector(`[data-file-info="${fieldName}"]`),
                uploadArea: document.querySelector(`[data-upload-area="${fieldName}"]`),
                uploadIcon: document.querySelector(`[data-upload-icon="${fieldName}"]`),
                uploadText: document.querySelector(`[data-upload-text="${fieldName}"]`),
                statusBadge: document.querySelector(`[data-status="${fieldName}"]`)
            };

            // Clear input
            elements.input.value = '';

            // Hide file info
            elements.fileInfo.classList.add('hidden');

            // Reset upload area
            elements.uploadArea.className =
                'flex items-center justify-center w-full h-12 px-4 bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-dashed border-blue-200 rounded-xl hover:from-blue-100 hover:to-purple-100 hover:border-blue-300 transition-all duration-300 cursor-pointer group';

            // Reset icon
            elements.uploadIcon.innerHTML =
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>`;
            elements.uploadIcon.className = 'w-5 h-5';

            // Reset text
            elements.uploadText.textContent = `Pilih file ${fieldName}`;
            elements.uploadText.className = 'text-sm font-medium';

            // Reset status badge
            const isOptional = fieldName === 'popup';
            elements.statusBadge.textContent = isOptional ? 'Opsional' : 'Belum diunggah';
            elements.statusBadge.className =
                'block items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        document.addEventListener('DOMContentLoaded', function() {
            const kategoriSelect = document.getElementById('kategori');
            const youtubeContainer = document.getElementById('youtube-link-container');
            const fileUploadContainer = document.getElementById('file-upload');

            function toggleFields() {
                const isYoutube = kategoriSelect.value === 'youtube';

                youtubeContainer.style.display = isYoutube ? 'block' : 'none';
                fileUploadContainer.style.display = isYoutube ? 'none' : 'block';

                const formWrapper = document.getElementById('form-wrapper');
                const formInput = document.getElementById('form-input');

                if (isYoutube) {
                    formWrapper.classList.remove('md:grid-cols-2');
                    formWrapper.classList.add('md:grid-cols-1');
                    formInput.classList.remove('col-span-1');
                    formInput.classList.add('col-span-2');
                } else {
                    formWrapper.classList.remove('md:grid-cols-1');
                    formWrapper.classList.add('md:grid-cols-2');
                    formInput.classList.remove('col-span-2');
                    formInput.classList.add('col-span-1');
                }
            }


            // Jalankan saat halaman dimuat
            toggleFields();

            // Jalankan saat kategori berubah
            kategoriSelect.addEventListener('change', toggleFields);

            // Universal file input handler
            document.querySelectorAll('.file-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    const fieldName = this.dataset.field;
                    const file = this.files[0];

                    if (file) {
                        updateFileUI(fieldName, file);
                    }
                });
            });
        });
    </script>

</body>

</html>
