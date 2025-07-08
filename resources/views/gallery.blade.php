<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Galleri</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/flexmasonry/dist/flexmasonry.css">
</head>

@php
    function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:.*v=|v\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }
@endphp

<body>
    <x-navbar :menus="$menus" />

    <div class="px-4 sm:px-6 lg:px-40 py-20">
        <x-header-page title="GALLERI"
            description="Galeri ini menyajikan koleksi gambar dari berbagai aktivitas, baik yang diselenggarakan oleh yayasan maupun momen-momen penting lainnya." />

        <!-- Masonry Grid -->
        <div id="masonry-container" class="columns-1 sm:columns-2 md:columns-3 gap-6">
            @forelse ($gallery->take(8) as $item)
                @php
                    $isYoutube = $item->kategori === 'youtube';
                    $youtubeId = $isYoutube ? extractYoutubeId($item->link) : null;
                    $thumbnail =
                        $isYoutube && $youtubeId
                            ? "https://img.youtube.com/vi/$youtubeId/hqdefault.jpg"
                            : asset('storage/' . $item->link);
                @endphp
                <div class="break-inside-avoid mb-6 group cursor-pointer gallery-item" data-image="{{ $thumbnail }}"
                    data-title="{{ $item->alt_text }}" data-type="{{ $item->kategori }}"
                    data-link="{{ $item->link }}">
                    <div
                        class="relative overflow-hidden rounded-xl bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 ease-out">
                        <img src="{{ $thumbnail }}" alt="{{ $item->alt_text }}"
                            class="w-full h-auto object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                            loading="lazy" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <p class="text-white text-sm font-medium">{{ $item->alt_text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Belum ada gambar di galeri</p>
                    <p class="text-gray-400 text-sm mt-1">Upload gambar untuk memulai koleksi Anda</p>
                </div>
            @endforelse
        </div>

        @if ($gallery->count() > 8)
            <div class="text-center mt-12">
                <button id="load-more-btn"
                    class="opacity-75 w-full h-15 border border-gray-500 group relative bg-white text-black font-medium py-3 px-8 shadow-sm rounded-md hover:opacity-100 hover:border-gray-800 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 ease-out flex items-center justify-center gap-2">
                    <span>Load More</span>
                </button>
            </div>
        @endif

        <div id="hidden-gallery" class="hidden">
            @foreach ($gallery->skip(8) as $index => $item)
                @php
                    $isYoutube = $item->kategori === 'youtube';
                    $youtubeId = $isYoutube ? extractYoutubeId($item->link) : null;
                    $thumbnail =
                        $isYoutube && $youtubeId
                            ? "https://img.youtube.com/vi/$youtubeId/hqdefault.jpg"
                            : asset('storage/' . $item->link);
                @endphp
                <div class="break-inside-avoid mb-6 group cursor-pointer gallery-item-hidden fade-in"
                    data-index="{{ $index }}" data-image="{{ $thumbnail }}"
                    data-title="{{ $item->alt_text }}">
                    <div
                        class="relative overflow-hidden rounded-xl bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 ease-out">
                        <img src="{{ $thumbnail }}" alt="{{ $item->alt_text }}"
                            class="w-full h-auto object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                            loading="lazy" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <p class="text-white text-sm font-medium">{{ $item->alt_text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="image-modal" class="fixed inset-0 z-50 bg-black/80 hidden items-center justify-center">
        <!-- Close Button -->
        <button id="modal-close-btn" class="absolute top-4 right-4 text-white hover:text-red-400 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18.3 5.71a.996.996 0 0 0-1.41 0L12 10.59L7.11 5.7A.996.996 0 1 0 5.7 7.11L10.59 12L5.7 16.89a.996.996 0 1 0 1.41 1.41L12 13.41l4.89 4.89a.996.996 0 1 0 1.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4" />
            </svg>
        </button>

        <!-- Modal Content -->
        <div class="relative w-full max-w-4xl max-h-[90vh] flex items-center justify-center p-4">
            <!-- YouTube Video -->
            <div class="w-full aspect-video hidden" id="modal-video-container">
                <iframe id="modal-video" class="w-full h-full rounded-md" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Image -->
            <img id="modal-image" class="hidden max-w-full max-h-[90vh] rounded-md object-contain bg-transparent"
                loading="lazy" />
        </div>

        <!-- Title -->
        <div class="absolute bottom-6 text-white text-center px-4 max-w-[80%]">
            <h3 id="modal-title" class="text-xl font-semibold drop-shadow-md"></h3>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            const masonryContainer = document.getElementById('masonry-container');
            const hiddenGallery = document.getElementById('hidden-gallery');
            const imageModal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const modalVideo = document.getElementById('modal-video');
            const modalVideoContainer = document.getElementById('modal-video-container');
            const modalTitle = document.getElementById('modal-title');
            const modalCloseBtn = document.getElementById('modal-close-btn');

            let currentPage = 1;
            const itemsPerPage = 8;

            function openModal(src, title, type = 'image', link = '') {
                imageModal.classList.remove('hidden');
                imageModal.classList.add('flex');
                imageModal.classList.add('active');
                document.body.style.overflow = 'hidden';

                if (type === 'youtube') {
                    const youtubeId = extractYoutubeId(link);
                    if (youtubeId) {
                        modalVideo.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&controls=1`;
                        modalVideoContainer.classList.remove('hidden');
                        modalImage.classList.add('hidden');
                    }
                } else {
                    modalImage.src = src;
                    modalImage.classList.remove('hidden');
                    modalVideoContainer.classList.add('hidden');
                    modalVideo.src = ''; // Reset iframe
                }

                modalTitle.textContent = title || '';
            }

            function closeModal() {
                imageModal.classList.remove('flex', 'active');
                imageModal.classList.add('hidden');
                document.body.style.overflow = '';
                modalImage.src = '';
                modalVideo.src = ''; // stop YouTube autoplay
            }


            function extractYoutubeId(url) {
                const match = url.match(/(?:youtube\.com\/(?:.*v=|v\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
                return match ? match[1] : null;
            }

            modalCloseBtn.addEventListener('click', closeModal);
            imageModal.addEventListener('click', function(e) {
                if (e.target === this || e.target.classList.contains('modal-overlay')) closeModal();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && imageModal.classList.contains('active')) closeModal();
            });

            function addGalleryClickListeners() {
                const galleryItems = document.querySelectorAll(
                    '.gallery-item:not([data-listener-added]), .gallery-item-hidden:not([data-listener-added])'
                );

                galleryItems.forEach(item => {
                    item.addEventListener('click', function() {
                        const imageSrc = this.dataset.image;
                        const imageTitle = this.dataset.title;
                        const type = this.dataset.type || 'image';
                        const link = this.dataset.link || '';
                        openModal(imageSrc, imageTitle, type, link);
                    });
                    item.setAttribute('data-listener-added', 'true');
                });
            }

            addGalleryClickListeners();

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const hiddenItems = hiddenGallery.querySelectorAll('.gallery-item-hidden');
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = Math.min(startIndex + itemsPerPage, hiddenItems.length);

                    loadMoreBtn.innerHTML = `<svg class="animate-spin w-5 h-5 text-black mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg><span>Loading...</span>`;
                    loadMoreBtn.disabled = true;

                    setTimeout(() => {
                        for (let i = startIndex; i < endIndex; i++) {
                            if (hiddenItems[i]) {
                                const clonedItem = hiddenItems[i].cloneNode(true);
                                clonedItem.classList.remove('gallery-item-hidden');
                                clonedItem.classList.add('gallery-item');
                                clonedItem.removeAttribute('data-listener-added');
                                masonryContainer.appendChild(clonedItem);
                            }
                        }

                        addGalleryClickListeners();
                        currentPage++;

                        if (endIndex >= hiddenItems.length) {
                            setTimeout(() => {
                                loadMoreBtn.style.opacity = '0';
                                loadMoreBtn.style.transform = 'translateY(10px)';
                                loadMoreBtn.style.transition =
                                    'opacity 0.5s ease, transform 0.5s ease';
                                setTimeout(() => {
                                    loadMoreBtn.style.display = 'none';
                                }, 500);
                            }, 500);
                        } else {
                            loadMoreBtn.innerHTML = `<span>Load More</span>`;
                            loadMoreBtn.disabled = false;
                        }
                    }, 800);
                });
            }
        });
    </script>
</body>

<x-footer />

</html>
