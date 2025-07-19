<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda</title>
    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/AOS.js'])
    {{-- custom styling --}}
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>


<body>
    {{-- loader --}}
    <x-loader-component />
    {{-- navbar --}}
    <x-navbar :menus="$menus" />
    {{-- floating button --}}
    <x-contact-btt-floating email="{{ $site['yayasanProfile']->email }}"
        phone="{{ $site['yayasanProfile']->telephone }}" size="default" :auto-hide="true" :auto-hide-delay="3000"
        :show-back-to-top="true" :scroll-threshold="200" />
    <main>
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <x-header-page :title="Str::title($kategori->nama)"
                    description="Berbagai program kami hadir sebagai bentuk komitmen dalam memberikan kontribusi positif bagi masyarakat di berbagai bidang." />
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($kategori->program as $prog)
                        <x-program-card :program="$prog" />
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-24 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4 text-gray-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.75 9.75h4.5v4.5h-4.5v-4.5zM3.75 3.75h16.5v16.5H3.75V3.75z" />
                            </svg>
                            <p class="text-lg font-medium">Program belum tersedia</p>
                            <p class="text-sm text-gray-400 mt-1">Program dalam kategori ini akan ditampilkan di sini
                                jika sudah tersedia.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>
