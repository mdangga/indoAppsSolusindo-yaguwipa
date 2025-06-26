<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="fixed inset-x-0 top-0 z-50 w-auto bg-transparent">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-[75px] w-auto" src="logo.png" alt="" />
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div
                class=" hidden lg:flex h-[50px] px-6 justify-center items-center rounded-[75px] bg-white-50/48 backdrop-blur-sm">
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-amber-200 transition duration-200">Beranda</a>
                    <div class="inline-flex items-center relative group">
                        <a href="#"
                            class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">Tentang
                            Kami</a>

                        <div
                            class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg py-2 opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200 min-w-[160px]">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Visi
                                & Misi</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Struktur
                                Organisasi</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Sejarah</a>
                        </div>
                    </div>
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">Program</a>
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">Kegiatan</a>
                </div>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="#"
                    class=" p-4 text-sm font-semibold text-white focus-visible:bg-gray-600 bg-gray-700 hover:bg-gray-500 rounded">Log
                    in</a>
            </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div class="fixed inset-0 z-50"></div>
            <div
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="img/LOGO_YAYASAN.png" alt="" />
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Product</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Features</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Marketplace</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                        </div>
                        <div class="py-6">
                            <a href="#"
                                class="-mx-3 block px-3 py-2.5 text-base/7 font-semibold text-gray-900 rounded-full hover:bg-gray-50">Log
                                in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- hero --}}
    <div class="relative top-0">
        {{-- Background Image --}}
        <div class="absolute inset-0 -z-10">
            <img src="{{ asset('ex.jpg') }}" alt="Hero Background" class="w-full h-full object-cover" />

            {{-- Gradient Overlay agar transisi ke putih --}}
            <div class="absolute inset-0 bg-gradient-to-b from-white/0 via-white/60 to-white"></div>
        </div>


        {{-- Isi Hero --}}
        <div class="relative px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-2xl py-24 sm:py-32 lg:py-36 text-center">
                <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                    YAYASAN GUNA WIDYA PARAMESTI
                </h1>
                <p class="mt-8 text-lg font-medium text-gray-600">
                    Yayasan ini didirikan oleh tokoh muda Indonesia sebagai bentuk kepedulian sosial terhadap
                    peningkatan kapasitas riset dan kualitas sumber daya manusia Indonesia.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#"
                        class="rounded-full px-6 py-3 text-md font-semibold text-white bg-gray-700 hover:bg-gray-500 shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        Donasi
                    </a>
                    <a href="#" class="text-sm font-semibold text-gray-900">
                        Selengkapnya <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- hero end --}}
    <div class="px-14 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                    <a href="#">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('img-placeholder.webp') }}"
                            alt="Gambar kegiatan" />
                    </a>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h5 class="text-xl font-semibold text-gray-900">
                                Kegiatan 1
                            </h5>
                            <span class="text-sm text-green-600 font-medium bg-green-100 px-2 py-1 rounded">
                                Akan datang
                            </span>
                            <!-- Untuk kegiatan yang sudah lewat, bisa diganti:
                                    <span class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">
                                        15 Juni 2025
                                    </span> -->
                        </div>
                        <p class="mb-3 text-gray-700 text-sm">
                            Kegiatan donor darah bersama PMI untuk umum, bertempat di Aula Kecamatan.
                        </p>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Detail Kegiatan
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>

</body>

</html>
