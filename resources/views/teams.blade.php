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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

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

    <div class="px-6 pt-17 lg:px-8">
        <div class="py-10">
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900 text-center sm:text-7xl">
                Anggota Yaguwipa
            </h1>
           <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 max-w-6xl mx-auto pt-10">
                <!-- Member 1 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <!-- Decorative elements -->
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <!-- Profile Image -->
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face" alt="Andika" class="object-cover w-full h-full" />
                                </div>
                                <!-- Subtle ring animation -->
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Andika</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    Web Designer
                                </div>
                            </div>
                            
                            <!-- Background blur effect -->
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <!-- Subtle shine effect on hover -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face" alt="Dinata" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Dinata</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    Web Designer
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=400&fit=crop&crop=face" alt="Bagas" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Bagas</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    IT Polymath
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 4 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=400&fit=crop&crop=face" alt="Rendra" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Rendra</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    UI/UX Designer
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 5 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=face" alt="Giri" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Giri</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    Web Designer
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 6 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b977?w=400&h=400&fit=crop&crop=face" alt="Nanda" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Nanda</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    UI/UX Expert
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 7 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        
                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1507591064344-4c6ce005b128?w=400&h=400&fit=crop&crop=face" alt="Harta" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Harta</h3>
                                <div class="inline-block px-2 py-1 bg-gradient-to-r from-gray-600 to-gray-700 text-white text-xs font-medium rounded-full shadow-sm transform transition-all duration-300 group-hover:from-gray-700 group-hover:to-gray-800">
                                    Web Developer
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/90 to-transparent rounded-b-xl"></div>
                        </div>
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </div>
                    </div>
                </div>

                <!-- Member 8 -->
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 via-gray-50 to-white p-0.5 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="relative h-44 w-full rounded-xl bg-white/95 backdrop-blur-sm overflow-hidden">
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="absolute -bottom-3 -left-3 w-6 h-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full opacity-20 group-hover:opacity-30 transition-opacity"></div>

                        <div class="relative pt-4 flex justify-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow-md transform transition-transform duration-300 group-hover:scale-110">
                                    <img src="https://images.unsplash.com/photo-1507591064344-4c6ce005b128?w=400&h=400&fit=crop&crop=face" alt="Harta" class="object-cover w-full h-full" />
                                </div>
                                <div class="absolute inset-0 rounded-full border border-gray-300 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <div class="relative z-10 text-center">
                                <h3 class="text-sm font-bold text-gray-800 mb-1.5 transform transition-transform duration-300 group-hover:scale-105">Harta</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
