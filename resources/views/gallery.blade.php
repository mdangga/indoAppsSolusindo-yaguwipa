@extends('layouts.main')

@section('title', 'Gallery')

@push('styles')
    {{-- custom style --}}
    @vite('resources/css/gallery.css')

    {{-- AOS css --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    {{-- masonry css --}}
    <link rel="stylesheet" href="https://unpkg.com/flexmasonry/dist/flexmasonry.css">
@endpush

@php
    function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:.*v=|v\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }
@endphp

@section('content')
    <main>
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <x-header-page title="GALLERY {{ strtoupper($type) }}"
                    description="Galeri ini menyajikan koleksi gambar dari berbagai aktivitas, baik yang diselenggarakan oleh yayasan maupun momen-momen penting lainnya." />
                @if ($gallery->isEmpty())
                    <div class="flex flex-col items-center justify-center min-h-[200px] mb-20 w-full space-y-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300" fill="none" width="20"
                            height="20" viewBox="0 0 20 20">
                            <path fill="currentColor"
                                d="M17.125 6.17L15.079.535c-.151-.416-.595-.637-.989-.492L.492 5.006c-.394.144-.593.597-.441 1.013l2.156 5.941V8.777c0-1.438 1.148-2.607 2.56-2.607H8.36l4.285-3.008l2.479 3.008zM19.238 8H4.767a.76.76 0 0 0-.762.777v9.42c.001.444.343.803.762.803h14.471c.42 0 .762-.359.762-.803v-9.42A.76.76 0 0 0 19.238 8M18 17H6v-2l1.984-4.018l2.768 3.436l2.598-2.662l3.338-1.205L18 14z" />
                        </svg>
                        <p class="text-gray-500 text-md">Belum ada gambar di galeri</p>
                    </div>
                @else
                    <!-- Masonry Grid -->
                    <div id="masonry-container" class="columns-1 sm:columns-2 md:columns-3 gap-6">
                        @foreach ($gallery as $item)
                            @php
                                $isVideo = $item->kategori === 'video';
                                $youtubeId = $isVideo ? extractYoutubeId($item->link) : null;
                                $thumbnail =
                                    $isVideo && $youtubeId
                                        ? "https://img.youtube.com/vi/$youtubeId/hqdefault.jpg"
                                        : asset('storage/' . $item->link);
                            @endphp
                            <div class="break-inside-avoid mb-6 group cursor-pointer gallery-item"
                                data-image="{{ $thumbnail }}" data-title="{{ $item->alt_text }}"
                                data-type="{{ $item->kategori }}" data-link="{{ $item->link }}">
                                <div
                                    class="relative overflow-hidden rounded-xl bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 ">
                                    <img src="{{ $thumbnail }}" alt="{{ $item->alt_text }}"
                                        class="w-full h-auto object-cover transition-transform duration-700  group-hover:scale-102"
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
                        @endforeach
                    </div>
                @endif


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
                            $isVideo = $item->kategori === 'youtube';
                            $youtubeId = $isVideo ? extractYoutubeId($item->link) : null;
                            $thumbnail =
                                $isVideo && $youtubeId
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
                    <img id="modal-image" class="hidden max-w-full max-h-[80vh] rounded-md object-contain bg-transparent"
                        loading="lazy" />
                </div>

                <!-- Title -->
                <div class="absolute bottom-6 text-white text-center px-4 max-w-[80%]">
                    <h3 id="modal-title" class="text-xl font-medium drop-shadow-md"></h3>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    {{-- AOS js --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    @vite('resources/js/AOS.js')

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

                if (type === 'video') {
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
@endpush
