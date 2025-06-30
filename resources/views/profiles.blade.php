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
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body>
    <header class="absolute w-full z-50">
        <!-- Logo dan Login Button -->
        <div class="w-full bg-transparent p-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
                <!-- Logo -->
                <div class="flex justify-start">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-[75px] w-auto" src="img/logo.png" alt="Company Logo" />
                    </a>
                </div>

                <div class="hidden lg:block"></div>

                <!-- tombol Login -->
                <div class="hidden justify-end items-center lg:flex">
                    <a href="{{ route('login') }}"
                        class="bg-blue-100 text-sm font-semibold text-gray-900 rounded-[50px] px-6 py-3.5 hover:bg-blue-200 transition">
                        Log in
                    </a>
                </div>

                <!-- tombol menu -->
                <div class="flex lg:hidden justify-end">
                    <button type="button" id="mobile-menu-button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- fixed navbar -->
        <nav class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
            <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/5 backdrop-blur-sm">
                <div class="flex gap-x-12">
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-amber-200 transition duration-200">
                        Beranda
                    </a>
                    <div class="inline-flex items-center relative group">
                        <a href="#"
                            class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                            Tentang Kami
                        </a>
                        <div
                            class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg py-2 opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200 min-w-[160px]">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100 transform translate-x-0.5">Visi
                                &
                                Misi</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Struktur
                                Organisasi</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Sejarah</a>
                        </div>
                    </div>
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                        Program
                    </a>
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                        Kegiatan
                    </a>
                </div>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="lg:hidden fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-black/25"></div>
            <div
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="img/LOGO_YAYASAN.png" alt="" />
                    </a>
                    <button type="button" id="close-menu-button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Beranda</a>
                            <a href="#test"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Tentang
                                Kami</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Program</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Kegiatan</a>
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

    <div class="px-6 pt-17 lg:px-8">
        <div class="py-20">
            <!-- Baris 1: Header -->
            <div class="flex items-center justify-center my-4">
                <h1 class="text-3xl font-semibold tracking-tight text-gray-900 text-center sm:text-7xl m-0">
                    Tentang Yaguwipa
                </h1>
            </div>

            <!-- Baris 2: Logo dan Teks -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center w-full max-w-5xl mx-auto">
                <!-- Logo -->
                <div class="flex justify-center">
                    <img class="h-64 md:h-96 w-auto object-contain" src="img/logo.png" alt="Company Logo">
                </div>

                <!-- Text -->
                <div class="md:col-span-2 text-gray-700 leading-relaxed text-justify">
                    <p class="text-base md:text-lg">
                        Yayasan Guna Widya Paramesthi adalah yayasan yang bergerak di bidang riset, pendidikan, sosial
                        kemanusiaan, dan keagamaan dengan SK. KEMENKUMHAM RI No. AHU-0017480.AH.01.04 Tahun 2018 dan
                        NPWP. 86.729.551.1-903.000
                        Yayasan ini didirikan oleh tokoh muda Indonesia sebagai bentuk kepedulian sosial terhadap
                        peningkatan kapasitas riset dan kualitas sumber daya manusia Indonesia. Untuk mencapai visi,
                        misi dan tujuannya, Yayasan Guna Widya Paramesthi mendirikan Denpasar Institute sebagai Lembaga
                        Riset & Pengembangan SDM.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-5/6 mx-auto p-10 grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- CARD -->
        <div
            class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <!-- Ikon -->
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 512 512"
                    fill="none">
                    <!-- SVG path tetap -->
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                        d="m39.93 327.56l-4.71-8.13A24 24 0 0 1 44 286.64l86.87-50.07a16 16 0 0 1 21.89 5.86l12.71 22a16 16 0 0 1-5.86 21.85l-86.85 50.07a24.06 24.06 0 0 1-32.83-8.79" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                        d="M170.68 273.72L147.12 233a24 24 0 0 1 8.8-32.78l124.46-71.75a16 16 0 0 1 21.89 5.86l31.57 54.59a16 16 0 0 1-5.84 21.84L203.51 282.5a24 24 0 0 1-32.83-8.78m171.17-71.51l-46.51-80.43a24 24 0 0 1 8.8-32.78l93.29-53.78A24.07 24.07 0 0 1 430.27 44l46.51 80.43a24 24 0 0 1-8.8 32.79L374.69 211a24.06 24.06 0 0 1-32.84-8.79M127.59 480l96.14-207.99m48.07-15.99L368.55 448" />
                </svg>
            </div>
            <!-- Text -->
            <p class="text-center font-normal text-gray-700">
                Menjadi lembaga sosial yang mampu menghasilkan riset dan menyelenggarakan pendidikan sesuai kebutuhan
                masyarakat dan industri.
            </p>
        </div>

        <!-- CARD 2 -->
        <div
            class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
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
                Mengembangkan riset, pendidikan, dan pelatihan berbasis data dan teknologi informasi untuk memenuhi
                kebutuhan industri dan masyarakat, serta meningkatkan kualitas SDM melalui kegiatan yang mencakup aspek
                sosial, kemanusiaan, dan keagamaan.
            </p>
        </div>

        <!-- CARD 3 -->
        <div
            class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 24 24"
                    fill="none">
                    <path fill="currentColor"
                        d="M24 7a1.51 1.51 0 0 0-.66-1.24l-7-4.76a1.48 1.48 0 0 0-1.67 0L8.82 5.31a.51.51 0 0 1-.6 0L2.39 1A1.5 1.5 0 0 0 0 2.25V17a1.51 1.51 0 0 0 .66 1.24l7 4.76a1.48 1.48 0 0 0 1.67 0l5.83-4.29a.51.51 0 0 1 .6 0L21.61 23a1.55 1.55 0 0 0 .89.29a1.49 1.49 0 0 0 1.5-1.5Zm-14.5.53a.48.48 0 0 1 .2-.4l4.4-3.29a.25.25 0 0 1 .26 0a.25.25 0 0 1 .14.16v12.47a.48.48 0 0 1-.2.4l-4.4 3.29a.25.25 0 0 1-.26 0A.25.25 0 0 1 9.5 20ZM2 3.73a.25.25 0 0 1 .14-.23a.25.25 0 0 1 .26 0l4.9 3.61a.51.51 0 0 1 .2.4V20a.25.25 0 0 1-.13.22a.27.27 0 0 1-.26 0l-4.89-3.35a.49.49 0 0 1-.22-.41Zm20 16.54a.25.25 0 0 1-.14.23a.25.25 0 0 1-.26 0l-4.9-3.58a.51.51 0 0 1-.2-.4V4a.25.25 0 0 1 .13-.22a.27.27 0 0 1 .26 0l4.89 3.33a.49.49 0 0 1 .22.41Z" />
                </svg>
            </div>
            <p class="text-center font-normal text-gray-700">
                Mendirikan lembaga riset, pendidikan, pelatihan, dan badan amal untuk pengembangan SDM, pemberian
                beasiswa, serta penyelenggaraan program riset dan kegiatan akademik guna meningkatkan kualitas dan
                solusi bagi masyarakat.
            </p>
        </div>

        <!-- CARD 4 -->
        <div
            class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm p-6 pt-16">
            <div class="absolute -top-6 bg-white rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800" viewBox="0 0 24 24"
                    fill="none">
                    <path fill="currentColor"
                        d="M11 17h2v-6h-2zm1-8q.425 0 .713-.288T13 8t-.288-.712T12 7t-.712.288T11 8t.288.713T12 9m0 13q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
                </svg>
            </div>
            <p class="text-center font-normal text-gray-700">
                Asta Mandala dengan warna putih, kuning, biru, ungu, serta simbol teratai, bintang, daun, dan padi
                melambangkan Yayasan Guna Widya Paramesthi sebagai lembaga yang mendorong kebajikan, kehormatan,
                keseimbangan, dan kemajuan dalam pelayanan masyarakat.
            </p>
        </div>

    </div>


</body>

<footer class="bg-gray-900 text-white py-10 px-6">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kiri: Info Yayasan -->
        <div>
            <h2 class="text-xl font-bold uppercase">YAYASAN</h2>
            <h2 class="text-xl font-bold uppercase mb-4">GUNA WIDYA PARAMESTHI</h2>

            <p class="mb-2">
                <span class="font-semibold">Alamat :</span>
                JLN. GANETRI IV NO. 4 DPS 80237 BALI
            </p>
            <p class="mb-2">
                <span class="font-semibold">No Telepon :</span>
                (+62) 87865309966
            </p>
            <p class="mb-4">
                <span class="font-semibold">Email :</span>
                info@yaguwipa.org
            </p>

            <p class="mb-2 font-semibold">Follow Us :</p>
            <div class="flex space-x-4">
                <!-- YouTube -->
                <a href="#" class="text-white hover:text-red-500" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m10 15l5.19-3L10 9zm11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83c-.25.9-.83 1.48-1.73 1.73c-.47.13-1.33.22-2.65.28c-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44c-.9-.25-1.48-.83-1.73-1.73c-.13-.47-.22-1.1-.28-1.9c-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83c.25-.9.83-1.48 1.73-1.73c.47-.13 1.33-.22 2.65-.28c1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44c.9.25 1.48.83 1.73 1.73" />
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="text-white hover:text-blue-500" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="text-white hover:text-pink-400" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M13.028 2c1.125.003 1.696.009 2.189.023l.194.007c.224.008.445.018.712.03c1.064.05 1.79.218 2.427.465c.66.254 1.216.598 1.772 1.153a4.9 4.9 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428c.012.266.022.487.03.712l.006.194c.015.492.021 1.063.023 2.188l.001.746v1.31a79 79 0 0 1-.023 2.188l-.006.194c-.008.225-.018.446-.03.712c-.05 1.065-.22 1.79-.466 2.428a4.9 4.9 0 0 1-1.153 1.772a4.9 4.9 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465l-.712.03l-.194.006c-.493.014-1.064.021-2.189.023l-.746.001h-1.309a78 78 0 0 1-2.189-.023l-.194-.006a63 63 0 0 1-.712-.031c-1.064-.05-1.79-.218-2.428-.465a4.9 4.9 0 0 1-1.771-1.153a4.9 4.9 0 0 1-1.154-1.772c-.247-.637-.415-1.363-.465-2.428l-.03-.712l-.005-.194A79 79 0 0 1 2 13.028v-2.056a79 79 0 0 1 .022-2.188l.007-.194c.008-.225.018-.446.03-.712c.05-1.065.218-1.79.465-2.428A4.9 4.9 0 0 1 3.68 3.678a4.9 4.9 0 0 1 1.77-1.153c.638-.247 1.363-.415 2.428-.465c.266-.012.488-.022.712-.03l.194-.006a79 79 0 0 1 2.188-.023zM12 7a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 2a3 3 0 1 1 .001 6a3 3 0 0 1 0-6m5.25-3.5a1.25 1.25 0 0 0 0 2.5a1.25 1.25 0 0 0 0-2.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Kanan: Kosongkan -->
        <div id="test" class="relative group max-w-full overflow-hidden">
            {{-- <div
                class="absolute inset-0 bg-gradient-to-br from-black/70 via-gray-800/60 to-black/70 rounded-md z-10 transition-opacity duration-300 group-hover:opacity-0 pointer-events-none">
            </div> --}}

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2828.1566751622727!2d115.23003191579483!3d-8.638782329040929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f8661ef31cd%3A0x663c45c04ca4cfb3!2sPT.%20Indo%20Apps%20Solusindo%20-%20Apps%20%26%20Web%20Development%20%7C%20Software%20Services%20%7C%20Seo%20Services%20di%20Bali%20%7C%20Domain%20%26%20Hosting%20%7C%20IoT!5e0!3m2!1sid!2sid!4v1750918670426!5m2!1sid!2sid"
                class="rounded-md w-full h-[250px] border-0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>
</footer>

</html>
