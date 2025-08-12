<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>General - Setting</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">

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

    {{-- Quill Snow Theme --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    {{-- Highlight.js Theme --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />

    {{-- KaTeX CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />


</head>

<body>
    <x-admin.navbar-admin />
    <x-admin.sidebar />

    <main class="p-4 md:ml-64 pt-20">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Tambah Profile</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formProfiles" action="{{ route('profiles.update', $profiles->id_profil_yayasan) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @php
                    $fields = [
                        'logo' => [
                            'title' => 'Logo',
                            'desc' => 'Upload logo organisasi',
                            'format' => 'Format: JPEG, JPG, PNG, SVG • Max: 2MB',
                        ],
                        'favicon' => [
                            'title' => 'Favicon',
                            'desc' => 'Upload favicon website',
                            'format' => 'Format: JPEG, JPG, PNG, SVG, ICO • Max: 2MB',
                        ],
                        'background' => [
                            'title' => 'Background',
                            'desc' => 'Upload background website',
                            'format' => 'Format: JPEG, JPG, PNG, WEBP • Max: 4MB',
                        ],
                        'popup' => [
                            'title' => 'Popup',
                            'desc' => 'Upload popup (opsional)',
                            'format' => 'Format: JPEG, JPG, PNG, WEBP • Max: 4MB',
                        ],
                    ];
                @endphp

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-4">
                    <input type="hidden" name="delete_popup" id="delete_popup" value="0">

                    @foreach ($fields as $field => $config)
                        <div
                            class="group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">

                            {{-- Gambar Preview --}}
                            <div class="relative">
                                <div
                                    class="relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                    <img src="{{ !empty($profiles->$field) ? asset('storage/' . $profiles->$field) : asset('storage/img/img-placeholder.webp') }}"
                                        alt="{{ $config['title'] }}"
                                        class="object-contain w-full h-32 {{ empty($profiles->$field) ? 'opacity-0 grayscale' : '' }} transition-all duration-300"
                                        id="{{ $field }}-preview">

                                    @if (empty($profiles->$field))
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/10">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Status Badge --}}
                                <div class="absolute top-2 left-1">
                                    @if (empty($profiles->$field))
                                        <span data-status="{{ $field }}"
                                            class="block items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                            {{ $field === 'popup' ? 'Opsional' : 'Belum diunggah' }}
                                        </span>
                                    @else
                                        <span data-status="{{ $field }}"
                                            class="block items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            Sudah diunggah
                                        </span>
                                    @endif
                                </div>
                                {{-- Delete button --}}
                                <div class="absolute top-2 right-12">
                                    @if ($field === 'popup' && !empty($profiles->$field))
                                        <button type="button" onclick="deletePopupImage()"
                                            class="absolute text-white bg-red-700 hover:bg-red-100 hover:text-red-700 px-2 py-1 text-xs rounded-full transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m20.37 8.91l-1 1.73l-12.13-7l1-1.73l3.04 1.75l1.36-.37l4.33 2.5l.37 1.37zM6 19V7h5.07L18 11v8a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Upload Section --}}
                            <div class="p-6">
                                <div class="space-y-1">
                                    <div class="text-center">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $config['title'] }}
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ $config['desc'] }}</p>
                                    </div>

                                    <div class="relative">
                                        <input type="file" name="{{ $field }}"
                                            id="{{ $field }}-upload" accept="image/*"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 file-input"
                                            data-field="{{ $field }}">

                                        <div data-upload-area="{{ $field }}"
                                            class="flex items-center justify-center w-full h-12 px-4 bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-dashed border-blue-200 rounded-xl hover:from-blue-100 hover:to-purple-100 hover:border-blue-300 transition-all duration-300 cursor-pointer group">
                                            <div
                                                class="flex items-center space-x-2 text-blue-600 group-hover:text-blue-700">
                                                <svg data-upload-icon="{{ $field }}" class="w-5 h-5"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <span data-upload-text="{{ $field }}"
                                                    class="text-sm font-medium">
                                                    {{ empty($profiles->$field) ? 'Pilih file ' . strtolower($config['title']) : 'Ganti ' . strtolower($config['title']) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-file-info="{{ $field }}"
                                        class="hidden bg-blue-50 border border-blue-200 rounded-lg p-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <div>
                                                    <p data-file-name="{{ $field }}"
                                                        class="text-sm font-medium text-blue-800 truncate whitespace-nowrap overflow-hidden w-full">
                                                        {{ $field }}
                                                    </p>
                                                    </p>
                                                    <p data-file-size="{{ $field }}"
                                                        class="text-xs text-blue-600"></p>
                                                </div>
                                            </div>
                                            <button type="button" onclick="clearFile('{{ $field }}')"
                                                class="text-blue-600 hover:text-blue-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <p class="text-xs text-gray-500">{{ $config['format'] }}</p>
                                    </div>

                                    @error($field)
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
                    @endforeach

                </div>

                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    {{-- Text Inputs --}}
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama Yayasan</label>
                        <input type="text" name="nama_yayasan" value="{{ old('nama_yayasan', $profiles->nama_yayasan ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama Yayasan" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Website</label>
                        <input type="text" name="website" value="{{ old('website', $profiles->website ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Website" />
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Telepon</label>
                        <input type="text" name="telephone"
                            value="{{ old('telephone', $profiles->telephone ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Telepon" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Fax</label>
                        <input type="text" name="fax" value="{{ old('fax', $profiles->fax ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Fax" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" value="{{ old('email', $profiles->email ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Email" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900">Alamat</label>
                        <textarea name="address" id="alamat" cols="30" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan Alamat">{{ old('address', $profiles->address ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="map" class="block mb-1 text-sm font-medium text-gray-900">Embed Map</label>
                        <textarea name="map" id="map" cols="30" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Embed Map">{{ old('map', $profiles->map ?? '') }}</textarea>
                    </div>
                </div>


                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Intro Singkat</label>

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
                            <button class="ql-blockquote"></button>
                            <button class="ql-code-block"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-direction" value="rtl"></button>
                            <select class="ql-align"></select>
                        </span>

                        <span class="ql-formats">
                            <button class="ql-clean"></button>
                        </span>
                    </div>
                    <!-- Editor tampil di sini -->
                    <div id="editor" class="bg-gray-50 border rounded-t-none rounded-b-lg p-2.5 min-h-[200px]">
                        {!! old('intro', $profiles->intro ?? '') !!}
                    </div>

                    <!-- Input hidden yang akan disubmit ke backend -->
                    <input type="hidden" name="intro" id="intro">
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Meta Title</label>
                        <input type="text" name="meta_title"
                            value="{{ old('meta_title', $profiles->meta_title ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Meta Title" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Copyright</label>
                        <input type="text" name="copyright"
                            value="{{ old('copyright', $profiles->copyright ?? '') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Copyright" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Meta Description</label>
                        <textarea name="meta_description" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis meta description di sini...">{{ old('meta_description', $profiles->meta_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Meta Keyword</label>
                        <textarea name="meta_keyword" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis meta keywrod di sini...">{{ old('meta_keyword', $profiles->meta_keyword ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Tentang</label>
                    <textarea name="tentang" rows="4"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis tentang di sini...">{{ old('tentang', $profiles->tentang ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Visi</label>
                        <textarea name="visi" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis visi di sini...">{{ old('visi', $profiles->visi ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Misi</label>
                        <textarea name="misi" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis misi di sini...">{{ old('misi', $profiles->misi ?? '') }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Tujuan</label>
                        <textarea name="tujuan" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis tujuan di sini...">{{ old('tujuan', $profiles->tujuan ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Makna Logo</label>
                        <textarea name="makna_logo" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis makna logo di sini...">{{ old('makna_logo', $profiles->makna_logo ?? '') }}</textarea>
                    </div>
                </div>
                {{-- Submit --}}
                <div class="mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                        Simpan Profil
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
        const quill = new Quill("#editor", {
            theme: "snow",
            placeholder: "Ketik disini...",
            modules: {
                syntax: true,
                formula: true,
                toolbar: "#toolbar-container",
            },
        });

        // Optional: re-highlight code blocks after content change
        quill.on("text-change", function() {
            document.querySelectorAll("pre code").forEach((block) => {
                hljs.highlightElement(block);
            });
        });

        const form = document.querySelector("#formProfiles");
        form.addEventListener("submit", function() {
            const intro = document.querySelector("#intro");
            intro.value = quill.root.innerHTML;
        });

        document.addEventListener('DOMContentLoaded', function() {
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

        function deletePopupImage() {
            const input = document.getElementById('popup-upload');
            const image = document.getElementById('popup-preview');
            const badge = document.querySelector('[data-status="popup"]');
            const uploadText = document.querySelector('[data-upload-text="popup"]');
            const uploadIcon = document.querySelector('[data-upload-icon="popup"]');
            const fileInfo = document.querySelector('[data-file-info="popup"]');

            // kosongkan input
            input.value = '';

            // tandai ingin hapus
            document.getElementById('delete_popup').value = '1';

            // update preview jadi placeholder
            image.src = "{{ asset('storage/img/img-placeholder.webp') }}";
            image.classList.add('opacity-40', 'grayscale');

            // update badge
            badge.textContent = 'Akan dihapus';
            badge.className =
                'block items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200';

            // update upload
            uploadText.textContent = 'Pilih file popup';
            uploadText.className = 'text-sm font-medium';
            uploadIcon.innerHTML =
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>`;
            uploadIcon.className = 'w-5 h-5';

            // sembunyikan file info
            if (fileInfo) fileInfo.classList.add('hidden');
        }


        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</body>

</html>
