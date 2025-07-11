<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">
    <title>{{ $site['yayasanProfile']->meta_title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

     <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
     
</head>

<body>
    {{-- navbar --}}
    <x-navbar :menus="$menus" />

    <div class="px-6 pt-17 lg:px-8">
        <div class="py-20">
            <!-- Baris 1: Header -->
            <div class="flex items-center justify-center my-4">
                <h1 class="text-3xl font-semibold tracking-tight text-gray-900 text-center sm:text-7xl m-0">
                    {{ $site['yayasanProfile']->company }}
                </h1>
            </div>

            <!-- Baris 2: Logo dan Teks -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center w-full max-w-5xl mx-auto">
                <!-- Logo -->
                <div class="flex justify-center">
                    <img class="h-64 md:h-96 w-auto object-contain"
                        src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Logo Yayasan">
                </div>

                <!-- Text -->
                <div class="md:col-span-2 text-gray-700 leading-relaxed text-justify">
                    <p class="text-base md:text-lg">
                        {{ $site['yayasanProfile']->tentang }}
                    </p>
                </div>
            </div>
        </div>
    </div>

   <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">
                    Nilai-Nilai Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Fondasi yang kuat membangun masa depan yang berkelanjutan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
             <!-- Visi Card -->
                        <div class="bg-white border border-gray-200 glass-card rounded-3xl p-8 shadow-xl card-hover relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col h-full ">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-full -mr-16 -mt-16"></div>
                            <div class="relative">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl mb-6 shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi</h3>
                                <p class="text-left font-normal text-gray-700">
                                    {{ $site['yayasanProfile']->visi }}
                                </p>
                            </div>
                        </div>

                    <!-- Misi Card -->
                    <div class="bg-white border border-gray-200 glass-card rounded-3xl p-8 shadow-xl card-hover relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col h-full ">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi</h3>
                            <p class="text-left font-normal text-gray-700">
                                {{ $site['yayasanProfile']->misi }}
                            </p>
                        </div>
                    </div>

                    <!-- Tujuan Card -->
                    <div class="bg-white border border-gray-200 glass-card rounded-3xl p-8 shadow-xl card-hover relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col h-full ">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-teal-500/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Tujuan</h3>
                            <p class="text-left font-normal text-gray-700">
                                {{ $site['yayasanProfile']->tujuan }}
                            </p>
                        </div>
                    </div>

                    <!-- Makna Logo Card -->
                    <div class="bg-white border border-gray-200 glass-card rounded-3xl p-8 shadow-xl card-hover relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col h-full ">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-500/10 to-red-500/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Makna Logo</h3>
                            <p class="text-left font-normal text-gray-700">
                                {{ $site['yayasanProfile']->makna_logo }}
                            </p>
                        </div>
                    </div>
                </div>
                </div>
         {{-- <section class="py-20 gradient-bg">
                <div class="container mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-black mb-6">
                        Dampak Kami
                    </h2>
                    <p class="text-xl text-black/90 max-w-3xl mx-auto">
                        Pencapaian yang telah kami raih dalam perjalanan membangun masa depan yang lebih baik
                    </p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-5xl font-bold text-black mb-2">500+</div>
                    <div class="text-black/80">Penerima Manfaat</div>
                </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-5xl font-bold text-black mb-2">50+</div>
                    <div class="text-black/80">Program Aktif</div>
                </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-5xl font-bold text-black mb-2">25+</div>
                    <div class="text-black/80">Mitra Strategis</div>
                </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-5xl font-bold text-black mb-2">15+</div>
                    <div class="text-black/80">Penelitian Published</div>
                </div> --}}
            </div>
        </div>
    </section>
    </section>
    </div>
     <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</body>
<x-footer />


</html>
