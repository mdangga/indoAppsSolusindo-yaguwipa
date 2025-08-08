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
    @vite(['resources/css/app.css', 'resources/js/beranda.js', 'resources/js/AOS.js'])
    {{-- custom styling --}}
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <style>
        .hover\:scale-102:hover {
            transform: scale(1.02);
        }

        .modal-show {
            display: flex !important;
            opacity: 1;
        }

        .modal-hide {
            opacity: 0;
        }

        .card-selected {
            border-color: #4f46e5 !important;
            background-color: #eef2ff !important;
        }

        .card-selected.anonim-selected {
            border-color: #4f46e5 !important;
            background-color: #eef2ff !important;
        }

        .card-selected.donatur-selected {
            border-color: #059669 !important;
            background-color: #ecfdf5 !important;
        }
    </style>
</head>

<body>
    {{-- loader --}}
    <x-loader-component />
    {{-- pop-up --}}
    @if ($site['yayasanProfile']->popup)
        <x-pop-up image-src="{{ $site['yayasanProfile']->popup }}" image-alt="Welcome Image" />
    @endif

    {{-- navbar --}}
    <x-navbar :menus="$menus" />
    {{-- floating button --}}
    <x-contact-btt-floating size="default" :auto-hide="true" :auto-hide-delay="3000" :show-back-to-top="true" :scroll-threshold="200" />
    <main>
        {{-- hero --}}
        <div class="relative flex items-center justify-center h-screen">
            {{-- Background Image --}}
            <div class="absolute inset-0 -z-10">
                <img src="{{ asset('storage/' . $site['yayasanProfile']->background) }}" alt="Hero Background"
                    class="w-full h-full object-cover brightness-75 grayscale-25" />

                {{-- Gradient Overlay agar transisi ke putih --}}
                <div class="absolute inset-0 bg-gradient-to-b from-white/0 via-white/70 to-white"></div>
            </div>

            {{-- Isi Hero --}}
            <div class="relative px-6 pt-14 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                        {{ $site['yayasanProfile']->nama_yayasan }}
                    </h1>
                    <p class="mt-8 text-lg font-medium text-gray-600">
                        {!! str_replace(['<p>', '</p>'], '', $site['yayasanProfile']->intro) !!}
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('form.donasi') }}"
                            class="rounded-full px-6 py-3 text-md font-semibold text-white bg-gray-700 hover:bg-gray-500 shadow-sm focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-gray-600 cursor-pointer">
                            Donasi
                        </a>
                        <a href="#berita-kegiatan"
                            class="group relative text-sm font-semibold text-gray-700 inline-flex justify-center items-center hover:text-gray-900 transition-colors duration-500">
                            Selengkapnya
                            <svg class="ml-2 w-4 h-4 transition-all duration-300 group-hover:scale-x-125 origin-left"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-amber-300 transition-all duration-500 group-hover:w-full"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- hero end --}}

        {{-- berita berita --}}
        <section class="px-4 sm:px-6 lg:px-12 py-16 ">
            <div class="max-w-7xl mx-auto">
                <!-- Header: Judul di kiri dan tombol di kanan -->
                <x-section-header id="berita-kegiatan" title="BERITA DAN KEGIATAN" link="beranda.berita"
                    buttonText="See More" />

                <!-- Berita dan Kegiatan -->
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-6" data-aos="fade-up">
                    <!-- Kolom Berita (3 kolom) -->
                    <div class="xl:col-span-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
                        @forelse ($berita as $item)
                            <x-berita :item="$item" />
                        @empty
                            <div class="relative w-full h-64 col-span-4"> <!-- pastikan parent relative -->
                                <div class="absolute inset-0 flex items-center justify-center bg-gray-100/50">
                                    <p class="text-gray-500 text-center">Belum ada gambar di galeri.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        {{-- end berita --}}

        {{-- galleri --}}
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <!-- Header: Judul di kiri dan tombol di kanan -->
                <x-section-header id="gallery" title="GALLERY" link="beranda.gallery" buttonText="See More" />

                <div id="gallery" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-[500px] overflow-hidden rounded-xl md:h-[32vw]">
                        @forelse ($gallery->take(5) as $index => $item)
                            <div class="hidden duration-700 ease-in-out"
                                data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $item->link) }}" alt="{{ $item->judul }}"
                                    loading="lazy"
                                    class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                            </div>
                        @empty
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                <div
                                    class="absolute inset-0 flex items-center justify-center w-full h-full bg-gray-100/50">
                                    <p class="text-gray-500 text-center">Belum ada gambar di galeri.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if ($gallery->count() > 1)
                        <div
                            class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            @forelse ($gallery->take(5) as $inex => $item)
                                <button type="button" class="w-[6px] h-[6px] rounded-full"
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"
                                    data-carousel-slide-to="{{ $index }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- galleri end --}}

        {{-- lembaga --}}
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-center pb-5 text-4xl font-semibold text-gray-900">
                    LEMBAGA TERKAIT
                </h1>
                <div class="mx-auto mt-10 overflow-hidden logo-container">
                    <div class="logo-scroll">
                        <div class="logo-set">
                            @foreach ($site['lembaga'] as $logo)
                                <div class="logo-item">
                                    <a href="{{ $logo['website'] }}" target="_blank" rel="noopener noreferrer"
                                        class="hover:opacity-75 transition-opacity duration-200">
                                        <img class="max-h-24 w-auto object-contain"
                                            src="{{ asset('storage/' . $logo['image_path']) }}"
                                            alt="{{ $logo['nama'] }}" width="158" height="48" />
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="logo-set">
                            @foreach ($site['lembaga'] as $logo)
                                <div class="logo-item">
                                    <a href="{{ $logo['website'] }}" target="_blank" rel="noopener noreferrer"
                                        class="hover:opacity-75 transition-opacity duration-200">
                                        <img class="max-h-24 w-auto object-contain"
                                            src="{{ asset('storage/' . $logo['image_path']) }}"
                                            alt="{{ $logo['nama'] }}" width="158" height="48" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- end lembaga --}}
    <x-footer />
</body>

</html>
