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
    {{-- <x-loader-component /> --}}
    {{-- navbar --}}
    <x-navbar :menus="$menus" />
    {{-- contact-btt --}}
    <x-contact-btt-floating email="support@mycompany.com" phone="+62 21-1234-5678" whatsapp="6281234567890"
        size="default" :auto-hide="true" :auto-hide-delay="3000" :show-back-to-top="true" :scroll-threshold="200" />
    <main>
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto pt-20">
                <section id="sosial">
                    <x-section-header id="sosial" title="BIDANG SOSIAL" link="testing" buttonText="See More" />
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        <!-- Kartu Program di 3 kolom -->

                        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @for ($i = 0; $i < 3; $i++)
                                <!-- Program Card -->
                                <div class="program-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
                                    <!-- Gambar -->
                                    <div class="h-40 w-full overflow-hidden">
                                        <img src="{{ asset('img/program/p3.jpg') }}" alt="Peduli Sesama"
                                            class="w-full h-full object-cover" />
                                    </div>

                                    <!-- Konten Card -->
                                    <div class="flex flex-col justify-between flex-1 p-6">
                                        <!-- Konten Atas -->
                                        <div>
                                            <a href="#"
                                                class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-blue-600 transition-colors"
                                                title="Peduli Sesama Anak di Desa XXX">
                                                Peduli Sesama Anak di Desa XXX
                                            </a>

                                            <p class="text-gray-600 mb-4 text-[14px] line-clamp-4">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime
                                                repellendus dolores quisquam, eveniet corrupti mollitia libero
                                                labore cupiditate rerum nihil.
                                            </p>
                                            <div class="space-y-2 mb-4 text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path
                                                            d="M2 19h20v3H2zM12 2L2 6v2h20V6zm5 8h3v7h-3zm-6.5 0h3v7h-3zM4 10h3v7H4z" />
                                                    </svg>
                                                    <span class="">Yayasan Sosial Indonesia</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path
                                                            d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 15H5V8h14z" />
                                                    </svg>
                                                    <span>15 Januari 2025</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Konten Bawah -->
                                        <div class="flex items-center justify-between pt-4 mt-auto">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Bantuan Sosial
                                            </span>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        {{-- berita terkait --}}
                        <div class="space-y-4 lg:sticky lg:top-24">
                            <h2 class="text-lg font-semibold text-gray-800">Berita Terkait</h2>
                            @foreach ($berita_populer as $pop)
                                <a href="{{ route('berita.show', $pop->slug) }}"
                                    class="flex items-start gap-4 group hover:bg-gray-100 p-2 rounded-md transition">
                                    <img src="{{ asset('storage/' . $pop->thumbnail) }}" alt="{{ $pop->judul }}"
                                        class="w-20 h-16 object-cover rounded" />
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-700 group-hover:text-black">
                                            {{ Str::limit($pop->judul, 60) }}
                                        </h3>
                                        <p class="text-xs text-gray-500">
                                            {{ $pop->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>
