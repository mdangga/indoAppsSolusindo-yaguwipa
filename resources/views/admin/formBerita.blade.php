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
    {{-- Quill Snow Theme --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    {{-- Highlight.js Theme --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />

    {{-- KaTeX CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

    <style>
        body {
            font-family: sans-serif;
            background: #f3f4f6;
            padding: 20px;
        }

        #editor {
            height: 300px;
            background: #fff;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .ql-toolbar {
            margin-bottom: 10px;
        }

        pre {
            background: #282c34;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200    ">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200      ">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap  ">Flowbite</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300  "
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm    "
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900  " role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate  " role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   d   "
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   d   "
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   d   "
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   d   "
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0    "
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white  ">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
                        <span
                            class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full    ">Pro</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full    ">3</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg   hover:bg-gray-100   group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75   group-hover:text-gray-900  "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                            <path
                                d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                            <path
                                d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="p-4 md:ml-64 pt-20">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded p-6">
            <h2 class="text-2xl font-semibold mb-4">Tambah Berita</h2>

            @if (session('message'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @php
                $isEdit = isset($berita);
            @endphp

            <form action="{{ $isEdit ? route('berita.update', $berita->id_berita) : route('berita.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="judul" class="block font-semibold">Judul</label>
                    <input type="text" name="judul" id="judul" class="w-full border rounded px-3 py-2"
                        value="{{ old('judul', $berita->judul ?? '') }}" required>
                    @error('judul')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="meta_title" class="block font-semibold">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="w-full border rounded px-3 py-2"
                        value="{{ old('meta_title', $berita->meta_title ?? '') }}" required>
                    @error('meta_title')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="meta_description" class="block font-semibold">Meta Description</label>
                    <input type="text" name="meta_description" id="meta_description"
                        class="w-full border rounded px-3 py-2"
                        value="{{ old('meta_description', $berita->meta_description ?? '') }}" required>
                    @error('meta_description')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="slug" class="block font-semibold">Slug</label>
                    <input type="text" name="slug" id="slug" class="w-full border rounded px-3 py-2"
                        value="{{ old('slug', $berita->slug ?? '') }}" required>
                    @error('slug')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Isi Berita</label>

                    {{-- toolbar --}}
                    <div id="toolbar-container">
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
                    <div id="editor" class="bg-white border rounded h-60 overflow-y-auto">
                        {!! old('isi_berita', $berita->isi_berita ?? '') !!}
                    </div>

                    <!-- Input hidden yang akan disubmit ke backend -->
                    <input type="hidden" name="isi_berita" id="isi_berita">
                    @error('isi_berita')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                @if (!empty($berita->thumbnail))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Thumbnail lama"
                            class="w-40 h-auto rounded shadow">
                    </div>
                @endif
                <div class="mb-4">
                    <label for="thumbnail" class="block font-semibold">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="w-full border rounded px-3 py-2">
                    @error('thumbnail')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="keyword" class="block font-semibold">Keyword</label>
                    <input type="text" name="keyword" id="keyword" class="w-full border rounded px-3 py-2"
                        value="{{ old('keyword', $berita->keyword ?? '') }}">
                    @error('keyword')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_publish" class="block font-semibold">Tanggal Publish</label>
                    <input type="datetime-local" name="tanggal_publish" id="tanggal_publish"
                        class="w-full border rounded px-3 py-2"
                        value="{{ old('tanggal_publish', $berita->tanggal_publish ?? '') }}">
                    @error('tanggal_publish')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="w-full border rounded px-3 py-2">
                        <option value="show" {{ old('status', $berita->status ?? '') == 'show' ? 'selected' : '' }}>
                            Show</option>
                        <option value="hide" {{ old('status', $berita->status ?? '') == 'hide' ? 'selected' : '' }}>
                            Hide</option>
                    </select>
                    @error('status')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="id_kategori_news_event" class="block font-semibold">Kategori</label>
                    <select name="id_kategori_news_event" id="id_kategori_news_event"
                        class="w-full border rounded px-3 py-2" required>
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

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
            </form>
        </div>
    </main>
    {{-- Scripts --}}
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
