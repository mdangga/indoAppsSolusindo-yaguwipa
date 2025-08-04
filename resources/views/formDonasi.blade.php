@php
    // Ambil user yang sedang login
    $user = auth()->user();
    $isLoggedIn = isset($user);
    // Tentukan data tampilan utama berdasarkan peran
    $displayUser = $user?->role === 'mitra' ? $user->mitra : null;

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
    $userIdentifier = $user?->email ?? ($user?->id ?? 'guest');
    $colorIndex = crc32($userIdentifier) % count($colors);
    $randomBg = $colors[$colorIndex];
    $hoverBg = $colorMap[$randomBg];

    $profilePath = optional($user)->profile_path;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi - Berbagi Kebaikan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>

    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="container px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="flex">

                    <!-- Left Side - Stepper -->
                    <div class="hidden md:block w-80 bg-gray-100/60 p-8 rounded-xl border-gray-200">
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
                                    <h3 id="step2-title" class="text-sm font-medium text-gray-600">Informasi Penyerahan
                                    </h3>
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
                            <!-- Login Link -->
                            {{-- @guest
                                <div class="mt-12 pt-8 border-t border-gray-200">
                                    <p class="text-sm text-gray-600">
                                        Already have an account?
                                        <a href="#" class="text-teal-600 hover:text-teal-700 font-medium">Log in</a>
                                    </p>
                                </div>
                            @endguest --}}
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="flex-1 p-8">
                        <!-- Back and profile -->
                        <div class="max-w-5xl mx-auto mb-1 md:mb-4">

                            <div class="flex items-center justify-between mb-6">
                                <button id="prevStep"
                                    class="flex items-center text-gray-600 hover:text-gray-800 transition duration-200 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24"
                                        class="bg-none md:bg-gray-100 rounded-lg mr-2 text-gray-400 transition">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5" d="m14 7l-5 5l5 5" />
                                    </svg>
                                    <span class="text-sm">Kembali</span>
                                </button>

                                <div
                                    class="flex md:hidden bg-gray-100 p-1.5 rounded-sm items-center justify-between mb-2 mr-2">
                                    <span id="step-label" class="text-sm font-medium text-gray-700">Step 1/3</span>
                                </div>
                                <div class="hidden md:flex items-center space-x-4">
                                    <a href="#" class=" text-gray-600 text-sm">Butuh Bantuan?</a>
                                    @auth
                                        @if ($profilePath)
                                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar">
                                                <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                                    class="w-8 h-8 rounded-full object-cover border-2 border-gray-300 hover:brightness-90 transition" />
                                            </button>
                                        @else
                                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                                                class="w-8 h-8 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-md">
                                                {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Stepper Progress -->
                        <div id="mobile-stepper" class="md:hidden my-4">
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div id="step-progress-bar"
                                    class="bg-teal-500 h-2 w-1/3 transition-all duration-300 ease-in-out rounded-full">
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
                                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-teal-500 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition duration-200 md:min-h-[165px] flex flex-col justify-between">
                                                    <div>
                                                        <i
                                                            class="fas fa-money-bill-wave text-3xl text-green-500 mb-3"></i>
                                                        <h3 class="font-semibold text-gray-800">Donasi Uang</h3>
                                                        <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk uang
                                                            tunai</p>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="jenis_donasi" value="barang"
                                                    class="sr-only peer">
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-teal-500 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition duration-200 md:min-h-[165px] flex flex-col justify-between">
                                                    <div>
                                                        <i class="fas fa-box text-3xl text-orange-500 mb-3"></i>
                                                        <h3 class="font-semibold text-gray-800">Donasi Barang</h3>
                                                        <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk
                                                            barang</p>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="jenis_donasi" value="jasa"
                                                    class="sr-only peer">
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-teal-500 peer-checked:border-teal-500 peer-checked:bg-teal-50 transition duration-200 min-h-20 flex flex-col justify-between">
                                                    <div>
                                                        <i class="fas fa-handshake text-3xl text-purple-500 mb-3"></i>
                                                        <h3 class="font-semibold text-gray-800">Donasi Jasa</h3>
                                                        <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk
                                                            jasa/keahlian</p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                    </div>

                                    <!-- Detail Donasi Uang -->
                                    <div id="donasi-uang" class="hidden mt-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-coins mr-2 text-teal-500"></i>Nominal Donasi *
                                        </label>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4 ">
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
                                        <div class="relative">
                                            <span
                                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                            <input type="number" name="nominal" id="nominal-input"
                                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg outline-0 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                                placeholder="Atau masukkan nominal lainnya" min="10000">

                                        </div>
                                    </div>


                                    <!-- Detail Donasi Barang -->
                                    <div id="donasi-barang" class="hidden mt-6">
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-tag mr-2 text-teal-500"></i>Jenis Barang *
                                                </label>
                                                <select name="jenis_barang"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0">
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
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                    placeholder="Estimasi nilai barang">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-clipboard-list mr-2 text-teal-500"></i>Deskripsi
                                                Barang *
                                            </label>
                                            <textarea name="deskripsi_barang" rows="4"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
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
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0">
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
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                    placeholder="Contoh: 2 jam, 1 hari, dll">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-clipboard-list mr-2 text-teal-500"></i>Deskripsi Jasa
                                                *
                                            </label>
                                            <textarea name="deskripsi_jasa" rows="4"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                placeholder="Jelaskan jasa/keahlian yang bisa Anda berikan"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-8">
                                    <button type="button" id="nextStep1"
                                        class="bg-teal-500 text-white px-8 py-3 rounded-lg w-full font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Pembayaran -->
                            <div id="step2" class="hidden">
                                <h2 id="title-step2" class="text-2xl font-bold text-gray-900 mb-2">Metode Pembayaran
                                </h2>
                                <p id="desc-step2" class="text-gray-600 mb-4">Pilih metode pembayaran yang Anda
                                    inginkan untuk
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
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-15">
                                                    <img src="{{ asset('img/payment/gopay.png') }}" alt="GoPay"
                                                        class="h-full object-contain" />
                                                </div>
                                            </label>


                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="ovo"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-15">
                                                    <img src="{{ asset('img/payment/ovo.png') }}" alt="Ovo"
                                                        class="h-full object-contain" />
                                                </div>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="dana"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-15">
                                                    <img src="{{ asset('img/payment/dana.png') }}" alt="Dana"
                                                        class="h-full object-contain" />
                                                </div>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="payment_method" value="qris"
                                                    class="sr-only peer">
                                                <div
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-15">
                                                    <img src="{{ asset('img/payment/qris.png') }}" alt="QRIS"
                                                        class="h-full object-contain" />
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
                                                    class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200 flex justify-center items-center h-15">
                                                    <img src="{{ asset('img/payment/bni.png') }}" alt="Bank BNI"
                                                        class="h-full object-contain" />
                                                </div>
                                            </label>
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
                                                    Untuk donasi barang atau jasa, tim kami akan menghubungi Anda
                                                    dalam
                                                    1x24 jam
                                                    untuk mengatur jadwal penyerahan atau koordinasi lebih lanjut.
                                                </p>
                                                <div class="space-y-2 text-sm text-teal-600">
                                                    <p><i class="fas fa-check mr-2"></i>Tim akan menghubungi via
                                                        telepon/email</p>
                                                    <p><i class="fas fa-check mr-2"></i>Koordinasi jadwal yang
                                                        sesuai
                                                    </p>
                                                    <p><i class="fas fa-check mr-2"></i>Konfirmasi detail donasi
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-8">
                                    <button type="button" id="nextStep2"
                                        class="bg-teal-500 text-white px-8 py-3 rounded-lg w-full font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Konfirmasi -->
                            <div id="step3" class="hidden">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Donasi</h2>
                                <p class="text-gray-600 mb-6">Silakan review kembali informasi yang telah Anda
                                    berikan
                                    sebelum mengirimkan.</p>

                                <!-- Donation Summary and Payment Method Change (hanya untuk donasi uang) -->
                                <div id="uang-summary"
                                    class=" grid md:grid-cols-2 gap-6 mb-8 p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nominal Donasi
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                            <input type="number" id="nominal_donasi_display"
                                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0">
                                        </div>

                                    </div>

                                    <div class="flex flex-col justify-end">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Metode Pembayaran
                                        </label>
                                        <div
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 flex items-center justify-between">
                                            <!-- Kiri: ikon dan nama metode -->
                                            <div class="flex items-center gap-3">
                                                <img id="payment-method-logo" src="" alt="Metode Pembayaran"
                                                    class="h-3 md:h-4 w-auto">
                                                <span id="current-payment-method"
                                                    class="hidden md:block font-semibold text-sm text-gray-800">-</span>
                                            </div>

                                            <!-- Kanan: Tombol Ganti -->
                                            <button type="button" onclick="goToStep(2)"
                                                class="bg-teal-500 hover:bg-teal-600 text-white text-sm font-semibold px-3 py-1.5 rounded-full flex items-center gap-1 cursor-pointer">
                                                Ganti
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6 mb-6">

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Lengkap *
                                        </label>
                                        <input type="text" name="nama" required
                                            value="{{ old('nama') ?? ($user->nama ?? '') }}"
                                            @if ($isLoggedIn) readonly @endif
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0 {{ $isLoggedIn ? 'bg-gray-100 cursor-none' : '' }}"
                                            placeholder="Masukkan nama lengkap">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Email atau No Telepon *
                                        </label>
                                        <input type="text" name="email_tlp" required
                                            value="{{ old('email_tlp') ?? ($user->email ?? ($user->no_tlp ?? '')) }}"
                                            @if ($isLoggedIn) readonly @endif
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0 {{ $isLoggedIn ? 'bg-gray-100 cursor-none' : '' }}"
                                            placeholder="Email atau No Telepon">
                                    </div>
                                </div>


                                <!-- Anonymous Option -->
                                <div class="mb-6">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="anonim" class="sr-only peer">
                                        <div
                                            class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-teal-600">
                                        </div>
                                        <span class="ml-3 text-sm text-gray-700 flex items-center">
                                            Sembunyikan nama saya (donasi sebagai anonim)
                                        </span>
                                    </label>
                                </div>

                                <!-- Message/Prayer -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pesan atau Doa (Opsional)
                                    </label>
                                    <textarea name="pesan" rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                        placeholder="Tuliskan pesan atau doa untuk penerima donasi..."></textarea>
                                </div>

                                <!-- Final Confirmation Section -->
                                <div class="flex flex-col md:flex-row gap-4 mt-8 items-start md:items-center">
                                    <!-- Total Donation Amount -->
                                    <div id="total-donation-section" class="hidden min-w-[100px]">

                                        <p class="text-xs text-teal-700 mb-1">Total Donasi:</p>
                                        <p class="text-2xl font-bold text-teal-600" id="totalDonation">Rp 0</p>

                                    </div>

                                    <!-- Confirmation Button -->
                                    <div id="confirm-button-section" class="flex-1 w-full">
                                        <button type="submit"
                                            class="bg-teal-500 text-white px-8 py-3 rounded-lg w-full font-medium hover:bg-teal-600 transition duration-200 cursor-pointer">
                                            Konfirmasi Donasi
                                        </button>
                                    </div>
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

    <!-- Alert -->
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
            <button onclick="closeAlert()" class="text-red-500 hover:text-red-700 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Add this JavaScript code to replace the existing script section in your HTML
        const user = @json($user);

        // Form state management
        let currentStep = 1;
        let selectedDonationType = 'uang';
        let selectedPaymentMethod = null;
        let donationAmount = 0;
        const totalSteps = 3;

        // DOM elements
        const steps = {
            1: document.getElementById('step1'),
            2: document.getElementById('step2'),
            3: document.getElementById('step3')
        };

        // Payment method names mapping
        const paymentMethodNames = {
            'gopay': 'GoPay',
            'ovo': 'OVO',
            'dana': 'DANA',
            'qris': 'QRIS',
            'bni': 'Transfer Bank'
        };
        const paymentMethodLogos = {
            gopay: "{{ asset('img/payment/gopay.png') }}",
            dana: "{{ asset('img/payment/dana.png') }}",
            qris: "{{ asset('img/payment/qris.png') }}",
            ovo: "{{ asset('img/payment/ovo.png') }}",
            bni: "{{ asset('img/payment/bni.png') }}"
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


        function updateMobileStepper() {
            const stepLabel = document.getElementById('step-label');
            const progressBar = document.getElementById('step-progress-bar');

            if (stepLabel) stepLabel.textContent = `Step ${currentStep}/${totalSteps}`;

            if (progressBar) {
                const progressPercent = (currentStep / totalSteps) * 100;
                progressBar.style.width = `${progressPercent}%`;
            }
        }

        // Format number with thousand separators
        function formatNumber(num) {
            return parseInt(num).toLocaleString('id-ID');
        }

        // Parse formatted number back to integer
        function parseFormattedNumber(str) {
            return parseInt(str.replace(/\./g, '')) || 0;
        }

        // Update total donation display
        function updateTotalDonation(amount) {
            const totalDonationElement = document.getElementById('totalDonation');
            if (totalDonationElement) {
                totalDonationElement.textContent = 'Rp ' + formatNumber(amount);
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
            updateMobileStepper();

            if (step == 2) {
                handlePaymentMethodsVisibility();
            }

            // Update step 3 display when showing it
            if (step === 3) {
                updateStep3Display();
                setupNominalDisplayListener();
            }
        }

        // Go to specific step (for edit buttons)
        function goToStep(step) {
            showStep(step);
        }

        // Setup listener for nominal display input in step 3
        function setupNominalDisplayListener() {
            const nominalDisplay = document.getElementById('nominal_donasi_display');

            if (nominalDisplay && selectedDonationType === 'uang') {
                // Remove existing listeners to prevent duplicates
                nominalDisplay.removeEventListener('input', handleNominalDisplayChange);
                nominalDisplay.removeEventListener('blur', handleNominalDisplayBlur);

                // Add event listeners
                nominalDisplay.addEventListener('input', handleNominalDisplayChange);
                nominalDisplay.addEventListener('blur', handleNominalDisplayBlur);

                // Format initial value
                if (donationAmount > 0) {
                    nominalDisplay.value = formatNumber(donationAmount);
                }
            }
        }

        // Handle nominal display input change
        function handleNominalDisplayChange(e) {
            let value = e.target.value;

            // Remove any non-numeric characters except dots
            value = value.replace(/[^\d]/g, '');

            if (value) {
                const numericValue = parseInt(value);

                // Update donation amount
                donationAmount = numericValue;

                // Update total donation display
                updateTotalDonation(numericValue);

                // Update the original nominal input in step 1 as well
                const nominalInput = document.getElementById('nominal-input');
                if (nominalInput) {
                    nominalInput.value = numericValue;
                }
            } else {
                donationAmount = 0;
                updateTotalDonation(0);
            }
        }

        // Handle nominal display blur (format the number)
        function handleNominalDisplayBlur(e) {
            if (donationAmount > 0) {
                e.target.value = formatNumber(donationAmount);
            }
        }




        // Update Step 3 display based on donation type
        function updateStep3Display() {
            const uangSummary = document.getElementById('uang-summary');
            const totalDonationSection = document.getElementById('total-donation-section');
            const confirmButtonSection = document.getElementById('confirm-button-section');

            if (selectedDonationType === 'uang') {
                // Show money donation specific elements
                uangSummary.classList.remove('hidden');
                totalDonationSection.classList.remove('hidden');
                confirmButtonSection.classList.remove('md:ml-4');

                // Update nominal display
                const nominalDisplay = document.getElementById('nominal_donasi_display');
                if (nominalDisplay) {
                    nominalDisplay.value = donationAmount > 0 ? formatNumber(donationAmount) : '';
                }

                // Update total donation
                updateTotalDonation(donationAmount);

                // Update payment method display
                const currentPaymentMethodSpan = document.getElementById('current-payment-method');
                const currentPaymentMethodLogo = document.getElementById('payment-method-logo');

                if (currentPaymentMethodSpan && currentPaymentMethodLogo) {
                    if (selectedPaymentMethod) {
                        currentPaymentMethodSpan.textContent = paymentMethodNames[selectedPaymentMethod];
                        currentPaymentMethodLogo.src = paymentMethodLogos[selectedPaymentMethod];
                        currentPaymentMethodLogo.classList.remove('hidden');
                    } else {
                        currentPaymentMethodSpan.textContent = '-';
                        currentPaymentMethodLogo.classList.add('hidden');
                    }
                }
            } else {
                // Hide money donation specific elements
                uangSummary.classList.add('hidden');
                totalDonationSection.classList.add('hidden');
                confirmButtonSection.classList.add('md:ml-4');
            }
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
                selectedDonationType = this.value;

                updateStep3Display();

                // Hide all donation sections
                Object.values(donationSections).forEach(section => section.classList.add('hidden'));

                // Show section based on selection
                if (donationSections[this.value]) {
                    donationSections[this.value].classList.remove('hidden');
                }

                // Reset amount if not money donation
                if (this.value !== 'uang') {
                    donationAmount = 0;
                }

                // Update judul step 2 secara real-time
                const step2Title = document.getElementById('step2-title');
                if (step2Title) {
                    step2Title.textContent = selectedDonationType === 'uang' ? 'Metode Pembayaran' :
                        'Informasi Penyerahan';
                }

                //Panggil ulang fungsi visibility metode pembayaran
                handlePaymentMethodsVisibility();
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
                const nominal = parseInt(this.getAttribute('data-nominal'));
                nominalInput.value = nominal;
                donationAmount = nominal;
            });
        });

        // Clear nominal buttons when typing custom amount
        nominalInput.addEventListener('input', function() {
            nominalButtons.forEach(btn => {
                btn.classList.remove('border-teal-500', 'bg-teal-50');
                btn.classList.add('border-gray-200');
            });
            donationAmount = parseInt(this.value) || 0;
        });

        // Payment method selection handling
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        paymentMethods.forEach(radio => {
            radio.addEventListener('change', function() {
                selectedPaymentMethod = this.value;
            });
        });



        // Handle payment methods visibility in step 2
        function handlePaymentMethodsVisibility() {
            if (selectedDonationType === 'uang') {
                paymentMethodsSection.classList.remove('hidden');
                nonPaymentInfoSection.classList.add('hidden');
            } else {
                paymentMethodsSection.classList.add('hidden');
                nonPaymentInfoSection.classList.remove('hidden');

                const title2 = document.getElementById('title-step2');
                const desc2 = document.getElementById('desc-step2')
                title2.textContent = 'Informasi Penyerahan Barang atau Jasa';
                desc2.textContent = 'Silakan isi data diri di halaman selanjutnya dengan benar'
            }
        }

        // Step validation
        function validateStep1() {
            let isValid = true;

            // Check donation type
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');

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
            if (selectedDonationType === 'uang') {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
                if (!paymentMethod) {
                    showAlert('Mohon pilih metode pembayaran');
                    return false;
                }
            }
            return true;
        }

        function validateStep3() {
            const nama = document.querySelector('[name="nama"]');
            const emailTlp = document.querySelector('[name="email_tlp"]');

            if (!nama.value.trim()) {
                showAlert('Mohon isi nama lengkap');
                nama.focus();
                return false;
            }

            if (!emailTlp.value.trim()) {
                showAlert('Mohon isi email atau nomor telepon');
                emailTlp.focus();
                return false;
            }

            // Validate donation amount for money donations
            if (selectedDonationType === 'uang') {
                if (!donationAmount || donationAmount < 10000) {
                    showAlert('Mohon masukkan nominal donasi minimal Rp 10.000');
                    const nominalDisplay = document.getElementById('nominal_donasi_display');
                    if (nominalDisplay) {
                        nominalDisplay.focus();
                    }
                    return false;
                }
            }

            return true;
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
            }
        });

        document.getElementById('donationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateStep3()) {
                return;
            }

            // Update the original nominal input with the final amount
            if (selectedDonationType === 'uang') {
                const nominalInput = document.getElementById('nominal-input');
                if (nominalInput) {
                    nominalInput.value = donationAmount;
                }
            }

            // Show success modal
            const modal = document.getElementById('successModal');
            const panel = document.getElementById('successPanel');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Update stepper to show step 3 as completed
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
            }, 50);

            // Log form data for development
            console.log('Form submitted:', new FormData(this));
            console.log('Final donation amount:', donationAmount);
        });

        // Back button handler
        document.getElementById('prevStep').addEventListener('click', function() {
            if (currentStep === 1) {
                window.location.href = "{{ url()->previous() }}";
            } else {
                showStep(currentStep - 1);
                if (currentStep === 2) {
                    handlePaymentMethodsVisibility();
                }
            }
        });

        // Alert functions
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

        // Initialize
        showStep(1);
        handlePaymentMethodsVisibility();

        // Show default donation section
        const defaultDonationType = document.querySelector('input[name="jenis_donasi"]:checked');

        if (defaultDonationType && donationSections[defaultDonationType.value]) {
            donationSections[defaultDonationType.value].classList.remove('hidden');
            selectedDonationType = defaultDonationType.value;
        }
    </script>
</body>

</html>
