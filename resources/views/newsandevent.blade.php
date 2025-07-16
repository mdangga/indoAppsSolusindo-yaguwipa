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
            <div class="max-w-7xl mx-auto">
                <!-- Header: Judul di kiri dan tombol di kanan -->
                <x-header-page title="NEWS & EVENT"
                    description="Beragam informasi dan berita terkini dari berbagai bidang, baik seputar yayasan maupun topik umum lainnya yang relevan
                        dan inspiratif." />

                @php
                    $page = request('page', 1);
                    $fromCache = Cache::has("berita_page_{$page}");
                @endphp

                <div class="text-xs text-gray-500 italic mb-2">
                    {{ $fromCache ? '🟢 Data dari CACHE' : '🔴 Data dari DATABASE' }}
                </div>
                <!-- Berita dan Kegiatan Grid - 4 columns, unlimited rows -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-10"
                    data-aos="fade-up">
                    @forelse ($berita as $item)
                        <x-berita :item="$item" />
                    @empty
                        <div
                            class="col-span-full bg-white border border-gray-200 rounded-lg shadow-sm p-12 text-center">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</h3>
                            <p class="text-sm text-gray-500">Berita dan kegiatan akan ditampilkan di sini.</p>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->

                <!-- Custom Pagination if using simple pagination -->
                @if (isset($berita) && method_exists($berita, 'hasPages') && $berita->hasPages())
                    <div class="flex justify-center items-center space-x-4">
                        <!-- Previous Button -->
                        @if ($berita->onFirstPage())
                            <span
                                class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                ← Previous
                            </span>
                        @else
                            <a href="{{ $berita->previousPageUrl() }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                ← Previous
                            </a>
                        @endif

                        <!-- Page Numbers -->
                        <div class="flex space-x-1">
                            @foreach ($berita->getUrlRange(1, $berita->lastPage()) as $page => $url)
                                @if ($page == $berita->currentPage())
                                    <span
                                        class="px-3 py-2 text-sm font-medium text-white bg-amber-400 border border-amber-500/50 rounded-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        <!-- Next Button -->
                        @if ($berita->hasMorePages())
                            <a href="{{ $berita->nextPageUrl() }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                Next →
                            </a>
                        @else
                            <span
                                class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                                Next →
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </main>
    <x-footer />
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuButton = document.getElementById('close-menu-button');

        if (mobileMenuButton && mobileMenu && closeMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });

            closeMenuButton.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            });

            // Close menu when clicking overlay
            mobileMenu.addEventListener('click', (e) => {
                if (e.target === mobileMenu) {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        }
    </script>
</body>



</html>
