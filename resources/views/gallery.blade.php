<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/flexmasonry/dist/flexmasonry.css">

</head>
<style>
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1);
    }

    .modal-image {
        width: 100%;
        height: auto;
        max-height: 80vh;
        object-fit: contain;
        display: block;
    }

    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.2s ease, transform 0.2s ease;
        z-index: 10001;
    }

    .modal-close:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }

    .modal-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        color: white;
        padding: 30px 20px 20px;
        text-align: center;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modal-content {
            max-width: 95vw;
            max-height: 95vh;
            margin: 10px;
        }

        .modal-close {
            top: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
            font-size: 16px;
        }

        .modal-info {
            padding: 20px 15px 15px;
        }

        .modal-title {
            font-size: 16px;
        }
    }
</style>

<body>
    <header class="absolute w-full z-50">
        <!-- Logo dan Login Button -->
        <div class="w-full bg-transparent p-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
                <!-- Logo -->
                <div class="flex justify-start">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-[75px] w-auto" src="img/logo.png" alt="Company Logo" />
                    </a>
                </div>

                <div class="hidden lg:block"></div>

                <!-- tombol Login -->
                <div class="hidden justify-end items-center lg:flex">
                    <a href="{{ route('login') }}"
                        class="bg-blue-100 text-sm font-semibold text-gray-900 rounded-[50px] px-6 py-3.5 hover:bg-blue-200 transition">
                        Log in
                    </a>
                </div>

                <!-- tombol menu -->
                <div class="flex lg:hidden justify-end">
                    <button type="button" id="mobile-menu-button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- fixed navbar -->
        <nav class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
            <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/5 backdrop-blur-sm">
                <div class="flex gap-x-12">
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-amber-200 transition duration-200">
                        Beranda
                    </a>
                    <div class="inline-flex items-center relative group">
                        <a href="#"
                            class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                            Tentang Kami
                        </a>
                        <div
                            class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg py-2 opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200 min-w-[160px]">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100 transform translate-x-0.5">Visi
                                &
                                Misi</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Struktur
                                Organisasi</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Sejarah</a>
                        </div>
                    </div>
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                        Program
                    </a>
                    <a href="#"
                        class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                        Kegiatan
                    </a>
                </div>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="lg:hidden fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-black/25"></div>
            <div
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="img/LOGO_YAYASAN.png" alt="" />
                    </a>
                    <button type="button" id="close-menu-button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Beranda</a>
                            <a href="#test"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Tentang
                                Kami</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Program</a>
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Kegiatan</a>
                        </div>
                        <div class="py-6">
                            <a href="#"
                                class="-mx-3 block px-3 py-2.5 text-base/7 font-semibold text-gray-900 rounded-full hover:bg-gray-50">Log
                                in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class=" px-4 sm:px-6 lg:px-40 py-20">
        <!-- Header -->
        <div class="pt-17 pb-15 gap-4">
            <h1 class="text-3xl font-semibold text-gray-900 text-center">
                GALLERI
            </h1>
            <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, cumque ab,
                assumenda
                velit consectetur
                laborum magni odio quisquam architecto, deserunt tempore atque aspernatur. Sunt, nemo.</p>
        </div>

        <!-- Masonry Grid -->
        <div id="masonry-container" class="columns-1 sm:columns-2 md:columns-3 gap-6">
            @forelse ($gallery->take(8) as $item)
                <div class="break-inside-avoid mb-6 group cursor-pointer gallery-item"
                    data-image="{{ asset('storage/' . $item->link) }}" data-title="{{ $item->judul }}">
                    <div
                        class="relative overflow-hidden rounded-xl bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 ease-out">
                        <!-- Image -->
                        <img src="{{ asset('storage/' . $item->link) }}" alt="{{ $item->judul }}"
                            class="w-full h-auto object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                            loading="lazy" />

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <!-- Bottom Info -->
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <p class="text-white text-sm font-medium">{{ $item->judul }}</p>
                                        </div>
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

        <!-- Load More Button -->
        @if ($gallery->count() > 8)
            <div class="text-center mt-12">
                <button id="load-more-btn"
                    class="opacity-75 w-full h-15 border border-gray-500 group relative bg-white text-black font-medium py-3 px-8 shadow-sm rounded-md hover:opacity-100 hover:border-gray-800 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 ease-out flex items-center justify-center gap-2">
                    <span>Load More</span>
                </button>
            </div>
        @endif

        <!-- Hidden Gallery Items -->
        <div id="hidden-gallery" class="hidden">
            @foreach ($gallery->skip(8) as $index => $item)
                <div class="break-inside-avoid mb-6 group cursor-pointer gallery-item-hidden fade-in"
                    data-index="{{ $index }}" data-image="{{ asset('storage/' . $item->link) }}"
                    data-title="{{ $item->judul }}">
                    <div
                        class="relative overflow-hidden rounded-xl bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 ease-out">
                        <img src="{{ asset('storage/' . $item->link) }}" alt="{{ $item->judul }}"
                            class="w-full h-auto object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                            loading="lazy" />

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <p class="text-white text-sm font-medium">{{ $item->judul }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Image Modal -->
    <div id="image-modal" class="modal-overlay">
        <button class="modal-close" id="modal-close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M18.3 5.71a.996.996 0 0 0-1.41 0L12 10.59L7.11 5.7A.996.996 0 1 0 5.7 7.11L10.59 12L5.7 16.89a.996.996 0 1 0 1.41 1.41L12 13.41l4.89 4.89a.996.996 0 1 0 1.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4" />
            </svg></button>
        <div class="modal-content">

            <img id="modal-image" class="modal-image" src="" alt="" loading="lazy">
            <div class="modal-info">
                <h3 id="modal-title" class="modal-title"></h3>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            const masonryContainer = document.getElementById('masonry-container');
            const hiddenGallery = document.getElementById('hidden-gallery');
            const imageModal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const modalTitle = document.getElementById('modal-title');
            const modalCloseBtn = document.getElementById('modal-close-btn');
            let currentPage = 1;
            const itemsPerPage = 8;

            // Modal functionality
            function openModal(imageSrc, imageTitle) {
                modalImage.src = imageSrc;
                modalTitle.textContent = imageTitle;
                imageModal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }

            function closeModal() {
                imageModal.classList.remove('active');
                document.body.style.overflow = ''; // Restore scrolling
                setTimeout(() => {
                    modalImage.src = '';
                    modalTitle.textContent = '';
                }, 300);
            }

            // Event listeners for modal
            modalCloseBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside the image
            imageModal.addEventListener('click', function(e) {
                if (e.target === imageModal || e.target.classList.contains('modal-overlay')) {
                    closeModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && imageModal.classList.contains('active')) {
                    closeModal();
                }
            });

            // Add click listeners to existing gallery items
            function addGalleryClickListeners() {
                const galleryItems = document.querySelectorAll(
                    '.gallery-item:not([data-listener-added]), .gallery-item-hidden:not([data-listener-added])');
                galleryItems.forEach(item => {
                    item.addEventListener('click', function() {
                        const imageSrc = this.dataset.image;
                        const imageTitle = this.dataset.title;
                        openModal(imageSrc, imageTitle);
                    });
                    item.setAttribute('data-listener-added', 'true');
                });
            }

            // Initialize click listeners
            addGalleryClickListeners();

            // Load more functionality
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const hiddenItems = hiddenGallery.querySelectorAll('.gallery-item-hidden');
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = Math.min(startIndex + itemsPerPage, hiddenItems.length);

                    // Show loading state
                    loadMoreBtn.innerHTML = `
                    <svg class="animate-spin w-5 h-5 text-black mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Loading...</span>
                    `;
                    loadMoreBtn.disabled = true;

                    // Simulate loading delay
                    setTimeout(() => {
                        // Add items to masonry container with fade-in animation
                        for (let i = startIndex; i < endIndex; i++) {
                            if (hiddenItems[i]) {
                                const clonedItem = hiddenItems[i].cloneNode(true);
                                clonedItem.classList.remove('gallery-item-hidden');
                                clonedItem.classList.add('gallery-item');
                                // Remove any existing listener attributes
                                clonedItem.removeAttribute('data-listener-added');
                                masonryContainer.appendChild(clonedItem);
                            }
                        }

                        // Add click listeners to new items
                        addGalleryClickListeners();

                        currentPage++;

                        // Reset or hide button
                        if (endIndex >= hiddenItems.length) {
                            // Hide button with animation
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

<footer class="bg-gray-900 text-white py-10 px-6">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kiri: Info Yayasan -->
        <div>
            <h2 class="text-xl font-bold uppercase">YAYASAN</h2>
            <h2 class="text-xl font-bold uppercase mb-4">GUNA WIDYA PARAMESTHI</h2>

            <p class="mb-2">
                <span class="font-semibold">Alamat :</span>
                JLN. GANETRI IV NO. 4 DPS 80237 BALI
            </p>
            <p class="mb-2">
                <span class="font-semibold">No Telepon :</span>
                (+62) 87865309966
            </p>
            <p class="mb-4">
                <span class="font-semibold">Email :</span>
                info@yaguwipa.org
            </p>

            <p class="mb-2 font-semibold">Follow Us :</p>
            <div class="flex space-x-4">
                <!-- YouTube -->
                <a href="#" class="text-white hover:text-red-500" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m10 15l5.19-3L10 9zm11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83c-.25.9-.83 1.48-1.73 1.73c-.47.13-1.33.22-2.65.28c-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44c-.9-.25-1.48-.83-1.73-1.73c-.13-.47-.22-1.1-.28-1.9c-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83c.25-.9.83-1.48 1.73-1.73c.47-.13 1.33-.22 2.65-.28c1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44c.9.25 1.48.83 1.73 1.73" />
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="text-white hover:text-blue-500" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="text-white hover:text-pink-400" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M13.028 2c1.125.003 1.696.009 2.189.023l.194.007c.224.008.445.018.712.03c1.064.05 1.79.218 2.427.465c.66.254 1.216.598 1.772 1.153a4.9 4.9 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428c.012.266.022.487.03.712l.006.194c.015.492.021 1.063.023 2.188l.001.746v1.31a79 79 0 0 1-.023 2.188l-.006.194c-.008.225-.018.446-.03.712c-.05 1.065-.22 1.79-.466 2.428a4.9 4.9 0 0 1-1.153 1.772a4.9 4.9 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465l-.712.03l-.194.006c-.493.014-1.064.021-2.189.023l-.746.001h-1.309a78 78 0 0 1-2.189-.023l-.194-.006a63 63 0 0 1-.712-.031c-1.064-.05-1.79-.218-2.428-.465a4.9 4.9 0 0 1-1.771-1.153a4.9 4.9 0 0 1-1.154-1.772c-.247-.637-.415-1.363-.465-2.428l-.03-.712l-.005-.194A79 79 0 0 1 2 13.028v-2.056a79 79 0 0 1 .022-2.188l.007-.194c.008-.225.018-.446.03-.712c.05-1.065.218-1.79.465-2.428A4.9 4.9 0 0 1 3.68 3.678a4.9 4.9 0 0 1 1.77-1.153c.638-.247 1.363-.415 2.428-.465c.266-.012.488-.022.712-.03l.194-.006a79 79 0 0 1 2.188-.023zM12 7a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 2a3 3 0 1 1 .001 6a3 3 0 0 1 0-6m5.25-3.5a1.25 1.25 0 0 0 0 2.5a1.25 1.25 0 0 0 0-2.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Kanan: Kosongkan -->
        <div id="test" class="relative group max-w-full overflow-hidden">
            {{-- <div
                class="absolute inset-0 bg-gradient-to-br from-black/70 via-gray-800/60 to-black/70 rounded-md z-10 transition-opacity duration-300 group-hover:opacity-0 pointer-events-none">
            </div> --}}

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2828.1566751622727!2d115.23003191579483!3d-8.638782329040929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f8661ef31cd%3A0x663c45c04ca4cfb3!2sPT.%20Indo%20Apps%20Solusindo%20-%20Apps%20%26%20Web%20Development%20%7C%20Software%20Services%20%7C%20Seo%20Services%20di%20Bali%20%7C%20Domain%20%26%20Hosting%20%7C%20IoT!5e0!3m2!1sid!2sid!4v1750918670426!5m2!1sid!2sid"
                class="rounded-md w-full h-[250px] border-0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </div>
</footer>

</html>