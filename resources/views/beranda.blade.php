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

        .logo-container {
            width: 100%;
            max-width: 1200px;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
        }

        .logo-track {
            display: flex;
            width: fit-content;
        }

        .logo-set {
            display: flex;
            align-items: center;
            gap: 4rem;
            flex-shrink: 0;
        }

        .logo-item {
            flex-shrink: 0;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 180px;
        }

        .logo-track.animated {
            animation: seamlessScroll linear infinite;
        }

        .logo-track {
            transition: animation-duration 0.5s ease;
        }

        .logo-track.pausing {
            animation-duration: calc(var(--scroll-duration) * 2);
        }

        .logo-track.resuming {
            animation-duration: calc(var(--scroll-duration) * 2);
        }

        .logo-track.paused {
            animation-play-state: paused !important;
        }

        @keyframes seamlessScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(var(--total-scroll));
            }
        }

        .logo-container:hover .logo-track.animated {
            /* animation-play-state: paused; */
        }

        .logo-track.paused {
            animation-play-state: paused !important;
        }

        .logo-item img {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 96px;
            width: auto;
            object-fit: contain;
        }

        .logo-item:hover img {
            transform: scale(1.1);
        }

        .logo-container::before,
        .logo-container::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 120px;
            z-index: 10;
            pointer-events: none;
        }

        .logo-container::before {
            left: 0;
            background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.9) 30%, rgba(255, 255, 255, 0) 100%);
        }

        .logo-container::after {
            right: 0;
            background: linear-gradient(to left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.9) 30%, rgba(255, 255, 255, 0) 100%);
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
        {{-- end lembaga --}}
    </main>
    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoTrack = document.getElementById('logoTrack');
            const logoContainer = logoTrack.closest('.logo-container');

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
                            }, 400);
                        }, 400);
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
</body>

</html>
