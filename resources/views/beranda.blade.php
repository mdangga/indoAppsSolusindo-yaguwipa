@extends('layouts.main')

@section('title', 'Beranda')

@push('styles')
    {{-- custom style --}}
    @vite('resources/css/beranda.css')

    {{-- AOS css --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
@endpush

@section('content')
    {{-- popup --}}
    @if ($site['yayasanProfile']->popup)
        <x-pop-up image-src="{{ $site['yayasanProfile']->popup }}" image-alt="Welcome Image" />
    @endif

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
                        <a href="{{ route('form.donasi', 1) }}"
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
                                <img src="{{ asset('storage/' . $item->link) }}" alt="{{ $item->judul }}" loading="lazy"
                                    class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                            </div>
                        @empty
                            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-gray-100/50">
                                    <p class="text-gray-500 text-center">Belum ada gambar di galeri.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if ($gallery->count() > 1)
                        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            @foreach ($gallery->take(5) as $index => $item)
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
        @if (!empty($site['lembaga']) && count($site['lembaga']) > 0)
            <div class="px-4 sm:px-6 lg:px-12 py-16">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-center pb-5 text-4xl font-semibold text-gray-900">
                        LEMBAGA TERKAIT
                    </h1>
                    <div class="mx-auto mt-10 logo-container">
                        <div class="logo-track" id="logoTrack">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Testimonial Section -->
        {{-- <section class="py-12 px-4 sm:px-6 lg:px-12">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-8 sm:mb-10">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 text-gray-900">
                        Apa Kata Mereka Tentang Yayasan Kami
                    </h2>
                    <p class="text-sm sm:text-base text-gray-500">Suara hati mitra dan donatur yang bersama mewujudkan
                        perubahan positif.</p>
                </div>

                <div class="relative w-full" data-carousel="static" data-carousel-interval="7000">
       
                    <div class="relative overflow-hidden rounded-xl min-h-[300px] sm:min-h-[350px]">
                        @foreach ($reviews as $slideIndex => $review)
                            <div class="{{ $slideIndex === 0 ? 'block' : 'hidden' }} duration-1000 ease-in-out"
                                data-carousel-item="{{ $slideIndex === 0 ? 'active' : '' }}">

                                <div class="p-4 sm:p-6">
                                    <div
                                        class="bg-white border border-gray-200 rounded-xl sm:rounded-2xl shadow-md p-4 sm:p-6 flex flex-col justify-between">
                                
                                        <div class="text-yellow-400 mb-2 text-sm sm:text-base">
                                            {!! str_repeat('★', $review->rating) !!}
                                            {!! str_repeat('☆', 5 - $review->rating) !!}
                                            <span class="text-gray-500 text-xs sm:text-sm">
                                                ({{ $review->rating }}/5)
                                            </span>
                                        </div>

                                        <p class="text-gray-600 mb-4 text-sm sm:text-base">
                                            "{{ Str::limit($review->review, 120, '...') }}"
                                        </p>

                                        <div class="flex items-center mt-auto pt-3 sm:pt-4 border-t border-gray-100">
                                            @php
                                                $profilePath = $review->User->profile_path ?? null;
                                                $src = null;
                                                $initial = strtoupper(
                                                    Str::substr(
                                                        $review->User->username ?? ($review->User->name ?? 'U'),
                                                        0,
                                                        1,
                                                    ),
                                                );
                                                if ($profilePath) {
                                                    if (preg_match('/^https?:\/\//i', $profilePath)) {
                                                        $src = $profilePath;
                                                    } else {
                                                        $normalized = ltrim(
                                                            preg_replace('#^storage/#', '', $profilePath),
                                                            '/',
                                                        );
                                                        $src = asset('storage/' . $normalized);
                                                    }
                                                }
                                            @endphp

                                            @if ($src)
                                                <img src="{{ $src }}"
                                                    alt="Foto Profil {{ $review->User->nama ?? 'Pengguna' }}"
                                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover border-2 border-gray-300" />
                                            @else
                                                <div
                                                    class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-400 rounded-full text-white flex items-center justify-center font-semibold uppercase select-none text-lg">
                                                    {{ $initial }}
                                                </div>
                                            @endif

                                            <div class="ml-3">
                                                <h4 class="font-semibold text-gray-900 text-sm sm:text-base capitalize">
                                                    {{ $review->User->nama ?? 'Anonim' }}</h4>
                                                <p class="text-xs sm:text-sm text-gray-500 capitalize">
                                                    {{ $review->User->role ?? 'Pengguna' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button"
                        class="absolute top-1/2 sm:top-1/3 -left-2 sm:-left-5 -translate-y-1/2 z-50 flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/80 hover:bg-white hover:scale-110 sm:hover:scale-120 hover:-translate-x-1 sm:hover:-translate-x-4 shadow-md focus:outline-none transition-all duration-300"
                        data-carousel-prev>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-800" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button type="button"
                        class="absolute top-1/2 sm:top-1/3 -right-2 sm:-right-5 -translate-y-1/2 z-50 flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/80 hover:bg-white hover:scale-110 sm:hover:scale-120 hover:translate-x-1 sm:hover:translate-x-4 shadow-md focus:outline-none transition-all duration-300"
                        data-carousel-next>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-800" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </section> --}}
        <section class="py-12 px-4 sm:px-6 lg:px-12">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-8 sm:mb-10">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 text-gray-900">
                        Apa Kata Mereka Tentang Yayasan Kami
                    </h2>
                    <p class="text-sm sm:text-base text-gray-500">Suara hati mitra dan donatur yang bersama mewujudkan
                        perubahan positif.</p>
                </div>

                <div class="relative w-full" data-carousel="static" data-carousel-interval="7000">
                    <!-- Wrapper -->
                    <div class="relative overflow-hidden rounded-xl min-h-[300px]">
                        @foreach ($reviews as $reviewIndex => $review)
                            <div class="{{ $reviewIndex === 0 ? 'block' : 'hidden' }} duration-1000 ease-in-out"
                                data-carousel-item="{{ $reviewIndex === 0 ? 'active' : '' }}">
                                <div class="flex justify-center p-4 sm:p-6">
                                    <div
                                        class="bg-white border border-gray-200 rounded-xl sm:rounded-2xl shadow-md p-6 sm:p-8 max-w-2xl w-full flex flex-col justify-between">
                                        <div>
                                            {{-- Bintang Dinamis --}}
                                            <div class="text-yellow-400 mb-4 text-center text-lg sm:text-xl">
                                                {!! str_repeat('★', $review->rating) !!}
                                                {!! str_repeat('☆', 5 - $review->rating) !!}
                                                <span
                                                    class="text-gray-500 text-sm sm:text-base ml-2">({{ $review->rating }}/5)</span>
                                            </div>

                                            {{-- Pesan Review --}}
                                            <p class="text-gray-600 mb-6 text-center text-base sm:text-lg leading-relaxed">
                                                "{{ $review->review }}"
                                            </p>
                                        </div>

                                        {{-- Info User --}}
                                        <div class="flex items-center justify-center mt-auto pt-6 border-t border-gray-100">
                                            @php
                                                $profilePath = $review->User->profile_path ?? null;
                                                $src = null;
                                                $initial = strtoupper(
                                                    Str::substr(
                                                        $review->User->username ?? ($review->User->name ?? 'U'),
                                                        0,
                                                        1,
                                                    ),
                                                );
                                                if ($profilePath) {
                                                    // Jika URL eksternal
                                                    if (preg_match('/^https?:\/\//i', $profilePath)) {
                                                        $src = $profilePath;
                                                    } else {
                                                        // Normalisasi kalau ada prefix "storage/"
                                                        $normalized = ltrim(
                                                            preg_replace('#^storage/#', '', $profilePath),
                                                            '/',
                                                        );
                                                        $src = asset('storage/' . $normalized);
                                                    }
                                                }
                                            @endphp

                                            @if ($src)
                                                <img src="{{ $src }}"
                                                    alt="Foto Profil {{ $review->User->nama ?? 'Pengguna' }}"
                                                    class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover border-2 border-gray-300" />
                                            @else
                                                <div
                                                    class="w-12 h-12 sm:w-14 sm:h-14 bg-gray-400 rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 text-xl">
                                                    {{ $initial }}
                                                </div>
                                            @endif

                                            <div class="ml-4 text-center sm:text-left">
                                                <h4 class="font-semibold text-gray-900 text-base sm:text-lg capitalize">
                                                    {{ $review->User->nama ?? 'Anonim' }}
                                                </h4>
                                                <p class="text-sm sm:text-base text-gray-500 capitalize">
                                                    {{ $review->User->role ?? 'Pengguna' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Carousel navigation -->
                    <!-- Tombol Prev -->
                    <div class="flex justify-center mt-2 gap-4">
                        <!-- Tombol Prev -->
                        <button type="button"
                            class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 hover:scale-110 shadow-md focus:outline-none transition-all duration-300"
                            data-carousel-prev>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <!-- Tombol Next -->
                        <button type="button"
                            class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 hover:scale-110 shadow-md focus:outline-none transition-all duration-300"
                            data-carousel-next>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    {{-- AOS js --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    @vite('resources/js/AOS.js')

    @if (!empty($site['lembaga']) && count($site['lembaga']) > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const logoTrack = document.getElementById('logoTrack');
                const logoContainer = logoTrack.closest('.logo-container');
                const reviews = @json($reviews);
                const carouselInner = document.getElementById('carousel-inner');

                const logos = [
                    @foreach ($site['lembaga'] as $logo)
                        {
                            name: '{{ $logo['nama'] }}',
                            url: '{{ $logo['website'] }}',
                            image: '{{ asset('storage/' . $logo['image_path']) }}'
                        },
                    @endforeach
                ];

                if (logos[logos.length - 1] && logos[logos.length - 1].name === undefined) {
                    logos.pop();
                }

                const containerWidth = 1200;
                const logoItemWidth = 180 + 64;
                const singleSetWidth = logos.length * logoItemWidth;
                const minSets = Math.max(3, Math.ceil((containerWidth * 2.5) / singleSetWidth));

                console.log(`Creating ${minSets} sets for ${logos.length} logos`);

                // Generate multiple identical sets
                for (let setIndex = 0; setIndex < minSets; setIndex++) {
                    const logoSet = document.createElement('div');
                    logoSet.className = 'logo-set';
                    logoSet.id = `logoSet${setIndex + 1}`;

                    logos.forEach((logo) => {
                        const logoItem = document.createElement('div');
                        logoItem.className = 'logo-item';

                        logoItem.innerHTML = `
                <a href="${logo.url}" target="_blank" rel="noopener noreferrer"
                   class="hover:opacity-90 transition-opacity duration-200">
                    <img class="max-h-24 w-auto object-contain"
                         src="${logo.image}"
                         alt="${logo.name}" 
                         width="158" height="48" />
                </a>
            `;

                        logoSet.appendChild(logoItem);
                    });

                    logoTrack.appendChild(logoSet);
                }

                // Wait for images to load
                const images = logoTrack.querySelectorAll('img');
                let loadedImages = 0;

                function startAnimation() {
                    setTimeout(() => {
                        const firstSet = document.getElementById('logoSet1');
                        if (!firstSet) return;

                        const actualSetWidth = firstSet.offsetWidth;

                        logoTrack.style.setProperty('--total-scroll', `-${actualSetWidth}px`);

                        const duration = Math.max(15, actualSetWidth * 0.04);

                        logoTrack.style.animation = `seamlessScroll ${duration}s linear infinite`;
                        logoTrack.classList.add('animated');

                        console.log(`Set width: ${actualSetWidth}px, Duration: ${duration}s`);

                        let pauseTimeout, resumeTimeout;

                        logoContainer.addEventListener('mouseenter', () => {
                            clearTimeout(resumeTimeout);
                            pauseTimeout = setTimeout(() => {
                                logoTrack.classList.add('pausing');
                                setTimeout(() => {
                                    logoTrack.classList.add('paused');
                                    console.log('Animation paused smoothly');
                                }, 200);
                            }, 200);
                        });

                        logoContainer.addEventListener('mouseleave', () => {
                            clearTimeout(pauseTimeout);
                            logoTrack.classList.remove('paused');
                            logoTrack.classList.add('resuming');

                            resumeTimeout = setTimeout(() => {
                                logoTrack.classList.remove('resuming');
                                logoTrack.classList.remove('pausing');
                                console.log('Animation resumed smoothly');
                            }, 800);
                        });
                    }, 200);
                }

                if (images.length > 0) {
                    images.forEach(img => {
                        if (img.complete) {
                            loadedImages++;
                        } else {
                            img.addEventListener('load', () => {
                                loadedImages++;
                                if (loadedImages === images.length) {
                                    startAnimation();
                                }
                            });
                            img.addEventListener('error', () => {
                                loadedImages++;
                                if (loadedImages === images.length) {
                                    startAnimation();
                                }
                            });
                        }
                    });

                    if (loadedImages === images.length) {
                        startAnimation();
                    }
                } else {
                    startAnimation();
                }
            });

            window.addEventListener('resize', function() {
                const logoTrack = document.getElementById('logoTrack');
                const firstSet = document.getElementById('logoSet1');

                if (logoTrack && firstSet) {
                    setTimeout(() => {
                        const actualSetWidth = firstSet.offsetWidth;
                        logoTrack.style.setProperty('--total-scroll', `-${actualSetWidth}px`);

                        const duration = Math.max(15, actualSetWidth * 0.04);
                        logoTrack.style.animation = `seamlessScroll ${duration}s linear infinite`;
                    }, 100);
                }
            });
        </script>
    @endif
@endpush
