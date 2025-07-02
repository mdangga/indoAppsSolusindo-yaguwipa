<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda</title>
    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- custom styling --}}
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body>
    {{-- navbar --}}
    <x-navbar :menus="$menus" />

    {{-- hero --}}
    <div class="relative top-0">
        {{-- Background Image --}}
        <div class="absolute inset-0 -z-10">
            <img src="{{ asset('img/ex.jpg') }}" alt="Hero Background"
                class="w-full h-full object-cover grayscale-25" />

            {{-- Gradient Overlay agar transisi ke putih --}}
            <div class="absolute inset-0 bg-gradient-to-b from-white/0 via-white/70 to-white"></div>
        </div>

        {{-- Isi Hero --}}
        <div class="relative px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-2xl py-24 sm:py-32 lg:py-36 text-center">
                <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                    YAYASAN GUNA WIDYA PARAMESTHI
                </h1>
                <p class="mt-8 text-lg font-medium text-gray-600">
                    Yayasan ini didirikan oleh tokoh muda Indonesia sebagai bentuk kepedulian sosial terhadap
                    peningkatan kapasitas riset dan kualitas sumber daya manusia Indonesia.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#"
                        class="rounded-full px-6 py-3 text-md font-semibold text-white bg-gray-700 hover:bg-gray-500 shadow-sm focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        Donasi
                    </a>
                    <a href="#berita-kegiatan" class="text-sm font-semibold text-gray-900">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- hero end --}}

    {{-- berita berita --}}
    <div class="px-4 sm:px-6 lg:px-14 py-20">
        <!-- Header: Judul di kiri dan tombol di kanan -->
        <x-section-header id="berita-kegiatan" title="BERITA DAN KEGIATAN" link="/berita-dan-kegiatan"
            buttonText="See More" />

        <!-- Berita dan Kegiatan -->
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6" data-aos="fade-up">
            <!-- Kolom Berita (3 kolom) -->
            <div class="xl:col-span-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                @forelse ($berita as $item)
                    <x-berita :item="$item" />
                @empty
                    <div
                        class="col-span-full bg-white border border-gray-200 rounded-lg shadow-sm p-6 flex items-center justify-center h-full">
                        <p class="text-sm text-gray-500">Belum ada berita yang ditambahkan.</p>
                    </div>
                @endforelse

            </div>

            <!-- Kolom Kegiatan (1 kolom) -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 h-fit">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Kegiatan</h2>

                <div class="space-y-4 relative">
                    <!-- Event 1 - Upcoming -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Tech Conference 2025</h3>
                                <span class="text-sm text-gray-500">Jan 15</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Annual technology conference featuring the latest
                                innovations in AI and web development</p>
                        </div>
                    </div>

                    <!-- Event 2 - In Progress -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Product Launch Workshop</h3>
                                <span class="text-sm text-gray-500">Jan 8</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Lorem, ipsum dolor sit amet consectetur adipisicing
                                elit.
                                Laudantium, atque.</p>
                        </div>
                    </div>

                    <!-- Event 3 - Completed -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Design Thinking Seminar</h3>
                                <span class="text-sm text-gray-500">Dec 28</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Completed seminar on user-centered design principles
                                and
                                methodologies</p>
                        </div>
                    </div>

                    <!-- Event 4 - Completed with Overlay -->
                    <div class="flex items-start space-x-4 relative">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Design Thinking Seminar</h3>
                                <span class="text-sm text-gray-500">Dec 28</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit.
                                Unde, accusantium.</p>
                        </div>

                        <!-- Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-transparent via-white/80 to-white rounded-lg pointer-events-none">
                        </div>
                    </div>
                </div>
            </div>
            {{-- end kegiatan --}}
        </div>
    </div>
    {{-- end berita --}}

    {{-- galleri --}}
    <div class="px-4 sm:px-6 lg:px-14 py-20">
        <!-- Header: Judul di kiri dan tombol di kanan -->
        <x-section-header id="gallery" title="GALLERY" link="/gallery" buttonText="See More" />

        <div id="gallery" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[10px] overflow-hidden rounded-lg md:h-[32vw]">
                @forelse ($gallery->take(5) as $index => $item)
                    <!-- Item {{ $index + 1 }} -->
                    <div class="hidden duration-700 ease-in-out"
                        data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $item->link) }}" alt="{{ $item->judul }}" loading="lazy"
                            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    </div>
                @empty
                    <!-- Default item when no gallery items -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <div
                            class="absolute block w-full h-full bg-gray-200 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 items-center justify-center">
                            <p class="text-gray-500">Belum ada gambar di galeri.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Indicators (optional) -->
            @if ($gallery->count() > 1)
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
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
    {{-- galleri end --}}

    {{-- lembaga --}}
    <div class="bg-white py-15 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h1 class="text-center pb-5 text-4xl font-semibold text-gray-900">
                LEMBAGA TERKAIT
            </h1>
            <div class="mx-auto mt-10 max-w-6xl overflow-hidden logo-container">
                <div class="logo-scroll">
                    <!-- First set of logos -->
                    <div class="logo-set">
                        @foreach ([['src' => 'pt-indo-apps-solusindo.png', 'alt' => 'PT Indo Apps Solusindo', 'link' => 'https://indoapps.id'], ['src' => 'denpasar-institute.png', 'alt' => 'Denpasar Institute', 'link' => 'https://denpasarinstitute.ac.id'], ['src' => 'gcom.png', 'alt' => 'GCOM', 'link' => '#'], ['src' => 'indo-berkah-konstruksi.png', 'alt' => 'Indo Berkah Konstruksi', 'link' => '#'], ['src' => 'indo-consulting.png', 'alt' => 'Indo Consulting', 'link' => '#'], ['src' => 'latifaba.png', 'alt' => 'Latifaba', 'link' => 'https://www.latifaba.com/'], ['src' => 'nyaman-care.png', 'alt' => 'Nyaman Care', 'link' => '#'], ['src' => 'penerbit-yaguwipa.png', 'alt' => 'Penerbit Yaguwipa', 'link' => 'https://www.penerbityaguwipa.id/'], ['src' => 'robotic.png', 'alt' => 'Robotic', 'link' => '#'], ['src' => 'teknika-solusinda.png', 'alt' => 'Teknika Solusinda', 'link' => '#']] as $logo)
                            <div class="logo-item">
                                <a href="{{ $logo['link'] }}" target="_blank" rel="noopener noreferrer"
                                    class="hover:opacity-75 transition-opacity duration-200">
                                    <img class="max-h-32 w-auto object-contain"
                                        src="{{ asset('img/lembaga-logo/' . $logo['src']) }}"
                                        alt="{{ $logo['alt'] }}" width="158" height="48" />
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Duplicate set for infinite scroll -->
                    <div class="logo-set">
                        @foreach ([['src' => 'pt-indo-apps-solusindo.png', 'alt' => 'PT Indo Apps Solusindo', 'link' => 'https://indoapps.id'], ['src' => 'denpasar-institute.png', 'alt' => 'Denpasar Institute', 'link' => 'https://denpasarinstitute.ac.id'], ['src' => 'gcom.png', 'alt' => 'GCOM', 'link' => '#'], ['src' => 'indo-berkah-konstruksi.png', 'alt' => 'Indo Berkah Konstruksi', 'link' => '#'], ['src' => 'indo-consulting.png', 'alt' => 'Indo Consulting', 'link' => '#'], ['src' => 'latifaba.png', 'alt' => 'Latifaba', 'link' => 'https://www.latifaba.com/'], ['src' => 'nyaman-care.png', 'alt' => 'Nyaman Care', 'link' => '#'], ['src' => 'penerbit-yaguwipa.png', 'alt' => 'Penerbit Yaguwipa', 'link' => 'https://www.penerbityaguwipa.id/'], ['src' => 'robotic.png', 'alt' => 'Robotic', 'link' => '#'], ['src' => 'teknika-solusinda.png', 'alt' => 'Teknika Solusinda', 'link' => '#']] as $logo)
                            <div class="logo-item">
                                <a href="{{ $logo['link'] }}" target="_blank" rel="noopener noreferrer"
                                    class="hover:opacity-75 transition-opacity duration-200">
                                    <img class="max-h-32 w-auto object-contain"
                                        src="{{ asset('img/lembaga-logo/' . $logo['src']) }}"
                                        alt="{{ $logo['alt'] }}" width="158" height="48" />
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            {{-- <div class="mx-auto mt-10 max-w-6xl overflow-hidden logo-container">
                <div class="logo-scroll">
                    @foreach ([['src' => 'pt-indo-apps-solusindo.png', 'alt' => 'PT Indo Apps Solusindo', 'link' => 'https://indoapps.id'], ['src' => 'denpasar-institute.png', 'alt' => 'Denpasar Institute', 'link' => 'https://denpasarinstitute.ac.id'], ['src' => 'gcom.png', 'alt' => 'GCOM', 'link' => '#'], ['src' => 'indo-berkah-konstruksi.png', 'alt' => 'Indo Berkah Konstruksi', 'link' => '#'], ['src' => 'indo-consulting.png', 'alt' => 'Indo Consulting', 'link' => '#'], ['src' => 'latifaba.png', 'alt' => 'Latifaba', 'link' => 'https://www.latifaba.com/'], ['src' => 'nyaman-care.png', 'alt' => 'Nyaman Care', 'link' => '#'], ['src' => 'penerbit-yaguwipa.png', 'alt' => 'Penerbit Yaguwipa', 'link' => 'https://www.penerbityaguwipa.id/'], ['src' => 'robotic.png', 'alt' => 'Robotic', 'link' => '#'], ['src' => 'teknika-solusinda.png', 'alt' => 'Teknika Solusinda', 'link' => '#']] as $logo)
                        <div class="logo-item flex-shrink-0">
                            <a href="{{ $logo['link'] }}" target="_blank" rel="noopener noreferrer"
                                class="hover:opacity-75 transition-opacity duration-200 block">
                                <img class="max-h-32 w-auto object-contain mx-8"
                                    src="{{ asset('img/lembaga-logo/' . $logo['src']) }}" alt="{{ $logo['alt'] }}"
                                    width="158" height="48" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
    {{-- end lembaga --}}
</body>

<x-footer />

</html>
