@php
    $user = auth()->user();
    $donatur = auth()->user()->UserToDonatur;
    // Generalized user data (mitra/donatur)
    $displayUser = $user->role === 'mitra' ? $user->UserToMitra : $user->UserToDonatur;

    $colorMap = [
        'bg-red-400' => 'hover:bg-red-300',
        'bg-blue-400' => 'hover:bg-blue-300',
        'bg-green-400' => 'hover:bg-green-300',
        'bg-yellow-400' => 'hover:bg-yellow-300',
        'bg-purple-400' => 'hover:bg-purple-300',
        'bg-pink-400' => 'hover:bg-pink-300',
        'bg-teal-400' => 'hover:bg-teal-300',
        'bg-orange-400' => 'hover:bg-orange-300',
    ];

    $colors = array_keys($colorMap);
    $userIdentifier = $user->email ?? $user->id;
    $colorIndex = crc32($userIdentifier) % count($colors);
    $randomBg = $colors[$colorIndex];
    $hoverBg = $colorMap[$randomBg];

    $profilePath = optional($displayUser)->profile_path;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi - Berbagi Kebaikan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->


        <!-- Main Card Layout -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="flex">

                    <!-- Left Side - Stepper -->
                    <div class="w-80 bg-gray-100/60 p-8 rounded-xl border-gray-200">
                        <!-- Stepper -->
                        <div class="flex items-center space-x-3 mb-10">
                            <img src="{{ asset('img/logo.png') }}" alt="Icon Donasi" class="w-12 h-12 rounded-lg" />
                            <div>
                                <h1 class="text-md font-semibold text-gray-800">Form Donasi</h1>
                                <p class="text-xs text-gray-500 leading-snug">Bersama Anda, Kami Membawa<br>Manfaat
                                    untuk Sesama</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <!-- Step 1 -->
                            <div class="flex items-center space-x-4" id="stepper-step1">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                        1
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <div class="text-xs text-gray-500 mb-1">Step 1</div>
                                    <h3 class="text-sm font-medium text-gray-900">Jenis Donasi</h3>
                                    <p class="text-xs text-teal-600 mt-1"></p>
                                </div>
                            </div>

                            <!-- Connector Line -->
                            <div class="ml-4 h-8 w-0.5 bg-gray-300 opacity-50"></div>

                            <!-- Step 2 -->
                            <div class="flex items-center space-x-4" id="stepper-step2">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 bg-gray-200 border-2 border-gray-300 rounded-full flex items-center justify-center text-gray-500 text-sm font-semibold">
                                        2
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <div class="text-xs text-gray-500 mb-1">Step 2</div>
                                    <h3 class="text-sm font-medium text-gray-600">Pembayaran</h3>
                                    <p class="text-xs text-teal-600 mt-1"></p>
                                </div>
                            </div>

                            <!-- Connector Line -->
                            <div class="ml-4 h-8 w-0.5 bg-gray-300 opacity-50"></div>

                            <!-- Step 3 -->
                            <div class="flex items-center space-x-4" id="stepper-step3">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 bg-gray-200 border-2 border-gray-300 rounded-full flex items-center justify-center text-gray-500 text-sm font-semibold">
                                        3
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <div class="text-xs text-gray-500 mb-1">Step 3</div>
                                    <h3 class="text-sm font-medium text-gray-600">Konfirmasi</h3>
                                    <p class="text-xs text-teal-600 mt-1"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Login Link -->
                        {{-- <div class="mt-12 pt-8 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                Already have an account?
                                <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Log in</a>
                            </p>
                        </div> --}}
                    </div>

                    <!-- Right Side - Form -->
                    <div class="flex-1 p-8">
                        {{-- back and profile --}}
                        <div class="max-w-5xl mx-auto mb-4 ">
                            <div class="flex items-center justify-between mb-6">
                                <button id="prevStep"
                                    class="flex items-center text-gray-600 hover:text-gray-800 transition duration-200 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24"
                                        class=" bg-gray-100 rounded-lg mr-2 text-gray-400 hover:text-gray-800 transition">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5" d="m14 7l-5 5l5 5" />
                                    </svg>
                                    <span class="text-sm">Kembali</span>
                                </button>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="text-gray-600 text-sm">Butuh Bantuan?</a>
                                    @if ($profilePath)
                                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar">
                                            <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                                class="w-8 h-8 rounded-full object-cover border-2 border-gray-300 hover:scale-105 transition" />
                                        </button>
                                    @else
                                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                                            class="w-8 h-8 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-md">
                                            {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                                        </button>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <form id="donationForm">

                            <!-- Step 1: Data Donatur -->
                            <div id="step1">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">Jenis Donasi</h2>
                                <p class="text-gray-600 mb-4">Setiap bentuk donasi berarti. Silakan pilih jenis donasi
                                    yang ingin Anda berikan.</p>

                                <div class="space-y-6">
                                    {{-- data diri --}}
                                    {{-- <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-user mr-2 text-teal-500"></i>Nama Lengkap *
                                            </label>
                                            <input type="text" name="nama" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="Masukkan nama lengkap">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-envelope mr-2 text-teal-500"></i>Email *
                                            </label>
                                            <input type="email" name="email" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="nama@email.com">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-phone mr-2 text-teal-500"></i>No. Telepon *
                                            </label>
                                            <input type="tel" name="telepon" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="08xxxxxxxxxx">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-map-marker-alt mr-2 text-teal-500"></i>Kota
                                            </label>
                                            <input type="text" name="kota"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="Kota tempat tinggal">
                                        </div>
                                    </div> --}}

                                    <!-- Jenis Donasi -->
                                    <div class="mt-8">
                                        <label class="block text-sm font-medium text-gray-700 mb-4">
                                            <i class="fas fa-hand-holding-heart mr-2 text-teal-500"></i>Jenis Donasi *
                                        </label>
                                        <div class="grid md:grid-cols-3 gap-4">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="jenis_donasi" value="uang"
                                                    class="sr-only peer" required checked>
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-teal-500 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition duration-200">
                                                    <i class="fas fa-money-bill-wave text-3xl text-green-500 mb-3"></i>
                                                    <h3 class="font-semibold text-gray-800">Donasi Uang</h3>
                                                    <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk uang tunai
                                                    </p>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="jenis_donasi" value="barang"
                                                    class="sr-only peer">
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-teal-500 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition duration-200">
                                                    <i class="fas fa-box text-3xl text-orange-500 mb-3"></i>
                                                    <h3 class="font-semibold text-gray-800">Donasi Barang</h3>
                                                    <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk barang
                                                    </p>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="jenis_donasi" value="jasa"
                                                    class="sr-only peer">
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-teal-500 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition duration-200">
                                                    <i class="fas fa-handshake text-3xl text-purple-500 mb-3"></i>
                                                    <h3 class="font-semibold text-gray-800">Donasi Jasa</h3>
                                                    <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk
                                                        jasa/keahlian</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Detail Donasi Uang -->
                                    <div id="donasi-uang" class="hidden mt-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-coins mr-2 text-teal-500"></i>Nominal Donasi *
                                        </label>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                            <button type="button"
                                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-teal-500 hover:bg-teal-50 transition duration-200"
                                                data-nominal="25000">
                                                Rp 25.000
                                            </button>
                                            <button type="button"
                                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-teal-500 hover:bg-teal-50 transition duration-200"
                                                data-nominal="50000">
                                                Rp 50.000
                                            </button>
                                            <button type="button"
                                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-teal-500 hover:bg-teal-50 transition duration-200"
                                                data-nominal="100000">
                                                Rp 100.000
                                            </button>
                                            <button type="button"
                                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-teal-500 hover:bg-teal-50 transition duration-200"
                                                data-nominal="250000">
                                                Rp 250.000
                                            </button>
                                        </div>
                                        <input type="number" name="nominal" id="nominal-input"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                            placeholder="Atau masukkan nominal lainnya" min="10000">
                                    </div>

                                    <!-- Detail Donasi Barang -->
                                    <div id="donasi-barang" class="hidden mt-6">
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-tag mr-2 text-teal-500"></i>Jenis Barang *
                                                </label>
                                                <select name="jenis_barang"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200">
                                                    <option value="">Pilih jenis barang</option>
                                                    <option value="pakaian">Pakaian</option>
                                                    <option value="makanan">Makanan</option>
                                                    <option value="elektronik">Elektronik</option>
                                                    <option value="buku">Buku</option>
                                                    <option value="mainan">Mainan</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-weight mr-2 text-teal-500"></i>Estimasi Nilai (Rp)
                                                </label>
                                                <input type="number" name="nilai_barang"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                    placeholder="Estimasi nilai barang">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-clipboard-list mr-2 text-teal-500"></i>Deskripsi
                                                Barang *
                                            </label>
                                            <textarea name="deskripsi_barang" rows="4"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="Jelaskan kondisi dan detail barang yang akan didonasikan"></textarea>
                                        </div>
                                    </div>

                                    <!-- Detail Donasi Jasa -->
                                    <div id="donasi-jasa" class="hidden mt-6">
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-tools mr-2 text-teal-500"></i>Jenis Jasa *
                                                </label>
                                                <select name="jenis_jasa"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200">
                                                    <option value="">Pilih jenis jasa</option>
                                                    <option value="mengajar">Mengajar/Pelatihan</option>
                                                    <option value="kesehatan">Layanan Kesehatan</option>
                                                    <option value="teknologi">IT/Teknologi</option>
                                                    <option value="konstruksi">Konstruksi/Renovasi</option>
                                                    <option value="transportasi">Transportasi</option>
                                                    <option value="konsultasi">Konsultasi</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-clock mr-2 text-teal-500"></i>Estimasi Waktu
                                                </label>
                                                <input type="text" name="waktu_jasa"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                    placeholder="Contoh: 2 jam, 1 hari, dll">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-clipboard-list mr-2 text-teal-500"></i>Deskripsi Jasa
                                                *
                                            </label>
                                            <textarea name="deskripsi_jasa" rows="4"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="Jelaskan jasa/keahlian yang bisa Anda berikan"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-8">
                                    <button type="button" id="nextStep1"
                                        class="bg-teal-500 text-white px-8 py-3 rounded-full w-full font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Pembayaran -->
                            <div id="step2" class="hidden">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">Metode Pembayaran</h2>
                                <p class="text-gray-600 mb-4">Pilih metode pembayaran yang Anda inginkan untuk
                                    menyelesaikan donasi.</p>

                                <!-- Payment Methods untuk Donasi Uang -->
                                <div id="payment-methods" class="hidden space-y-4">
                                    <!-- E-Wallet -->
                                    <div class="border-2 border-gray-200 rounded-lg p-6">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                            <i class="fas fa-mobile-alt mr-2 text-teal-500"></i>E-Wallet
                                        </h3>
                                        <div class="grid md:grid-cols-4 gap-4">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="gopay"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-20">
                                                    <svg class="w-32 h-auto" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 63 16">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <path fill="#FFF" fill-opacity=".01"
                                                                d="M0 0h63v16H0z" />
                                                            <g transform="translate(0 1.143)">
                                                                <ellipse cx="6.811" cy="6.857" fill="#00AED6"
                                                                    fill-rule="nonzero" rx="6.811"
                                                                    ry="6.857" />
                                                                <path fill="#FFF"
                                                                    d="M10.778 6.644a1.587 1.587 0 0 0-1.652-1.5H4.824a.285.285 0 0 1-.284-.286c0-.158.127-.286.284-.286h4.359a1.36 1.36 0 0 0-.993-1.26 11 11 0 0 0-3.84 0 1.82 1.82 0 0 0-1.362 1.526 13.7 13.7 0 0 0 0 4.06 1.92 1.92 0 0 0 1.552 1.526 19 19 0 0 0 4.748 0 1.67 1.67 0 0 0 1.317-1.44c.14-.772.199-1.556.173-2.34m-1.413.96v.254a.285.285 0 0 1-.284.286.285.285 0 0 1-.284-.286v-.254a.427.427 0 0 1 .284-.746.427.427 0 0 1 .284.746" />
                                                            </g>
                                                            <path
                                                                d="M18.937 11.414a2.92 2.92 0 0 0 2.545 1.252c1.187 0 2.059-.763 2.059-1.8v-.547h-.029a3.22 3.22 0 0 1-2.444.922 3.96 3.96 0 0 1-3.513-1.94 4.01 4.01 0 0 1-.037-4.033 3.96 3.96 0 0 1 3.478-2.002 3.4 3.4 0 0 1 2.516.892h.029V3.41h2.03v7.428c0 2.159-1.7 3.656-4.089 3.656a4.87 4.87 0 0 1-4.06-1.814zm4.519-4.622c0-.863-.973-1.655-2.059-1.655-1.373 0-2.288.835-2.288 2.087-.04.594.18 1.175.605 1.588a2 2 0 0 0 1.597.557c1.187 0 2.145-.748 2.145-1.684zm7.46-3.598c2.474 0 4.276 1.77 4.276 4.03s-1.802 4.031-4.276 4.031a4 4 0 0 1-3.692-1.935 4.06 4.06 0 0 1 0-4.191 4 4 0 0 1 3.692-1.935m0 1.87a2.15 2.15 0 0 0-2.13 2.17 2.15 2.15 0 0 0 2.15 2.15 2.15 2.15 0 0 0 2.14-2.16 2.08 2.08 0 0 0-.605-1.562 2.05 2.05 0 0 0-1.555-.597zM36.29 3.41h2.03v.676h.03a3.36 3.36 0 0 1 2.444-.892c2.18.04 3.928 1.828 3.932 4.023.004 2.196-1.738 3.99-3.918 4.038-.86.02-1.7-.265-2.373-.806h-.029v3.829H36.29zm4.176 1.67c-1.116 0-2.06.791-2.06 1.655v.964c0 .922.916 1.684 2.073 1.684a2.145 2.145 0 0 0 2.131-2.158 2.145 2.145 0 0 0-2.144-2.146zm8.337 1.41c1.387-.187 1.802-.388 1.802-.777 0-.504-.53-.806-1.344-.806a1.79 1.79 0 0 0-1.888 1.367l-2.002-.417c.286-1.555 1.874-2.663 3.832-2.663 2.216 0 3.59 1.137 3.59 2.993v4.852H50.89v-.835h-.03a3.12 3.12 0 0 1-2.559 1.051c-1.673 0-2.83-.921-2.83-2.275 0-1.425.943-2.159 3.331-2.49zm1.973.806h-.028c-.187.274-.587.432-1.616.62-1.244.23-1.687.474-1.687.92 0 .461.372.663 1.172.663 1.216 0 2.16-.562 2.16-1.296zm6.044 3.326L53.317 3.41h2.331l2.302 4.98h.028l2.274-4.98h2.345L57.35 14.278h-2.331z"
                                                                fill="#000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg>

                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="ovo"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-20">

                                                    <svg class="w-[111px] h-auto" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 77 24">
                                                        <path
                                                            d="M21.19 20.24a12.54 12.54 0 0 1-8.8 3.45 12.6 12.6 0 0 1-8.85-3.45 11.68 11.68 0 0 1 0-16.77A12.55 12.55 0 0 1 12.4 0a12.54 12.54 0 0 1 8.8 3.45 11.67 11.67 0 0 1 0 16.77M12.4 3.86a7.73 7.73 0 0 0-7.8 8 7.78 7.78 0 1 0 15.56 0 7.73 7.73 0 0 0-7.76-8m38-1.07L40.89 24l-.54-.1c-2.72-.49-3.27-1.17-4.54-3.93L28.68 4.44H26V.67h10.13v3.77h-2.42l5.73 12.85L45 4.44h-3V.67h8.4Zm23 17.45a13 13 0 0 1-17.64 0 11.68 11.68 0 0 1 0-16.77 13 13 0 0 1 17.64 0 11.65 11.65 0 0 1 0 16.77M64.65 3.86a7.74 7.74 0 0 0-7.81 8 7.78 7.78 0 1 0 15.56 0 7.72 7.72 0 0 0-7.75-8"
                                                            fill="#4b2489" fill-rule="evenodd" />
                                                    </svg>

                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="dana"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-20">
                                                    <svg class="w-30 h-auto" data-name="Layer 1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 148 42.316">
                                                        <path
                                                            d="M58.502 32.095c2.813 0.201 6.091 -1.983 7.245 -3.231 4.014 -4.343 4.111 -10.624 0.07 -15.172 -1.503 -1.693 -5.036 -3.564 -7.272 -3.301H50.451v21.677l8.07 0.027Zm-3.487 -4.696V15.059a29.307 29.307 0 0 1 3.805 0 5.891 5.891 0 0 1 2.762 1.069c4.65 3.177 2.712 10.751 -2.84 11.259a27.842 27.842 0 0 1 -3.727 0.012m74.539 4.735h4.614v-4.672h9.155l0.027 4.65h4.614V24.408c0 -2.325 0.193 -5.222 -0.388 -7.327a9.151 9.151 0 0 0 -17.624 -0.097c-0.62 2.076 -0.411 5.056 -0.411 7.361 0 2.604 -0.027 5.222 0 7.826Zm4.618 -9.372c-0.027 -1.937 -0.232 -4.01 0.678 -5.502a4.499 4.499 0 0 1 3.932 -2.235 4.572 4.572 0 0 1 3.905 2.255c0.899 1.55 0.686 3.487 0.662 5.486Zm-57.387 9.369h4.599c0 -0.977 -0.124 -3.964 0.042 -4.672h9.12l0.031 4.669h4.606c-0.023 -2.588 0 -5.172 0 -7.749 0 -2.208 0.205 -5.37 -0.388 -7.33a9.155 9.155 0 0 0 -17.624 -0.089c-0.616 2.015 -0.407 5.095 -0.407 7.338 0 2.588 -0.058 5.242 0 7.822Zm4.603 -9.368c-0.031 -1.937 -0.229 -4.037 0.682 -5.498a4.537 4.537 0 0 1 7.838 0c0.903 1.55 0.686 3.518 0.67 5.49Zm21.89 -3.905 -0.066 3.227c0 2.712 -0.132 7.776 0 9.98h4.51c0.105 -1.55 -0.163 -12.557 0.12 -12.909 0 -2.139 2.235 -4.13 4.491 -4.138a4.506 4.506 0 0 1 3.146 1.255c0.574 0.523 1.453 1.717 1.438 2.921 0.21 0.12 0.042 11.623 0.108 12.898h4.513l-0.035 -13.154c0.112 -1.031 -0.508 -2.623 -0.906 -3.429a9.128 9.128 0 0 0 -16.377 -0.139c-0.388 0.794 -1.038 2.43 -0.941 3.487"
                                                            style="fill:#008ceb;fill-rule:evenodd" />
                                                        <path cx="54.61" cy="54.61" r="54.61"
                                                            style="fill:#008ceb"
                                                            d="M42.316 21.158a21.16 21.16 0 0 1 -21.157 21.157A21.16 21.16 0 0 1 0 21.158a21.158 21.158 0 0 1 42.316 0" />
                                                        <path
                                                            d="M33.486 21.247v5.955c0 0.388 -0.166 0.469 -0.492 0.279a10.99 10.99 0 0 0 -1.356 -0.689 9.18 9.18 0 0 0 -4.452 -0.593 21.248 21.248 0 0 0 -4.82 1.209c-1.55 0.523 -3.068 1.089 -4.65 1.526a12.968 12.968 0 0 1 -4.037 0.53 8.572 8.572 0 0 1 -4.262 -1.329 1.048 1.048 0 0 1 -0.507 -0.938V15.498c0 -0.19 0 -0.415 0.171 -0.511s0.345 0.062 0.492 0.159a8.133 8.133 0 0 0 4.707 1.395 12.529 12.529 0 0 0 3.518 -0.655c1.612 -0.5 3.17 -1.162 4.754 -1.724a28.574 28.574 0 0 1 3.785 -1.162 8.206 8.206 0 0 1 6.482 1.197 1.421 1.421 0 0 1 0.678 1.267v5.812Z"
                                                            style="fill:#fefefe" />
                                                    </svg>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="qris"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-20">
                                                    <svg class="w-20 h-auto" width="3000" height="1140"
                                                        viewBox="0 0 3000 1140" xmlns="http://www.w3.org/2000/svg">
                                                        <path style="fill:#000"
                                                            d="M709 948.5V757h193.75v383H709Zm1908.25 162.002v-23.252h146.313c98.506 0 147.047-.086 148.562-.259 9.013-1.029 17.64-4.557 24.75-10.121 2.315-1.812 6.753-6.294 8.457-8.54 3.93-5.181 6.773-11.386 8.225-17.953l.553-2.5.072-145.437.071-145.44H3000v166.849c0 115.396-.081 167.646-.264 169.437-1.102 10.799-6.151 20.927-14.212 28.512-6.15 5.786-13.643 9.612-22.274 11.374-2.003.41-12.009.438-174.062.508l-171.938.074zM168.625 949.09c-7.739-.883-12.965-2.486-18.617-5.71-13.48-7.693-22.256-21.308-23.769-36.88-.201-2.078-.236-19.409-.125-62.5.375-145.036.91-339.907 1.137-414.5.136-44.619.257-104.3.27-132.625.012-28.325.113-56.112.225-61.75.18-9.081.264-10.535.743-12.75 2.996-13.874 12.019-25.256 24.886-31.396 4.547-2.17 8.771-3.462 14.375-4.398 2.455-.41 7.573-.443 78.938-.517l76.312-.079V764.75h288.25v184.5l-220.937-.038c-121.516-.02-221.275-.075-221.688-.122M983.25 712.75v-236.5h567.25V363H983.25V186h773.5v465.5l-162.133.062-162.133.063L1593.641 799.5c88.636 81.331 161.624 148.292 162.195 148.802l1.039.927-137.875.003-137.875.003L1322 800.349l-159.125-148.885-.063 148.893-.063 148.893H983.25Zm854-145.875V184.5h189v764.75h-189zm271 283.75V755.25h509v-94.5h-509V186h764v189.25H2363.5v96.25h508.75V946h-764zM417.5 566.875V470h192.25v193.75H417.5Zm135.5-.75V527.25h-78.75v38.708c0 21.29.075 38.784.167 38.875.091.092 17.81.167 39.375.167H553ZM709 519.5V376.75H417.5l.062-95.312.063-95.313h441.5l3.25.586c20.15 3.636 35.137 17.642 39.573 36.98l.673 2.934.066 217.813.065 217.812H709ZM.414 376.293C.03 375.868 0 363.966 0 210.069 0 95.957.082 43.496.263 41.714 1.699 27.568 9.133 15.24 20.807 7.645 26.872 3.7 34.778 1.001 42.464.252 44.176.085 102.117 0 213.488 0c162.86 0 168.448.015 168.848.457.379.418.414 2.363.414 22.836 0 21.363-.02 22.398-.457 22.793-.425.384-10.992.414-147.01.414-101.478 0-147.3.081-148.98.265-8.301.905-16.192 3.964-22.428 8.693-2.225 1.688-5.72 5.147-7.491 7.417-5.035 6.45-7.925 13.758-8.87 22.428-.182 1.678-.264 46.916-.264 146.544 0 130.682-.037 144.154-.393 144.51-.351.352-2.8.393-23.211.393-21.789 0-22.837-.02-23.232-.457" />
                                                    </svg>

                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Bank Transfer -->
                                    <div class="border-2 border-gray-200 rounded-lg p-6">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                            <i class="fas fa-university mr-2 text-teal-500"></i>Transfer Bank
                                        </h3>
                                        <div class="grid md:grid-cols-4 gap-4">
                                            <label class="cursor-pointer col-span-4">
                                                <input type="radio" name="payment_method" value="bni"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-20">

                                                    <svg class="w-[111px] h-auto" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 52.917 15.328">
                                                        <path d="M14.507 234.87H0v-14.507h14.507Z"
                                                            style="fill:#fff;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:.0530009"
                                                            transform="translate(0 -220.363)" />
                                                        <path
                                                            style="fill:#f15a22;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:.355742"
                                                            d="m5.834 230.155 1.546-1.248c-.26-.326-.505-.654-.737-.993-1.789-2.588-2.849-5.221-2.083-7.551H0v2.515zm2.438-3.761c.097-.821.346-2.37 1.853-3.521 1.304-.993 2.937-1.184 4.382-.57v-1.94H6.458c-.53 2.36.864 4.954 1.814 6.031"
                                                            transform="translate(0 -220.363)" />
                                                        <path
                                                            style="fill:#f15a22;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:.355742"
                                                            d="m10.225 224.027-.006.004c-1.515 1.231-1.142 3.163.268 4.895 1.086 1.337 2.54 2.275 4.02 1.564v-5.704c-1.33-1.362-2.927-1.861-4.282-.759M0 225.852v9.017h.002l4.39-3.55zm7.983 3.77c-.431.354-.964.788-1.555 1.27l.57.71c.825 1.031 2.031 2.818 3.525 2.334l.055.068-1.061.865h4.99v-3.43c-2.567 1.395-4.775.125-6.524-1.817m-2.409 3.171-.59-.735a975 975 0 0 1-3.515 2.811h5.584c-.363-.77-1.022-1.506-1.479-2.076"
                                                            transform="translate(0 -220.363)" />
                                                        <path
                                                            style="fill:#006885;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:.355742"
                                                            d="M26.59 226.423c1.337-.234 2.207-1.388 2.207-2.862 0-1.963-1.699-3.198-4.607-3.198h-5.754v.067c1.175.644 1.148 1.685 1.148 2.679v8.993c0 1.011.027 2.062-1.148 2.697v.065h2.77c2.708 0 4.785.046 6.334-.682 1.647-.774 2.644-2.162 2.644-3.855 0-2.161-1.608-3.487-3.594-3.904m-4.749-4.722 1.822.03c1.35 0 2.731.66 2.731 2.182 0 1.807-1.222 2.29-2.963 2.29l-1.59.003v-.002zm1.756 11.673-1.756.002v-5.798l1.888-.01c2.196 0 4.01.816 4.01 2.955 0 2.094-1.904 2.85-4.142 2.85m10.999-1.27c0 1.237-.022 2.115 1.146 2.802v.063h-3.9v-.063c1.166-.687 1.146-1.565 1.146-2.802v-8.812c0-1.228.02-2.202-1.145-2.86v-.068h3.238v.022c.086.263.23.41.33.553.103.137.307.438.307.438l7.429 10.012v-8.183c0-1.234.02-2.116-1.145-2.774v-.068h3.877v.068c-1.145.658-1.145 1.54-1.145 2.774v12.485c-.708-.28-2.683-1.925-4.09-3.817-2.524-3.39-6.048-8.105-6.048-8.105zm14.9-9.111c0-1.014-.017-1.917-1.144-2.561v-.068h4.565v.068c-1.131.624-1.141 1.567-1.141 2.56v9.27c0 .99-.027 1.994 1.14 2.64v.065h-4.564v-.066c1.174-.654 1.144-1.64 1.144-2.633z"
                                                            transform="translate(0 -220.363)" />
                                                    </svg>
                                                </div>
                                            </label>

                                            {{-- <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="bca"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition duration-200">
                                                    <div
                                                        class="bg-blue-600 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                                        <i class="fas fa-university"></i>
                                                    </div>
                                                    <span class="font-medium">BCA</span>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="mandiri"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-yellow-500 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition duration-200">
                                                    <div
                                                        class="bg-yellow-500 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                                        <i class="fas fa-university"></i>
                                                    </div>
                                                    <span class="font-medium">Mandiri</span>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="bri"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-blue-800 peer-checked:border-blue-800 peer-checked:bg-blue-50 transition duration-200">
                                                    <div
                                                        class="bg-blue-800 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                                        <i class="fas fa-university"></i>
                                                    </div>
                                                    <span class="font-medium">BRI</span>
                                                </div>
                                            </label> --}}
                                        </div>
                                    </div>
                                </div>

                                <!-- Info untuk Donasi Barang/Jasa -->
                                <div id="non-payment-info" class="hidden">
                                    <div class="bg-teal-50 border border-teal-200 rounded-lg p-6">
                                        <div class="flex items-start">
                                            <i class="fas fa-info-circle text-teal-500 text-xl mr-3 mt-1"></i>
                                            <div>
                                                <h3 class="text-lg font-semibold text-teal-800 mb-2">Informasi
                                                    Penyerahan</h3>
                                                <p class="text-teal-700 mb-4">
                                                    Untuk donasi barang atau jasa, tim kami akan menghubungi Anda dalam
                                                    1x24 jam
                                                    untuk mengatur jadwal penyerahan atau koordinasi lebih lanjut.
                                                </p>
                                                <div class="space-y-2 text-sm text-teal-600">
                                                    <p><i class="fas fa-check mr-2"></i>Tim akan menghubungi via
                                                        telepon/email</p>
                                                    <p><i class="fas fa-check mr-2"></i>Koordinasi jadwal yang sesuai
                                                    </p>
                                                    <p><i class="fas fa-check mr-2"></i>Konfirmasi detail donasi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-8">

                                    <button type="button" id="nextStep2"
                                        class="bg-teal-500 text-white px-8 py-3 rounded-full w-full font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Konfirmasi -->
                            <div id="step3" class="hidden">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Donasi</h2>
                                <p class="text-gray-600 4">Silakan review kembali informasi yang telah Anda berikan
                                    sebelum mengirimkan.</p>

                                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Donasi</h3>
                                    <div id="donation-summary" class="space-y-3 text-gray-700">
                                        <!-- Summary akan diisi oleh JavaScript -->
                                    </div>
                                </div>

                                <!-- Pesan/Doa -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-comment-dots mr-2 text-teal-500"></i>Pesan atau Doa (Opsional)
                                    </label>
                                    <textarea name="pesan" rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                        placeholder="Tuliskan pesan atau doa untuk penerima donasi..."></textarea>
                                </div>

                                <!-- Anonim -->
                                <div class="mb-6">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="anonim" class="sr-only peer">
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600">
                                        </div>
                                        <span class="ml-3 text-sm font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-user-secret mr-2 text-teal-500"></i>Donasi secara anonim
                                        </span>
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1 ml-14">Nama Anda tidak akan ditampilkan secara
                                        publik</p>
                                </div>


                                <!-- Terms and Conditions -->
                                {{-- <div class="mb-6">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" name="terms" required class="mt-1 mr-3">
                                        <span class="text-sm text-gray-700">
                                            Saya menyetujui <a href="#"
                                                class="text-teal-500 hover:underline">syarat dan ketentuan</a>
                                            serta <a href="#" class="text-teal-500 hover:underline">kebijakan
                                                privasi</a>
                                            yang berlaku.
                                        </span>
                                    </label>
                                </div> --}}

                                <div class="flex justify-between mt-8">
                                    <button type="submit"
                                        class="bg-teal-500 text-white px-8 py-3 rounded-full w-full font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                                        Konfirmasi Donasi
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div id="successModal"
            class="fixed inset-0 bg-black/35 hidden items-center justify-center z-50 transition-all duration-300 ease-out">
            <div id="successPanel"
                class="bg-white rounded-2xl p-8 max-w-md mx-4 text-center transform scale-75 opacity-0 transition-all duration-300 ease-out">
                <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-3xl text-teal-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Terima Kasih!</h3>
                <p class="text-gray-600 mb-6">Donasi Anda telah berhasil dikirim. Kami akan segera memproses donasi
                    Anda.</p>
                <button onclick="location.reload()"
                    class="bg-teal-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                    Donasi Lagi
                </button>
            </div>
        </div>

    </div>

    <div id="alert"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 -translate-y-full opacity-0 z-50 px-4 py-3 bg-red-100 border border-red-400 text-red-800 rounded-lg shadow-lg transition duration-500 ease-out">
        <div class="flex items-start justify-between space-x-4">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                </svg>
                <span id="alert-message" class="text-sm font-medium">Pesan error</span>
            </div>
            <button onclick="closeLoginAlert()" class="text-red-500 hover:text-red-700 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        const userDonatur = @json($donatur);
        // Form state management
        let currentStep = 1;
        const totalSteps = 3;

        // DOM elements
        const steps = {
            1: document.getElementById('step1'),
            2: document.getElementById('step2'),
            3: document.getElementById('step3')
        };

        // Update stepper visual state
        function updateStepper() {
            for (let i = 1; i <= totalSteps; i++) {
                const stepElement = document.getElementById(`stepper-step${i}`);
                const circle = stepElement.querySelector('.w-8.h-8');
                const status = stepElement.querySelector('.text-xs:last-child');

                if (i < currentStep) {
                    // Completed step
                    stepElement.classList.remove('opacity-50');
                    circle.className =
                        'w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold';
                    circle.innerHTML = '<i class="fas fa-check"></i>';
                    if (status) status.textContent = 'Selesai';
                    if (status) status.className = 'text-xs text-teal-600 mt-1';
                } else if (i === currentStep) {
                    // Current step
                    stepElement.classList.remove('opacity-50');
                    circle.className =
                        'w-8 h-8 bg-orange-300 border-2 border-orange-300 rounded-full flex items-center justify-center text-white text-sm font-semibold';
                    circle.textContent = i;
                    if (status) status.textContent = 'Masih berlangsung';
                    if (status) status.className = 'text-xs text-orange-400 mt-1';
                } else {
                    // Future step
                    stepElement.classList.add('opacity-50');
                    circle.className =
                        'w-8 h-8 bg-gray-200 border-2 border-gray-300 rounded-full flex items-center justify-center text-gray-500 text-sm font-semibold';
                    circle.textContent = i;
                    if (status) status.textContent = '';
                }
            }
        }

        // Show specific step
        function showStep(step) {
            // Hide all steps
            Object.values(steps).forEach(stepElement => {
                stepElement.classList.add('hidden');
            });

            // Show current step
            steps[step].classList.remove('hidden');
            currentStep = step;
            updateStepper();
        }

        // Donation type handling
        const donationTypes = document.querySelectorAll('input[name="jenis_donasi"]');
        const donationSections = {
            'uang': document.getElementById('donasi-uang'),
            'barang': document.getElementById('donasi-barang'),
            'jasa': document.getElementById('donasi-jasa')
        };

        const paymentMethodsSection = document.getElementById('payment-methods');
        const nonPaymentInfoSection = document.getElementById('non-payment-info');

        donationTypes.forEach(radio => {
            radio.addEventListener('change', function() {
                // Hide all donation sections
                Object.values(donationSections).forEach(section => section.classList.add('hidden'));

                // Show section based on selection
                if (donationSections[this.value]) {
                    donationSections[this.value].classList.remove('hidden');
                }
            });
        });

        // Nominal buttons handling
        const nominalButtons = document.querySelectorAll('.nominal-btn');
        const nominalInput = document.getElementById('nominal-input');

        nominalButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Reset all buttons
                nominalButtons.forEach(btn => {
                    btn.classList.remove('border-teal-500', 'bg-teal-50');
                    btn.classList.add('border-gray-200');
                });

                // Activate clicked button
                this.classList.remove('border-gray-200');
                this.classList.add('border-teal-500', 'bg-teal-50');

                // Set nominal value
                const nominal = this.getAttribute('data-nominal');
                nominalInput.value = nominal;
            });
        });

        // Clear nominal buttons when typing custom amount
        nominalInput.addEventListener('input', function() {
            nominalButtons.forEach(btn => {
                btn.classList.remove('border-teal-500', 'bg-teal-50');
                btn.classList.add('border-gray-200');
            });
        });

        // Handle payment methods visibility in step 2
        function handlePaymentMethodsVisibility() {
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');

            if (donationType && donationType.value === 'uang') {
                paymentMethodsSection.classList.remove('hidden');
                nonPaymentInfoSection.classList.add('hidden');
            } else {
                paymentMethodsSection.classList.add('hidden');
                nonPaymentInfoSection.classList.remove('hidden');
            }
        }

        // Step validation
        function validateStep1() {
            //const requiredFields = ['nama', 'email', 'telepon'];
            let isValid = true;

            /* Check basic required fields
            requiredFields.forEach(field => {
                const element = document.querySelector(`[name="${field}"]`);
                if (!element.value.trim()) {
                    isValid = false;
                    element.focus();
                    alert(`Mohon isi ${field}`);
                    return;
                }
            });*/

            // Check donation type
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');
            // if (!donationType) {
            //     isValid = false;
            //     alert('Mohon pilih jenis donasi');
            //     return false;
            // }

            // Validate donation specific fields
            if (donationType.value === 'uang') {
                const nominal = document.querySelector('[name="nominal"]');
                if (!nominal.value || nominal.value < 10000) {
                    isValid = false;
                    showAlert('Mohon masukkan nominal donasi minimal Rp 10.000');
                    nominal.focus();
                }
            } else if (donationType.value === 'barang') {
                const jenisBarang = document.querySelector('[name="jenis_barang"]');
                const deskripsiBarang = document.querySelector('[name="deskripsi_barang"]');
                if (!jenisBarang.value || !deskripsiBarang.value.trim()) {
                    isValid = false;
                    showAlert('Mohon lengkapi data donasi barang');
                }
            } else if (donationType.value === 'jasa') {
                const jenisJasa = document.querySelector('[name="jenis_jasa"]');
                const deskripsiJasa = document.querySelector('[name="deskripsi_jasa"]');
                if (!jenisJasa.value || !deskripsiJasa.value.trim()) {
                    isValid = false;
                    showAlert('Mohon lengkapi data donasi jasa');
                }
            }

            return isValid;
        }

        function validateStep2() {
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');
            if (donationType && donationType.value === 'uang') {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
                if (!paymentMethod) {
                    showAlert('Mohon pilih metode pembayaran');
                    return false;
                }
            }
            return true;
        }

        // Generate summary
        function generateSummary() {
            const summaryContainer = document.getElementById('donation-summary');
            const formData = new FormData(document.getElementById('donationForm'));
            let summaryHTML = '';

            // Ambil langsung dari userDonatur
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Nama:</span><span>${userDonatur?.nama || '-'}</span></div>`;
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Email:</span><span>${userDonatur?.email || '-'}</span></div>`;
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Telepon:</span><span>${userDonatur?.no_tlp || '-'}</span></div>`;

            if (userDonatur?.kota) {
                summaryHTML +=
                    `<div class="flex justify-between"><span class="font-medium">Kota:</span><span>${userDonatur.kota}</span></div>`;
            }

            // Selanjutnya tetap dari formData
            const donationType = formData.get('jenis_donasi');
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Jenis Donasi:</span><span class="capitalize">${donationType}</span></div>`;

            if (donationType === 'uang') {
                const nominal = parseInt(formData.get('nominal'));
                summaryHTML +=
                    `<div class="flex justify-between"><span class="font-medium">Nominal:</span><span class="text-teal-600 font-semibold">Rp ${nominal.toLocaleString('id-ID')}</span></div>`;

                const paymentMethod = formData.get('payment_method');
                if (paymentMethod) {
                    summaryHTML +=
                        `<div class="flex justify-between"><span class="font-medium">Metode Pembayaran:</span><span class="uppercase">${paymentMethod}</span></div>`;
                }
            } else if (donationType === 'barang') {
                summaryHTML +=
                    `<div class="flex justify-between"><span class="font-medium">Jenis Barang:</span><span class="capitalize">${formData.get('jenis_barang')}</span></div>`;
                const nilaiBarang = formData.get('nilai_barang');
                if (nilaiBarang) {
                    summaryHTML +=
                        `<div class="flex justify-between"><span class="font-medium">Estimasi Nilai:</span><span>Rp ${parseInt(nilaiBarang).toLocaleString('id-ID')}</span></div>`;
                }
            } else if (donationType === 'jasa') {
                summaryHTML +=
                    `<div class="flex justify-between"><span class="font-medium">Jenis Jasa:</span><span class="capitalize">${formData.get('jenis_jasa')}</span></div>`;
                const waktuJasa = formData.get('waktu_jasa');
                if (waktuJasa) {
                    summaryHTML +=
                        `<div class="flex justify-between"><span class="font-medium">Estimasi Waktu:</span><span>${waktuJasa}</span></div>`;
                }
            }

            const pesan = formData.get('pesan');
            if (pesan && pesan.trim()) {
                summaryHTML +=
                    `<div class="flex justify-between"><span class="font-medium">Pesan:</span><span class="italic">"${pesan}"</span></div>`;
            }

            // const anonim = formData.get('anonim');
            // summaryHTML +=
            //     `<div class="flex justify-between"><span class="font-medium">Donasi Anonim:</span><span>${anonim ? 'Ya' : 'Tidak'}</span></div>`;

            summaryContainer.innerHTML = summaryHTML;
        }


        // Step navigation handlers
        document.getElementById('nextStep1').addEventListener('click', function() {
            if (validateStep1()) {
                showStep(2);
                handlePaymentMethodsVisibility();
            }
        });

        document.getElementById('nextStep2').addEventListener('click', function() {
            if (validateStep2()) {
                showStep(3);
                generateSummary();
            }
        });

        document.getElementById('donationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show success modal
            const modal = document.getElementById('successModal');
            const panel = document.getElementById('successPanel');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // buat agar stepper selesai di step3
            const stepElement = document.getElementById(`stepper-step3`);
            const circle = stepElement.querySelector('.w-8.h-8');
            const status = stepElement.querySelector('.text-xs:last-child');

            stepElement.classList.remove('opacity-50');
            circle.className =
                'w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold';
            circle.innerHTML = '<i class="fas fa-check"></i>';
            if (status) status.textContent = 'Selesai';
            if (status) status.className = 'text-xs text-teal-600 mt-1';

            // Trigger panel grow animation
            setTimeout(() => {
                panel.classList.remove('scale-75', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            }, 50); // beri delay sedikit agar transisi bekerja

            // Normally, send form data to server
            console.log('Form submitted:', new FormData(this));
        });

        // Initialize
        showStep(1);
        // Tampilkan section donasi yang sesuai dengan radio default
        handlePaymentMethodsVisibility();
        const defaultDonationType = document.querySelector('input[name="jenis_donasi"]:checked');
        if (defaultDonationType && donationSections[defaultDonationType.value]) {
            donationSections[defaultDonationType.value].classList.remove('hidden');
        }

        document.getElementById('prevStep').addEventListener('click', function() {
            if (currentStep === 1) {
                // Arahkan ke halaman tertentu saat di step 1
                window.location.href = "{{ route('beranda') }}"; // ganti dengan URL tujuan
                // Atau gunakan: history.back(); // jika ingin kembali ke halaman sebelumnya di browser
            } else {
                showStep(currentStep - 1);
            }
        });


        function showAlert(message) {
            const alert = document.getElementById('alert');
            const messageElement = document.getElementById('alert-message');

            messageElement.textContent = message;

            alert.classList.remove('-translate-y-full', 'opacity-0');
            alert.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                closeAlert();
            }, 3000);
        }

        function closeAlert() {
            const alert = document.getElementById('alert');
            alert.classList.remove('translate-y-0', 'opacity-100');
            alert.classList.add('-translate-y-full', 'opacity-0');
        }
    </script>
</body>

</html>
