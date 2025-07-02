<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ $berita->judul }} - {{ config('app.name', 'Laravel') }}</title>
    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- navbar --}}
    <x-navbar :menus="$menus" />

    <!-- Bagian Berita yang sudah diperbaiki -->
    <div class="relative top-0 pt-32 lg:pt-40 pb-10">
        <!-- container headline -->
        <div class="relative px-6 lg:px-8 max-w-4xl mx-auto">
            <!-- judul berita -->
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                {{ $berita->judul }}
            </h1>

            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="thumbnail" class="object-cover">

            <!-- info waktu dan share -->
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center space-x-2 text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm">{{ \Carbon\Carbon::parse($berita->tanggal_publish)->diffForHumans() }}</span>
                </div>

                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Share:</span>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                        class="p-2 text-gray-500 hover:text-black transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="m13.081 10.712l-4.786-6.71a.6.6 0 0 0-.489-.252H5.28a.6.6 0 0 0-.488.948l6.127 8.59m2.162-2.576l6.127 8.59a.6.6 0 0 1-.488.948h-2.526a.6.6 0 0 1-.489-.252l-4.786-6.71m2.162-2.576l5.842-6.962m-8.004 9.538L5.077 20.25" />
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                        class="p-2 text-gray-500 hover:text-blue-800 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                        </svg>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                        class="p-2 text-gray-500 hover:text-green-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                        </svg>
                    </a>
                </div>
            </div>


            <!-- konten berita -->
            <div class="prose max-w-none">
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    {!! nl2br(e($berita->isi_berita)) !!}
                </p>

                <p class="text-gray-700 italic leading-relaxed mt-7">
                    Sumber: Mikir sendiri
                </p>
            </div>

            <div class="flex flex-wrap gap-2 mt-4">
                @foreach (explode(';', $berita->keyword) as $tag)
                    <span
                        class="px-3 py-1 text-sm bg-gray-100 text-black hover:bg-black hover:text-white cursor-default">
                        {{ trim($tag) }}
                    </span>
                @endforeach
            </div>

        </div>
    </div>
</body>

<x-footer />

</html>
