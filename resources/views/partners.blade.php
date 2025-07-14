<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Partners Yaguwipa</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* html, body {
            height: 100%;
            overflow-x: hidden;
        } */
        
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .partner-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }
        
        .partner-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .partner-card:hover::before {
            left: 100%;
        }
        
        .partner-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }
        
        .partner-logo {
            transition: all 0.4s ease;
            filter: grayscale(20%) brightness(0.9);
        }
        
        .partner-card:hover .partner-logo {
            filter: grayscale(0%) brightness(1);
            transform: scale(1.05);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hero-background {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 400% 400%;
            animation: gradient-flow 15s ease infinite;
        }
        
        @keyframes gradient-flow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }
        
        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }
        
        @keyframes float {
            from { transform: translateY(100vh) rotate(0deg); }
            to { transform: translateY(-100vh) rotate(360deg); }
        }
        
        .stagger-animation {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(40px);
        }
        
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
            position: relative;
            z-index: 2;
        }
        
        .title-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, transparent);
            margin: 2rem 0;
        }
        
        .partner-website-link {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .partner-card:hover .partner-website-link {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* .partner-name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        } */
        
        @media (max-width: 640px) {
            .partner-card {
                padding: 1.5rem;
            }
            
            .partner-logo-container {
                width: 5rem;
                height: 5rem;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="floating-shape w-20 h-20 left-[10%]" style="animation-delay: 0s; animation-duration: 25s;"></div>
        <div class="floating-shape w-32 h-32 left-[70%]" style="animation-delay: -5s; animation-duration: 30s;"></div>
        <div class="floating-shape w-16 h-16 left-[30%]" style="animation-delay: -10s; animation-duration: 20s;"></div>
        <div class="floating-shape w-24 h-24 left-[80%]" style="animation-delay: -15s; animation-duration: 35s;"></div>
    </div>

    <div class="main-container">
        <!-- Header -->
        <header class="absolute w-full z-50">
            <!-- Logo dan Login Button -->
            <div class="w-full bg-transparent p-6 lg:px-8">
                <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
                    <!-- Logo -->
                    <div class="flex justify-start">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-[75px] w-auto drop-shadow-lg" src="img/logo.png" alt="Company Logo" />
                        </a>
                    </div>

                    <div class="hidden lg:block"></div>

                    <!-- tombol Login -->
                    <div class="hidden justify-end items-center lg:flex">
                        <a href="#" class="glass-effect text-sm font-semibold text-gray-900 rounded-[50px] px-6 py-3.5 hover:bg-white/20 transition-all duration-300 shadow-lg">
                            Log in
                        </a>
                    </div>

                    <!-- tombol menu -->
                    <div class="flex lg:hidden justify-end">
                        <button type="button" id="mobile-menu-button" class="glass-effect -m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:bg-white/20 transition-all duration-300">
                            <span class="sr-only">Open main menu</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- fixed navbar -->
            <nav class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
                <div class="navbar-glass h-[50px] px-6 flex justify-center items-center rounded-[75px] shadow-lg">
                    <div class="flex gap-x-12">
                        <a href="#" class="text-sm font-semibold text-gray-900 border-b-2 border-amber-200 transition duration-200">
                            Beranda
                        </a>
                        <div class="inline-flex items-center relative group">
                            <a href="#" class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                                Tentang Kami
                            </a>
                            <div class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg py-2 opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200 min-w-[160px]">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100 transform translate-x-0.5">Visi & Misi</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Struktur Organisasi</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Sejarah</a>
                            </div>
                        </div>
                        <a href="#" class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                            Program
                        </a>
                        <a href="#" class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                            Kegiatan
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="lg:hidden fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-black/25 backdrop-blur-sm"></div>
                <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white/95 backdrop-blur-lg p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto" src="img/LOGO_YAYASAN.png" alt="" />
                        </a>
                        <button type="button" id="close-menu-button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Close menu</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Beranda</a>
                                <a href="#test" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Tentang Kami</a>
                                <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Program</a>
                                <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Kegiatan</a>
                            </div>
                            <div class="py-6">
                                <a href="#" class="-mx-3 block px-3 py-2.5 text-base/7 font-semibold text-gray-900 rounded-full hover:bg-gray-50">Log in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="content-wrapper">
            <div class="px-7 pt-32 lg:px-4">
                <!-- Hero Section -->
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 text-center sm:text-4xl mb-8">
                        Partners Yaguwipa
                    </h1>
                    {{-- <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12 leading-relaxed">
                        Bersama-sama membangun masa depan yang lebih baik melalui kolaborasi strategis dengan mitra terpercaya di berbagai bidang industri.
                    </p> --}}
                </div>
                    <!-- Partners Grid -->
                    <div class="px-10 sm:px-6 lg:px-14 py-20">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                        <!-- PT Indo Apps Solusindo -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.1s;" data-aos="zoom-in" data-aos-delay="100">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/pt-indo-apps-solusindo.png" alt="PT Indo Apps Solusindo" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">PT Indo Apps Solusindo</h3>
                                 {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                               
                            </div>
                        </div>

                        <!-- Denpasar Institute -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.2s;" data-aos="zoom-in" data-aos-delay="200">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/denpasar-institute.png" alt="Denpasar Institute" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Denpasar Institute</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                                
                            </div>
                        </div>

                        <!-- GCOM -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.3s;" data-aos="zoom-in" data-aos-delay="300">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/gcom.png" alt="GCOM" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">GCOM</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Indo Berkah Konstruksi -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.4s;" data-aos="zoom-in" data-aos-delay="400">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/indo-berkah-konstruksi.png" alt="Indo Berkah Konstruksi" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Indo Berkah Konstruksi</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Indo Consulting -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.5s;" data-aos="zoom-in" data-aos-delay="500">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/indo-consulting.png" alt="Indo Consulting" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Indo Consulting</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Latifaba -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.6s;" data-aos="zoom-in" data-aos-delay="600">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/latifaba.png" alt="Latifaba" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Latifaba</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Nyaman Care -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.7s;" data-aos="zoom-in" data-aos-delay="700">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/nyaman-care.png" alt="Nyaman Care" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Nyaman Care</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Penerbit Yaguwipa -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.8s;" data-aos="zoom-in" data-aos-delay="800">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/penerbit-yaguwipa.png" alt="Penerbit Yaguwipa" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Penerbit Yaguwipa</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Robotic -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 0.9s;" data-aos="zoom-in" data-aos-delay="900">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/robotic.png" alt="Robotic" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Robotic</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Teknika Solusinda -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/40 stagger-animation" style="animation-delay: 1.0s;" data-aos="zoom-in" data-aos-delay="1000">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/teknika-solusinda.png" alt="Teknika Solusinda" class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Teknika Solusinda</h3>
                                <span class="text-gray-500 text-xs mt-2">Partner</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="text-center pb-16" data-aos="fade-up" data-aos-delay="1200">
                    <div class="glass-effect rounded-3xl p-12 max-w-4xl mx-auto">
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
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
                        info@yayasan-gunawidyaparama.com