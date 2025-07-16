<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Berita dan Kegiatan</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/news-event.css') }}">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <style>
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .program-card {
            transition: all 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>
    {{-- loader --}}
    <x-loader-component />
    {{-- navbar --}}
    <x-navbar :menus="$menus" />
    {{-- contact-btt --}}
    <x-contact-btt-floating email="support@mycompany.com" phone="+62 21-1234-5678" whatsapp="6281234567890"
        size="default" :auto-hide="true" :auto-hide-delay="3000" :show-back-to-top="true" :scroll-threshold="200" />
    <main>
        <section class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto pt-20">
                <section class="">
                    <div class="">
                        <!-- Category Navigation -->
                        <div class="flex flex-wrap justify-center gap-3 md:gap-4 mb-12" data-aos="fade-up">
                            <button
                                class="category-btn active px-5 md:px-6 py-2.5 md:py-3 rounded-full bg-blue-600 text-white font-medium ring-2 ring-blue-300 transition-all duration-300 focus:outline-none"
                                data-category="all">
                                Semua Program
                            </button>
                            <button
                                class="category-btn px-5 md:px-6 py-2.5 md:py-3 rounded-full bg-white text-blue-600 font-medium ring-1 ring-gray-200 shadow-sm hover:bg-blue-50 transition-all duration-300 focus:outline-none"
                                data-category="sosial">
                                Sosial
                            </button>
                            <button
                                class="category-btn px-5 md:px-6 py-2.5 md:py-3 rounded-full bg-white text-blue-600 font-medium ring-1 ring-gray-200 shadow-sm hover:bg-blue-50 transition-all duration-300 focus:outline-none"
                                data-category="pendidikan">
                                Pendidikan
                            </button>
                            <button
                                class="category-btn px-5 md:px-6 py-2.5 md:py-3 rounded-full bg-white text-blue-600 font-medium ring-1 ring-gray-200 shadow-sm hover:bg-blue-50 transition-all duration-300 focus:outline-none"
                                data-category="riset">
                                Riset & Inovasi
                            </button>
                            <button
                                class="category-btn px-5 md:px-6 py-2.5 md:py-3 rounded-full bg-white text-blue-600 font-medium ring-1 ring-gray-200 shadow-sm hover:bg-blue-50 transition-all duration-300 focus:outline-none"
                                data-category="keagamaan">
                                Keagamaan
                            </button>
                        </div>


                        <!-- Sosial Category -->
                        <div class="category-section mb-20" data-category="sosial" data-aos="fade-up">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                <!-- Program Card 1 -->
                                <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden">
                                    <div class="h-48">
                                        <img src="{{ asset('img/program/p2.jpg') }}" alt="Program Bantuan Sosial"
                                            class="object-cover w-full h-full">
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-800 mb-3">Program Bantuan Sosial</h3>
                                        <p class="text-gray-600 mb-4">Program pemberian bantuan sosial untuk masyarakat
                                            kurang mampu di wilayah sekitar dengan fokus pada kebutuhan dasar
                                            sehari-hari.</p>
                                        <div class="space-y-2 mb-4">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-5 h-5 mr-2 text-gray-400 xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M24 14.6c0 .6-1.2 1-2.6 1.2c-.9-1.7-2.7-3-4.8-3.9c.2-.3.4-.5.6-.8h.8c3.1-.1 6 1.8 6 3.5M6.8 11H6c-3.1 0-6 1.9-6 3.6c0 .6 1.2 1 2.6 1.2c.9-1.7 2.7-3 4.8-3.9zm5.2 1c2.2 0 4-1.8 4-4s-1.8-4-4-4s-4 1.8-4 4s1.8 4 4 4m0 1c-4.1 0-8 2.6-8 5c0 2 8 2 8 2s8 0 8-2c0-2.4-3.9-5-8-5m5.7-3h.3c1.7 0 3-1.3 3-3s-1.3-3-3-3c-.5 0-.9.1-1.3.3c.8 1 1.3 2.3 1.3 3.7c0 .7-.1 1.4-.3 2M6 10h.3C6.1 9.4 6 8.7 6 8c0-1.4.5-2.7 1.3-3.7C6.9 4.1 6.5 4 6 4C4.3 4 3 5.3 3 7s1.3 3 3 3" />
                                                </svg>
                                                <span>Yayasan Sosial Indonesia</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-5 h-5 mr-2 text-gray-400 xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 15H5V8h14z" />
                                                </svg>
                                                <span>15 Januari 2025</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Sosial
                                            </span>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <!-- Program Card 2 -->
                                <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden">
                                    <div class="h-48">
                                        <img src="{{ asset('img/program/p2.jpg') }}" alt="Program Bantuan Sosial"
                                            class="object-cover w-full h-full">
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-800 mb-3">Pemberdayaan Masyarakat</h3>
                                        <p class="text-gray-600 mb-4">Program pelatihan keterampilan dan pemberdayaan
                                            ekonomi untuk meningkatkan taraf hidup masyarakat lokal.</p>
                                        <div class="space-y-2 mb-4">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <span>Koperasi Mandiri</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 5l6 6m0-6l-6 6" />
                                                </svg>
                                                <span>20 Januari 2025</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Sosial
                                            </span>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Program Card 3 -->
                                <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden">
                                    <div class="h-48">
                                        <img src="{{ asset('img/program/p2.jpg') }}" alt="Program Bantuan Sosial"
                                            class="object-cover w-full h-full">
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-800 mb-3">Program Kesehatan Masyarakat
                                        </h3>
                                        <p class="text-gray-600 mb-4">Inisiatif untuk meningkatkan kesehatan masyarakat
                                            melalui penyuluhan dan pemeriksaan kesehatan gratis.</p>
                                        <div class="space-y-2 mb-4">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <span>Puskesmas Setempat</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 5l6 6m0-6l-6 6" />
                                                </svg>
                                                <span>10 Februari 2025</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Sosial
                                            </span>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Segera
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </section>
            </div>
        </section>
    </main>
    <x-footer />

</body>

</html>
