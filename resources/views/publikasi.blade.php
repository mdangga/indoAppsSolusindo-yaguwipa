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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- custom styling --}}
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    {{-- navbar --}}
    {{-- <x-navbar :menus="$menus" /> --}}

   <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publikasi Yayasan Guna Widya Paramesti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .article-card {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            border-left: 4px solid #667eea;
        }
        
        .download-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            transition: all 0.3s ease;
        }
        
        .download-btn:hover {
            background: linear-gradient(45deg, #764ba2, #667eea);
            transform: scale(1.05);
        }
        
        .status-badge {
            background: linear-gradient(45deg, #10b981, #059669);
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 10px #10b981; }
            to { box-shadow: 0 0 20px #10b981, 0 0 30px #10b981; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header with gradient background -->
    <div class="gradient-bg py-8 mb-8">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold mb-2 fade-in">Publikasi Yayasan Guna Widya Paramesti</h1>
                <p class="text-lg opacity-90 fade-in">Advancing Knowledge Through Research & Innovation</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <!-- Latest Publication Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 card-hover fade-in">
            <div class="flex items-center mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full mr-4"></div>
                <h2 class="text-3xl font-bold text-gray-800">Terbitan Terkini</h2>
                <div class="ml-auto">
                    <span class="status-badge text-white px-4 py-2 rounded-full text-sm font-semibold">
                        ✨ Baru Diterbitkan
                    </span>
                </div>
            </div>
            
            <div class="lg:flex gap-8 items-start">
                <!-- Cover & Logo Section -->
                <div class="lg:w-1/3 mb-6 lg:mb-0">
                    <div class="text-center">
                        <!-- Logo -->
                        <div class="mb-6">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto shadow-lg">
                                <span class="text-white font-bold text-xs text-center leading-tight">GWP</span>
                            </div>
                        </div>
                        
                        <!-- Cover -->
                        <div class="relative group">
                            <div class="w-64 h-80 bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg shadow-xl mx-auto overflow-hidden">
                                <div class="p-6 h-full flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800 mb-2">Publikasi Yayasan</h3>
                                        <h4 class="text-xl font-bold text-blue-600 mb-2">GUNA WIDYA PARAMESTI</h4>
                                        <p class="text-xs text-gray-600 mb-4">Research & Innovation</p>
                                        <div class="h-24 bg-gradient-to-br from-blue-200 to-purple-200 rounded-lg mb-4 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p>Vol. 1 No. 2</p>
                                        <p>Juni 2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Journal Details -->
                <div class="lg:w-2/3">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            Vol 1 No 2 (2025): Yayasan Guna Widya Paramesthi
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <p class="text-gray-700 mb-2 flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM4 8h12v8H4V8z"/>
                                </svg>
                                <strong>Periode:</strong> Juni 2025
                            </p>
                            <p class="text-gray-700 mb-2 flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                                <strong>Diterbitkan:</strong> 30 Juni 2025
                            </p>
                            <p class="text-gray-700 flex items-center">
                                <svg class="w-5 h-5 text-purple-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                                <strong>Jumlah Artikel:</strong> 8 Artikel
                            </p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <button class="download-btn text-white px-6 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3 font-semibold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Cover
                        </button>
                        <button class="download-btn text-white px-6 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3 font-semibold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lihat Daftar Isi
                        </button>
                    </div>
                    
                    <!-- Statistics -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">2.5k</div>
                            <div class="text-sm text-gray-600">Total Views</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">847</div>
                            <div class="text-sm text-gray-600">Downloads</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">156</div>
                            <div class="text-sm text-gray-600">Citations</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Articles Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 fade-in">
            <div class="flex items-center mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-green-500 to-blue-600 rounded-full mr-4"></div>
                <h4 class="text-2xl font-bold text-gray-800">Artikel dalam Terbitan Ini</h4>
            </div>
            
            <div class="grid gap-6">
                <!-- Article 1 -->
                <div class="article-card p-6 rounded-lg card-hover">
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-3 flex-shrink-0"></div>
                        <div class="flex-1">
                            <h5 class="text-lg font-semibold text-gray-800 mb-2 hover:text-blue-600 cursor-pointer transition-colors">
                                Implementasi Machine Learning untuk Prediksi Cuaca Berbasis IoT
                            </h5>
                            <p class="text-gray-600 text-sm mb-3">
                                Penelitian ini mengeksplorasi penggunaan algoritma machine learning dalam sistem prediksi cuaca yang terintegrasi dengan Internet of Things (IoT) untuk meningkatkan akurasi prediksi...
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                    </svg>
                                    Dr. I Made Sukarsa, M.Kom
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                    Hal. 1-15
                                </span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Open Access</span>
                            </div>
                        </div>
                        <button class="bg-gray-100 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Article 2 -->
                <div class="article-card p-6 rounded-lg card-hover">
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-3 flex-shrink-0"></div>
                        <div class="flex-1">
                            <h5 class="text-lg font-semibold text-gray-800 mb-2 hover:text-blue-600 cursor-pointer transition-colors">
                                Analisis Keamanan Blockchain dalam Sistem E-Voting
                            </h5>
                            <p class="text-gray-600 text-sm mb-3">
                                Studi komprehensif mengenai implementasi teknologi blockchain untuk meningkatkan keamanan dan transparansi dalam sistem pemungutan suara elektronik...
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                    </svg>
                                    Prof. Ni Luh Gede Pivin Suwirmayanti, S.Kom., M.Cs
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                    Hal. 16-28
                                </span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Open Access</span>
                            </div>
                        </div>
                        <button class="bg-gray-100 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Article 3 -->
                <div class="article-card p-6 rounded-lg card-hover">
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-3 flex-shrink-0"></div>
                        <div class="flex-1">
                            <h5 class="text-lg font-semibold text-gray-800 mb-2 hover:text-blue-600 cursor-pointer transition-colors">
                                Optimasi Algoritma Genetika untuk Penjadwalan Mata Kuliah
                            </h5>
                            <p class="text-gray-600 text-sm mb-3">
                                Penerapan algoritma genetika yang dioptimasi untuk menyelesaikan masalah penjadwalan mata kuliah dengan berbagai constraint dan preferensi...
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                    </svg>
                                    Dr. I Gede Santi Astawa, M.Kom
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                    Hal. 29-42
                                </span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Open Access</span>
                            </div>
                        </div>
                        <button class="bg-gray-100 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- View All Articles Button -->
                <div class="text-center pt-4">
                    <button class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 font-semibold">
                        Lihat Semua Artikel (5 lainnya)
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
