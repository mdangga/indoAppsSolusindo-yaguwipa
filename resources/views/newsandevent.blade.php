<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Berita dan Kegiatan</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">
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
    <x-contact-btt-floating email="support@mycompany.com" phone="+62 21-1234-5678" size="default" :auto-hide="true"
        :auto-hide-delay="3000" :show-back-to-top="true" :scroll-threshold="200" />
    <main class="px-4 sm:px-6 lg:px-12 py-16">
        <div class="max-w-7xl mx-auto">
            @php
                $page = request('page', 1);
                $fromCache = Cache::has("berita_page_{$page}");
            @endphp
            {{-- populer week --}}
            @if (isset($beritaPopulerMingguan))
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-25">
                    <!-- Kolom kiri: berita paling populer mingguan -->
                    <div class="lg:col-span-8 relative group">
                        @if (isset($beritaPopulerMingguan) && $beritaPopulerMingguan->count())
                            @php
                                $populer = $beritaPopulerMingguan->first();
                                $thumbnail = $populer->thumbnail
                                    ? asset('storage/' . $populer->thumbnail)
                                    : asset('images/no-image.png');
                            @endphp

                            <a href="{{ route('berita.slug', $populer->slug) }}" class="block group">
                                <div class="relative h-[495px] overflow-hidden shadow-lg group">
                                    <img src="{{ $thumbnail }}" alt="{{ $populer->judul }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 brightness-90" />

                                    <!-- Kategori di kanan atas -->
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-black text-white px-3 py-2 text-sm uppercase font-semibold">
                                            {{ $populer->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
                                        </span>
                                    </div>

                                    <!-- Gradient overlay hanya di bagian bawah -->
                                    <div
                                        class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                    </div>

                                    <!-- Konten teks di bagian bawah -->
                                    <div class="absolute bottom-0 left-0 right-0 p-6">
                                        <h2 class="text-white text-2xl font-bold mb-3 leading-tight">
                                            {{ $populer->judul }}
                                        </h2>

                                        <!-- Garis horizontal di tengah -->
                                        <hr class="w-50 h-[2px] bg-amber-400 border-none rounded-full mb-3" />

                                        <p class="text-white/90 text-sm leading-relaxed">
                                            {{ Str::limit(strip_tags($populer->isi_berita), 260) }}
                                        </p>
                                    </div>

                                </div>
                            </a>
                        @else
                            <div class="bg-gray-100 h-[500px] flex items-center justify-center rounded-2xl">
                                <p class="text-gray-500 text-center">Belum ada berita populer minggu ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Kolom kanan: daftar berita populer mingguan lainnya -->
                    <aside class="lg:col-span-4 overflow-y-auto space-y-3.5">
                        @if ($beritaPopulerMingguan->skip(1)->count())
                            @foreach ($beritaPopulerMingguan->skip(1) as $pop)
                                <a href="{{ route('berita.slug', $pop->slug) }}"
                                    class="flex items-start gap-3 group hover:bg-gray-100 p-2 transition">
                                    <img src="{{ $pop->thumbnail ? asset('storage/' . $pop->thumbnail) : asset('images/no-image.png') }}"
                                        alt="{{ $pop->judul }}" class="h-17 w-auto object-cover" />
                                    <div>
                                        <!-- Tanggal dan durasi baca -->
                                        <div class="text-xs text-gray-400 flex items-center gap-3">
                                            <span>{{ \Carbon\Carbon::parse($pop->created_at)->format('M d, Y') }}</span>
                                        </div>
                                        <h3 class="text-sm font-medium text-gray-700 group-hover:text-black">
                                            {{ Str::limit($pop->judul, 60) }}
                                        </h3>
                                        <p class="text-xs text-gray-500">
                                            {{ $pop->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="bg-gray-100 h-full flex items-center justify-center rounded-xl">
                                <p class="text-gray-500 text-center text-sm">Belum ada berita populer mingguan lainnya.
                                </p>
                            </div>
                        @endif
                    </aside>

                </section>
            @endif

            {{-- populer all --}}
            @if (isset($beritaPopuler) && $beritaPopuler->count())
                <section class="mt-13">
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Berita Populer</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        @foreach ($beritaPopuler as $item)
                            <a href="{{ route('berita.slug', $item->slug) }}" class="group">
                                <!-- Gambar -->
                                <div class="relative w-full h-[150px] overflow-hidden shadow-sm">
                                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/no-image.png') }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover hover:opacity-90 transition duration-300" />
                                </div>

                                <!-- Teks -->
                                <div class="mt-3">
                                    <h3
                                        class="text-sm font-semibold text-gray-900 group-hover:underline leading-snug line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }} •
                                        {{ $item->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @else
                <section class="mt-13">
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Berita Populer</h1>
                    <div class="bg-gray-100 h-[200px] flex items-center justify-center rounded-xl">
                        <p class="text-gray-500 text-center text-sm">Belum ada berita populer.</p>
                    </div>
                </section>
            @endif


            <section class="py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri: Daftar Berita -->
                <div class="lg:col-span-2 space-y-6">
                    @if (isset($keyword))
                        @php
                            $berita = $beritaKeyword;
                            $title = 'Tag : ' . $keyword;
                        @endphp
                    @endif
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">{{ $title ?? 'Berita Terbaru' }}</h1>
                    @if ($berita->isEmpty())
                        <div class="bg-gray-100 h-[500px] flex items-center justify-center rounded-xl">
                            <p class="text-gray-500 text-center text-sm">Belum ada berita populer.</p>
                        </div>
                    @else
                        @foreach ($berita as $index => $item)
                            <div
                                class="flex flex-row gap-5 items-center 
                {{ $index !== count($berita) - 1 ? 'border-b border-gray-200 pb-6' : '' }}">
                                <!-- Gambar Thumbnail -->
                                <a href="{{ route('berita.slug', $item->slug) }}"
                                    class="block w-[120px] md:w-[300px] shrink-0">
                                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/no-image.png') }}"
                                        class="w-full h-[100px] md:h-[180px] object-cover shadow hover:opacity-90 transition duration-300">
                                </a>

                                <!-- Konten Berita -->
                                <div class="flex-1 flex flex-col justify-center">
                                    <p class="inline-block text-sm text-gray-500 uppercase font-semibold mb-1">
                                        {{ $item->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
                                    </p>
                                    <h3 class="text-base md:text-xl font-bold text-gray-900 leading-snug mb-2">
                                        <a href="{{ route('berita.slug', $item->slug) }}"
                                            class="hover:text-amber-400 transition">
                                            {{ $item->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $item->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if (isset($berita) && $berita instanceof \Illuminate\Pagination\LengthAwarePaginator && $berita->hasPages())
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

                <!-- Kolom Kanan: Sidebar -->
                @if (isset($beritaPopuler))
                    <div class="space-y-8">
                        <!-- Tag -->
                        <div class="bg-gray-50 p-6 rounded-sm shadow">
                            <h4 class="text-lg font-semibold mb-4">Tag</h4>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $tags = collect($beritaPopuler)
                                        ->pluck('keyword')
                                        ->flatMap(fn($item) => explode(';', $item))
                                        ->map(fn($tag) => trim($tag))
                                        ->filter()
                                        ->unique();
                                @endphp

                                @forelse ($tags as $tag)
                                    <a href="{{ route('berita.keyword', $tag) }}"
                                        class="text-sm px-3 py-1 bg-gray-100 text-gray-800 rounded hover:bg-black hover:text-white transition cursor-default">
                                        {{ $tag }}
                                    </a>
                                @empty
                                    <div class="text-gray-500 italic">Belum tersedia.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        </div>
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
