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

            <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Upload Files --}}
                <div class="grid md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Logo</label>
                        <input type="file" name="logo"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none " />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Favicon</label>
                        <input type="file" name="favicon"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none " />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Background</label>
                        <input type="file" name="background"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none " />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Popup</label>
                        <input type="file" name="popup"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none " />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    {{-- Text Inputs --}}
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama Perusahaan</label>
                        <input type="text" name="company" value="{{ old('company') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama Perusahaan" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Website</label>
                        <input type="text" name="website" value="{{ old('website') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Website" />
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Telepon</label>
                        <input type="text" name="telephone" value="{{ old('telephone') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Telepon" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Fax</label>
                        <input type="text" name="fax" value="{{ old('fax') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Fax" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Email" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Embed Map"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="map" class="block mb-1 text-sm font-medium text-gray-900">Embed Map</label>
                        <textarea name="map" id="map" cols="30" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Embed Map"></textarea>
                    </div>
                </div>


                <div class="mb-4">
                    <label class="block font-semibold mb-1">Intro Singkat</label>

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
                    <input type="hidden" name="intro" id="intro">

                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Meta Title" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Copyright</label>
                        <input type="text" name="copyright" value="{{ old('copyright') }}"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Copyright" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Meta Description</label>
                        <textarea name="meta_description" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis meta description di sini...">{{ old('meta_description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Meta Keyword</label>
                        <textarea name="meta_keyword" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis meta keywrod di sini...">{{ old('meta_description') }}</textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Tentang</label>
                    <textarea name="tentang" rows="4"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis tentang di sini...">{{ old('tentang') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Visi</label>
                        <textarea name="visi" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis visi di sini...">{{ old('visi') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Misi</label>
                        <textarea name="misi" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis misi di sini...">{{ old('misi') }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4 items-start">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Tujuan</label>
                        <textarea name="tujuan" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis tujuan di sini...">{{ old('tujuan') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Makna Logo</label>
                        <textarea name="makna_logo" rows="4"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis makna logo di sini...">{{ old('makna_logo') }}</textarea>
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
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tulis Intro disini...',
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
