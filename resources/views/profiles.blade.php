<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">
    <title>{{ $site['yayasanProfile']->meta_title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body>
    {{-- navbar --}}
    <x-navbar :menus="$menus" />

    <div class="px-6 pt-17 lg:px-8">
        <div class="py-20">
            <!-- Baris 1: Header -->
            <div class="flex items-center justify-center my-4">
                <h1 class="text-3xl font-semibold tracking-tight text-gray-900 text-center sm:text-7xl m-0">
                    {{ $site['yayasanProfile']->company }}
                </h1>
            </div>

            <!-- Baris 2: Logo dan Teks -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center w-full max-w-5xl mx-auto">
                <!-- Logo -->
                <div class="flex justify-center">
                    <img class="h-64 md:h-96 w-auto object-contain"
                        src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Logo Yayasan">
                </div>

                <!-- Text -->
                <div class="md:col-span-2 text-gray-700 leading-relaxed text-justify">
                    <p class="text-base md:text-lg">
                        {{ $site['yayasanProfile']->tentang }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-5/6 mx-auto p-10 grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- visi -->
        <div class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 512 512"
                    fill="none">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                        d="m39.93 327.56l-4.71-8.13A24 24 0 0 1 44 286.64l86.87-50.07a16 16 0 0 1 21.89 5.86l12.71 22a16 16 0 0 1-5.86 21.85l-86.85 50.07a24.06 24.06 0 0 1-32.83-8.79" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                        d="M170.68 273.72L147.12 233a24 24 0 0 1 8.8-32.78l124.46-71.75a16 16 0 0 1 21.89 5.86l31.57 54.59a16 16 0 0 1-5.84 21.84L203.51 282.5a24 24 0 0 1-32.83-8.78m171.17-71.51l-46.51-80.43a24 24 0 0 1 8.8-32.78l93.29-53.78A24.07 24.07 0 0 1 430.27 44l46.51 80.43a24 24 0 0 1-8.8 32.79L374.69 211a24.06 24.06 0 0 1-32.84-8.79M127.59 480l96.14-207.99m48.07-15.99L368.55 448" />
                </svg>
            </div>
            <!-- Text -->
            <p class="text-center font-normal text-gray-700">
                {{ $site['yayasanProfile']->visi }}
            </p>
        </div>

        <!-- misi -->
        <div class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 24 24"
                    fill="none">
                    <path fill="currentColor"
                        d="M12 4.5a7.5 7.5 0 0 0-6.955 10.312a.5.5 0 1 1-.927.376a8.5 8.5 0 1 1 4.694 4.694a.5.5 0 0 1 .375-.927A7.5 7.5 0 1 0 12 4.5" />
                    <path fill="currentColor"
                        d="M6.5 12c0 1.339.478 2.566 1.273 3.52l-.48.48H5.77a1.5 1.5 0 0 0-1.06.44l-1.638 1.637a.75.75 0 0 0 .53 1.28h1.04v1.04a.75.75 0 0 0 1.28.53l1.637-1.638A1.5 1.5 0 0 0 8 18.23v-1.522l.48-.48A5.5 5.5 0 1 0 6.5 12M12 7.5a4.5 4.5 0 1 1-2.81 8.016l1.793-1.793a2 2 0 1 0-.707-.707l-1.792 1.793A4.5 4.5 0 0 1 12 7.5m-6.583 9.646A.5.5 0 0 1 5.771 17H7v1.229a.5.5 0 0 1-.147.353l-1.21 1.21v-.935a.5.5 0 0 0-.5-.5h-.936z" />
                </svg>
            </div>
            <p class="text-center font-normal text-gray-700">
                {{ $site['yayasanProfile']->misi }}
            </p>
        </div>

        <!-- CARD 3 -->
        <div class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 24 24"
                    fill="none">
                    <path fill="currentColor"
                        d="M24 7a1.51 1.51 0 0 0-.66-1.24l-7-4.76a1.48 1.48 0 0 0-1.67 0L8.82 5.31a.51.51 0 0 1-.6 0L2.39 1A1.5 1.5 0 0 0 0 2.25V17a1.51 1.51 0 0 0 .66 1.24l7 4.76a1.48 1.48 0 0 0 1.67 0l5.83-4.29a.51.51 0 0 1 .6 0L21.61 23a1.55 1.55 0 0 0 .89.29a1.49 1.49 0 0 0 1.5-1.5Zm-14.5.53a.48.48 0 0 1 .2-.4l4.4-3.29a.25.25 0 0 1 .26 0a.25.25 0 0 1 .14.16v12.47a.48.48 0 0 1-.2.4l-4.4 3.29a.25.25 0 0 1-.26 0A.25.25 0 0 1 9.5 20ZM2 3.73a.25.25 0 0 1 .14-.23a.25.25 0 0 1 .26 0l4.9 3.61a.51.51 0 0 1 .2.4V20a.25.25 0 0 1-.13.22a.27.27 0 0 1-.26 0l-4.89-3.35a.49.49 0 0 1-.22-.41Zm20 16.54a.25.25 0 0 1-.14.23a.25.25 0 0 1-.26 0l-4.9-3.58a.51.51 0 0 1-.2-.4V4a.25.25 0 0 1 .13-.22a.27.27 0 0 1 .26 0l4.89 3.33a.49.49 0 0 1 .22.41Z" />
                </svg>
            </div>
            <p class="text-center font-normal text-gray-700">
                {{ $site['yayasanProfile']->tujuan }}
            </p>
        </div>

        <!-- Makna Logo -->
        <div class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 24 24"
                    fill="none">
                    <path fill="currentColor"
                        d="M11 17h2v-6h-2zm1-8q.425 0 .713-.288T13 8t-.288-.712T12 7t-.712.288T11 8t.288.713T12 9m0 13q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
                </svg>
            </div>
            <p class="text-center font-normal text-gray-700">
                {{ $site['yayasanProfile']->makna_logo }}
            </p>
        </div>

    </div>
</body>
<x-footer />


</html>
