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

<body >
{{-- loader --}}
    <x-loader-component />
    {{-- navbar --}}
    <x-navbar :menus="$menus" />
    {{-- floating button --}}
    <x-contact-btt-floating email="{{ $site['yayasanProfile']->email }}"
        phone="{{ $site['yayasanProfile']->telephone }}" size="default" :auto-hide="true" :auto-hide-delay="3000"
        :show-back-to-top="true" :scroll-threshold="200" />
    <div class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
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
           <x-footer />
    </div>
</body>
</html>