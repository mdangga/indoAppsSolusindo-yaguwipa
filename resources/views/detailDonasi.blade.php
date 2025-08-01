<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bantu Pendidikan 50 Anak Yatim di Bogor - Detail Campaign</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:300,400,500,600,700"
        rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', 'Instrument Sans', sans-serif;
        }

        .elegant-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #f1f5f9 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            background: linear-gradient(90deg, #059669, #10b981);
            border-radius: 50px;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .donor-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border: 1px solid #e5e7eb;
        }

        .verification-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 500;
        }

        .status-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 6px 16px;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .category-badge {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 6px 16px;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .hero-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 24px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                    <h1 class="text-lg font-semibold text-gray-900">Detail Campaign</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-share-alt text-lg"></i>
                    </button>
                    <button class="text-gray-600 hover:text-orange-600 transition-colors">
                        <i class="fas fa-bookmark text-lg"></i>
                    </button>
                    <button
                        class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-full font-medium transition-colors shadow-lg">
                        <i class="fas fa-heart mr-2"></i>Donasi Sekarang
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white pt-20 pb-12">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Campaign Header -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 lg:p-12 shadow-sm border border-gray-100"
                data-aos="fade-up">

                <!-- Badges Row -->
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span
                        class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                        <i class="fas fa-circle text-green-500 text-xs mr-2"></i>Campaign Aktif
                    </span>
                    <span
                        class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        <i class="fas fa-graduation-cap mr-2"></i>Pendidikan
                    </span>
                    <span
                        class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">
                        <i class="fas fa-shield-check mr-2"></i>Terverifikasi
                    </span>
                </div>

                <!-- Title & Description -->
                <div class="grid lg:grid-cols-2 gap-12 items-start">
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            Bantu Pendidikan 50 Anak Yatim di Bogor
                        </h1>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Mari bersama mewujudkan mimpi anak-anak yatim di Panti Asuhan Al-Husna untuk mendapatkan
                            pendidikan yang layak dan berkelanjutan.
                        </p>

                        <!-- Organization Info -->
                        <div class="flex items-center space-x-4 p-4 bg-white rounded-xl border border-gray-200">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-hands-helping text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Yayasan Peduli Yatim Indonesia</h3>
                                <p class="text-sm text-gray-600">Organisasi terpercaya sejak 2018</p>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Stats -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200">
                        <!-- Progress Section -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Progress Campaign</h3>
                                <span class="text-2xl font-bold text-green-600">52%</span>
                            </div>

                            <div class="bg-gray-200 rounded-full h-4 mb-4 overflow-hidden">
                                <div class="progress-bar h-full rounded-full" style="width: 52%"></div>
                            </div>

                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900 mb-1">Rp 23.450.000</div>
                                    <div class="text-sm text-gray-600">Terkumpul</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900 mb-1">Rp 45.000.000</div>
                                    <div class="text-sm text-gray-600">Target</div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Stats -->
                        <div class="grid grid-cols-3 gap-4 mb-8 p-4 bg-gray-50 rounded-xl">
                            <div class="text-center">
                                <div class="text-xl font-bold text-orange-600">89</div>
                                <div class="text-xs text-gray-600">Donatur</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-blue-600">18</div>
                                <div class="text-xs text-gray-600">Hari Tersisa</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl font-bold text-purple-600">50</div>
                                <div class="text-xs text-gray-600">Anak</div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <button
                            class="w-full bg-orange-600 hover:bg-orange-700 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-heart mr-2"></i>Donasi Sekarang
                        </button>
                        <p class="text-center text-xs text-gray-500 mt-2">Pembayaran 100% aman & terpercaya</p>
                    </div>
                </div>
            </div>

            <!-- Campaign Image & Features -->
            <div class="grid lg:grid-cols-3 gap-8 mt-12">
                <!-- Main Image Area (now empty) -->
                <div class="lg:col-span-2 bg-gray-100 rounded-2xl flex items-center justify-center min-h-64"
                    data-aos="fade-right">
                    <div class="text-center p-8">
                        <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Gambar kampanye</p>
                    </div>
                </div>

                <!-- Features List -->
                <div class="space-y-4" data-aos="fade-left" data-aos-delay="200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Yang Akan Diterima Anak-anak:</h3>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 p-4 bg-green-50 rounded-xl border border-green-100">
                            <div
                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-graduation-cap text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Biaya SPP</h4>
                                <p class="text-sm text-gray-600">Selama 1 tahun penuh untuk 50 anak</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div
                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tshirt text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Seragam & Sepatu</h4>
                                <p class="text-sm text-gray-600">Lengkap dan berkualitas baik</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-purple-50 rounded-xl border border-purple-100">
                            <div
                                class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-book text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Buku & Alat Tulis</h4>
                                <p class="text-sm text-gray-600">Materi pelajaran dan perlengkapan</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-4 bg-orange-50 rounded-xl border border-orange-100">
                            <div
                                class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-laptop text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Fasilitas Digital</h4>
                                <p class="text-sm text-gray-600">E-learning & bimbingan belajar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Urgency Banner -->
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mt-6">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-clock text-red-500"></i>
                            <div>
                                <h4 class="font-semibold text-red-800">Waktu Terbatas!</h4>
                                <p class="text-sm text-red-600">Hanya tersisa 18 hari untuk mencapai target</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Left Column - Main Content -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Deskripsi Campaign -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Tentang Campaign Ini</h2>

                    <div class="mb-6 bg-gray-100 rounded-xl flex items-center justify-center min-h-48">
                        <div class="text-center p-8">
                            <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500">Gambar Panti Asuhan Al-Husna Bogor</p>
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        <p class="mb-4">
                            <strong>Panti Asuhan Al-Husna</strong> di Bogor merupakan rumah bagi 50 anak yatim berusia
                            6-17 tahun.
                            Mereka sangat membutuhkan bantuan untuk melanjutkan pendidikan yang sempat terhenti karena
                            keterbatasan biaya.
                        </p>

                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Yang Akan Kami Berikan:</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-graduation-cap text-orange-500"></i>
                                    <span>Biaya SPP sekolah selama 1 tahun (50 anak)</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-tshirt text-orange-500"></i>
                                    <span>Seragam sekolah lengkap</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-book text-orange-500"></i>
                                    <span>Buku pelajaran dan LKS</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-pencil-alt text-orange-500"></i>
                                    <span>Alat tulis dan perlengkapan sekolah</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-laptop text-orange-500"></i>
                                    <span>Fasilitas pembelajaran online</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-award text-orange-500"></i>
                                    <span>Program bimbingan belajar</span>
                                </div>
                            </div>
                        </div>

                        <p class="font-medium text-gray-900">
                            Dengan donasi Anda, 50 anak yatim ini dapat melanjutkan pendidikan dan meraih cita-cita
                            mereka.
                            Setiap rupiah yang terkumpul akan dikelola dengan transparan dan dilaporkan secara berkala.
                        </p>
                    </div>
                </div>

                <!-- Daftar Donatur -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100" data-aos="fade-up">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Donatur Terbaru</h2>
                        <span class="text-sm text-gray-500">89 orang telah berdonasi</span>
                    </div>

                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <!-- Donatur 1 -->
                        <div class="donor-card p-4 rounded-xl card-hover">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                        IH
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Ibu Hendra</h4>
                                        <p class="text-sm text-gray-600">1 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-orange-600">Rp 300.000</p>
                                    <p class="text-xs text-gray-500">Semoga bermanfaat untuk adik-adik</p>
                                </div>
                            </div>
                        </div>

                        <!-- Donatur 2 -->
                        <div class="donor-card p-4 rounded-xl card-hover">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                        RS
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Rahmat Santoso</h4>
                                        <p class="text-sm text-gray-600">3 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-orange-600">Rp 500.000</p>
                                    <p class="text-xs text-gray-500">Untuk masa depan anak-anak bangsa</p>
                                </div>
                            </div>
                        </div>

                        <!-- Donatur 3 -->
                        <div class="donor-card p-4 rounded-xl card-hover">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                        AM
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Ahmad Maulana</h4>
                                        <p class="text-sm text-gray-600">5 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-orange-600">Rp 200.000</p>
                                    <p class="text-xs text-gray-500">Barakallahu fiikum</p>
                                </div>
                            </div>
                        </div>

                        <!-- Donatur 4 - Top Donor -->
                        <div class="donor-card p-4 rounded-xl card-hover border-2 border-orange-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm relative">
                                        <i class="fas fa-crown"></i>
                                        <div
                                            class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full flex items-center justify-center">
                                            <i class="fas fa-star text-xs text-yellow-800"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Donatur Terbesar</h4>
                                        <p class="text-sm text-gray-600">8 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-orange-600">Rp 2.500.000</p>
                                    <p class="text-xs text-gray-500">Lillahi ta'ala</p>
                                </div>
                            </div>
                        </div>

                        <!-- Donatur 5 -->
                        <div class="donor-card p-4 rounded-xl card-hover">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                        SP
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Sari Purnama</h4>
                                        <p class="text-sm text-gray-600">12 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-orange-600">Rp 150.000</p>
                                    <p class="text-xs text-gray-500">Semoga berkah</p>
                                </div>
                            </div>
                        </div>

                        <!-- Donatur 6 -->
                        <div class="donor-card p-4 rounded-xl card-hover">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                        DW
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Dedi Wijaya</h4>
                                        <p class="text-sm text-gray-600">1 hari yang lalu</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-orange-600">Rp 400.000</p>
                                    <p class="text-xs text-gray-500">Untuk pendidikan anak yatim</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <button class="text-orange-600 hover:text-orange-800 font-medium transition-colors">
                            Lihat Semua 89 Donatur <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">

                <!-- Statistik -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left"
                    data-aos-delay="100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Campaign</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Hari tersisa</span>
                            <span class="font-semibold text-orange-600">18 hari</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Rata-rata donasi</span>
                            <span class="font-semibold text-gray-900">Rp 263.483</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Donasi terbesar</span>
                            <span class="font-semibold text-orange-600">Rp 2.500.000</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Campaign dimulai</span>
                            <span class="font-semibold text-gray-900">10 Des 2024</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Lokasi</span>
                            <span class="font-semibold text-gray-900">Bogor, Jawa Barat</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-2">Target per hari</p>
                            <p class="text-lg font-bold text-orange-600">Rp 1.197.222</p>
                            <p class="text-xs text-gray-500">untuk mencapai target</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Donation Button -->
                <div class="fixed bottom-6 right-6 z-50">
                    <button
                        class="bg-orange-600 hover:bg-orange-700 text-white p-4 rounded-full shadow-2xl transform hover:scale-110 transition-all duration-300 pulse-animation">
                        <i class="fas fa-heart text-xl"></i>
                    </button>
                </div>

                <style>
                    .pulse-animation {
                        animation: pulse 2s infinite;
                    }

                    @keyframes pulse {
                        0% {
                            box-shadow: 0 0 0 0 rgba(234, 88, 12, 0.7);
                        }

                        70% {
                            box-shadow: 0 0 0 20px rgba(234, 88, 12, 0);
                        }

                        100% {
                            box-shadow: 0 0 0 0 rgba(234, 88, 12, 0);
                        }
                    }
                </style>

                <script>
                    AOS.init({
                        duration: 1000,
                        once: true
                    });

                    // Donation button functionality
                    document.querySelectorAll('button').forEach(button => {
                        button.addEventListener('click', function(e) {
                            if (this.textContent.includes('Donasi') || this.innerHTML.includes('fa-heart')) {
                                e.preventDefault();
                                showDonationModal();
                            }
                        });
                    });

                    // Donation modal simulation
                    function showDonationModal() {
                        alert(
                            'Mengarahkan ke halaman pembayaran...\n\nMetode pembayaran tersedia:\n• Transfer Bank\n• E-Wallet (GoPay, OVO, DANA)\n• Virtual Account\n• QRIS'
                        );
                    }

                    // Progress bar animation
                    window.addEventListener('load', function() {
                        const progressBar = document.querySelector('.progress-bar');
                        if (progressBar) {
                            progressBar.style.width = '0%';
                            setTimeout(() => {
                                progressBar.style.width = '52%';
                                progressBar.style.transition = 'width 2s ease-in-out';
                            }, 500);
                        }
                    });

                    // Share functionality
                    document.querySelectorAll('.fab').forEach(icon => {
                        icon.closest('button').addEventListener('click', function(e) {
                            e.preventDefault();
                            const platform = this.querySelector('i').classList[1].split('-')[1];
                            alert(`Membagikan campaign ke ${platform.toUpperCase()}...`);
                        });
                    });

                    // Smooth scroll for internal links
                    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                        anchor.addEventListener('click', function(e) {
                            e.preventDefault();
                            const target = document.querySelector(this.getAttribute('href'));
                            if (target) {
                                target.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    });

                    // Update live statistics (simulation)
                    setInterval(() => {
                        const currentAmount = 23450000;
                        const randomIncrease = Math.floor(Math.random() * 50000) + 10000;
                        // This would normally update from server
                    }, 30000);
                </script>

</body>

</html>
