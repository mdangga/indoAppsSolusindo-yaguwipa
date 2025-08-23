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

    // Get admin fee configuration for frontend
    $adminFeeConfig = [
        'enabled' => config('xendit.settings.admin_fee.enabled', true),
        'type' => config('xendit.settings.admin_fee.type', 'FIXED'),
        'fixed_amount' => config('xendit.settings.admin_fee.fixed_amount', 2500),
        'value' => config('xendit.settings.admin_fee.value', 2.5),
        'minimum_fee' => config('xendit.settings.admin_fee.minimum_fee', 1000),
        'maximum_fee' => config('xendit.settings.admin_fee.maximum_fee', 50000),
        'rounding' => [
            'enabled' => config('xendit.fee_calculation.rounding.enabled', true),
            'precision' => config('xendit.fee_calculation.rounding.precision', 100),
        ],
    ];

    function calculateAdminFee(float $amount): float
    {
        $feeConfig = config('xendit.settings.admin_fee');

        if (!$feeConfig['enabled']) {
            return 0;
        }

        if ($feeConfig['type'] === 'FIXED') {
            $fee = $feeConfig['fixed_amount'];
        } else {
            $fee = $amount * ($feeConfig['value'] / 100);
        }

        // Apply minimum and maximum limits
        $fee = max($fee, $feeConfig['minimum_fee']);
        $fee = min($fee, $feeConfig['maximum_fee']);

        // Rounding
        if (config('xendit.fee_calculation.rounding.enabled')) {
            $precision = config('xendit.fee_calculation.rounding.precision', 100);
            $fee = round($fee / $precision) * $precision;
        }

        return (float) $fee;
    }
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi - Berbagi Kebaikan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="container px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="flex">

                    <!-- Left Side - Stepper -->
                    <div class="hidden md:block w-80 bg-gray-100/60 p-8 rounded-xl border-gray-200">
                        <!-- Stepper -->
                        <div class="flex items-center space-x-3 mb-2">
                            <img src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Icon Donasi"
                                class="w-12 h-12 rounded-lg" />
                            <div>
                                <h1 class="text-md font-semibold text-gray-800">Form Donasi</h1>
                                <p class="text-xs text-gray-500 leading-snug">Bersama Anda, Kami Membawa<br>Manfaat
                                    untuk Sesama</p>
                            </div>
                        </div>


                        <div class="rounded-xl py-4 mb-3">
                            <p class="text-sm font-medium text-gray-500">
                                Berdonasi di Campaign
                            </p>
                            <p class="mt-1 text-md font-semibold text-gray-900 leading-tight">
                                {{ $campaign->nama }}
                            </p>
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
                                    {{-- <a href="#" class=" text-gray-600 text-sm">Butuh Bantuan?</a> --}}
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

                        <form action="{{ route('donasi.store') }}" id="donationForm" method="POST">
                            @csrf
                            <input type="hidden" name="id_campaign" value="{{ $campaign->id_campaign ?? 1 }}">
                            <input type="hidden" name="jenis_donasi" id="jenis_donasi" value="dana">
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
                                                <input type="radio" name="jenis_donasi" value="dana"
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
                                    <div id="donasi-barang" x-data="donasiBarangForm()" class="hidden mt-6">
                                        <!-- Form input barang -->
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                                <i class="fas fa-plus-circle mr-2 text-teal-600"></i>
                                                Tambah Barang Baru
                                            </h3>

                                            <div class="grid md:grid-cols-3 gap-4 mb-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="fas fa-tag mr-2 text-teal-500"></i>Nama Barang *
                                                    </label>
                                                    <input type="text" x-model="form.nama_barang"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                        placeholder="Nama barang" name="nama_barang">
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="fas fa-check-circle mr-2 text-teal-500"></i>Kondisi *
                                                    </label>
                                                    <select x-model="form.kondisi_barang"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                        name="kondisi_barang">
                                                        <option value="">-- Pilih Kondisi --</option>
                                                        <option value="baru">Baru</option>
                                                        <option value="bekas">Bekas</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="fas fa-hashtag mr-2 text-teal-500"></i>Jumlah Barang
                                                    </label>
                                                    <input type="number" name="jumlah_barang"
                                                        x-model="form.jumlah_barang" min="1"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                        placeholder="Jumlah barang">
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-clipboard-list mr-2 text-teal-500"></i>Deskripsi
                                                    Barang *
                                                </label>
                                                <textarea name="deskripsi" rows="2" x-model="form.deskripsi_barang"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                    placeholder="Jelaskan kondisi dan detail barang yang akan didonasikan"></textarea>
                                            </div>

                                            <!-- Tombol tambah -->
                                            <div class="flex justify-end">
                                                <button type="button" @click="tambahBarang()"
                                                    class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 focus:ring-2 focus:ring-teal-500 transition duration-200 flex items-center">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Tambah Barang
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Daftar Barang yang Sudah Ditambahkan -->
                                        <div x-show="items.length > 0" class="mt-2">
                                            <!-- List items -->
                                            <div class="space-y-2">
                                                <template x-for="(item, index) in items" :key="index">
                                                    <div
                                                        class= "bg-white border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center space-x-4 flex-1">
                                                                <!-- No -->
                                                                <span class="inline-fle" x-text="index + 1"></span>

                                                                <!-- Nama Barang -->
                                                                <p class="font-medium text-gray-900 flex-1"
                                                                    x-text="item.nama_barang"></p>

                                                                <!-- Jumlah -->
                                                                <p class="text-sm text-gray-600 min-w-[80px]">
                                                                    <span class="font-medium">Jumlah:</span>
                                                                    <span x-text="item.jumlah_barang || '-'"></span>
                                                                </p>

                                                                <!-- Kondisi -->
                                                                <span
                                                                    class="px-3 py-1 text-sm font-medium rounded-full min-w-[70px] text-center"
                                                                    :class="item.kondisi_barang === 'baru' ?
                                                                        'bg-green-100 text-green-800' :
                                                                        'bg-blue-100 text-blue-800'"
                                                                    x-text="item.kondisi_barang.charAt(0).toUpperCase() + item.kondisi_barang.slice(1)">
                                                                </span>
                                                            </div>

                                                            <!-- Hapus Barang -->
                                                            <button type="button" @click="hapusBarang(index)"
                                                                class="ml-4 text-red-600 ">
                                                                <i class="fas fa-trash text-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>

                                            <div class="mt-4 p-3 bg-teal-50 border border-teal-200 rounded-lg">
                                                <p class="text-sm text-teal-700">
                                                    <i class="fas fa-info-circle mr-2"></i>
                                                    Total <span class="font-semibold" x-text="items.length"></span>
                                                    item barang siap untuk didonasikan
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Detail Donasi Jasa -->
                                    <div id="donasi-jasa" class="hidden mt-6">
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-clock mr-2 text-teal-500"></i>Jenis Jasa *
                                                </label>
                                                <input type="text" name="jenis_jasa"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                    placeholder="Contoh: Pendidikan, Kesehatan, dll">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-clock mr-2 text-teal-500"></i>Durasi
                                                </label>
                                                <input type="text" name="durasi_jasa"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0"
                                                    placeholder="Contoh: 2 jam, 1 hari, dll">
                                            </div>
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
                                <div id="uang-summary" class="gap-6 mb-8 p-4 bg-gray-50 rounded-lg">
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
                                </div>

                                <div class="grid md:grid-cols-2 gap-6 mb-6">

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Lengkap *
                                        </label>
                                        <input type="text" name="nama" required
                                            value="{{ old('nama') ?? ($user->nama ?? '') }}"
                                            @if ($isLoggedIn) readonly @endif
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0 {{ $isLoggedIn ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                            placeholder="Masukkan nama lengkap">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Email *
                                        </label>
                                        <input type="text" name="email_tlp" required
                                            value="{{ old('email_tlp') ?? ($user->email ?? ($user->no_tlp ?? '')) }}"
                                            @if ($isLoggedIn) readonly @endif
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200 outline-0 {{ $isLoggedIn ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                            placeholder="Email atau No Telepon">
                                    </div>
                                </div>


                                <!-- Anonymous Option -->
                                <div class="mb-6">
                                    <!-- Hidden input agar selalu terkirim 0 jika tidak dicentang -->
                                    <input type="hidden" name="anonim" value="0">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="anonim" value="1" class="sr-only peer">
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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        // Admin fee configuration from PHP
        const adminFeeConfig = @json($adminFeeConfig);

        // Add this JavaScript code to replace the existing script section in your HTML
        const user = @json($user);

        // Form state management
        let currentStep = 1;
        let selectedDonationType = 'dana';
        let donationAmount = 0;
        const totalSteps = 3;

        // DOM elements
        const steps = {
            1: document.getElementById('step1'),
            2: document.getElementById('step2'),
            3: document.getElementById('step3')
        };

        // Function to calculate admin fee (JavaScript version of your PHP function)
        function calculateAdminFee(amount) {
            if (!adminFeeConfig.enabled) {
                return 0;
            }

            let fee = 0;

            if (adminFeeConfig.type === 'FIXED') {
                fee = adminFeeConfig.fixed_amount;
            } else if (adminFeeConfig.type === 'PERCENTAGE') {
                fee = amount * (adminFeeConfig.value / 100);
            }

            // Apply minimum and maximum limits
            fee = Math.max(fee, adminFeeConfig.minimum_fee);
            fee = Math.min(fee, adminFeeConfig.maximum_fee);

            // Apply rounding if enabled
            if (adminFeeConfig.rounding.enabled) {
                const precision = adminFeeConfig.rounding.precision;
                fee = Math.round(fee / precision) * precision;
            }

            return Math.floor(fee);
        }

        // Function to calculate total with admin fee
        function calculateTotalWithAdminFee(donationAmount) {
            if (selectedDonationType !== 'dana') {
                return {
                    donationAmount: 0,
                    adminFee: 0,
                    totalAmount: 0
                };
            }

            const adminFee = calculateAdminFee(donationAmount);
            const totalAmount = donationAmount + adminFee;

            return {
                donationAmount: donationAmount,
                adminFee: adminFee,
                totalAmount: totalAmount
            };
        }

        // Update stepper visual state
        function updateStepper() {
            for (let i = 1; i <= totalSteps; i++) {
                const stepElement = document.getElementById(`stepper-step${i}`);
                if (!stepElement) continue;

                const circle = stepElement.querySelector('.w-8.h-8');
                const status = stepElement.querySelector('.text-xs:last-child');

                // Hide step 2 and step 3 for cash donations, only show step 1 and rename step 3 as step 2
                if (selectedDonationType === 'dana') {
                    if (i === 2) {
                        // Hide step 2 completely
                        stepElement.style.display = 'none';
                        const connector = stepElement.nextElementSibling;
                        if (connector && connector.classList.contains('bg-gray-300')) {
                            connector.style.display = 'none';
                        }
                        continue;
                    } else if (i === 3) {
                        // Rename step 3 as step 2 and update its content
                        const stepTitle = stepElement.querySelector('h3');
                        if (stepTitle) stepTitle.textContent = 'Konfirmasi';

                        const stepLabel = stepElement.querySelector('.text-xs.text-gray-500');
                        if (stepLabel) stepLabel.textContent = 'Step 2';
                    }
                } else {
                    // Show all steps for barang and jasa
                    if (i === 2) {
                        stepElement.style.display = 'flex';
                        const connector = stepElement.nextElementSibling;
                        if (connector && connector.classList.contains('bg-gray-300')) {
                            connector.style.display = 'block';
                        }
                    } else if (i === 3) {
                        // Reset step 3 content for barang/jasa
                        const stepTitle = stepElement.querySelector('h3');
                        if (stepTitle) stepTitle.textContent = 'Konfirmasi';

                        const stepLabel = stepElement.querySelector('.text-xs.text-gray-500');
                        if (stepLabel) stepLabel.textContent = 'Step 3';
                    }
                }

                // Determine step numbering for display
                let displayStepNumber = i;
                if (selectedDonationType === 'dana' && i === 3) {
                    displayStepNumber = 2; // Show as step 2 for cash donations
                }

                if (i < currentStep || (i === currentStep)) {
                    stepElement.classList.remove('opacity-50', 'opacity-30');

                    if (i === currentStep) {
                        // Current step
                        circle.className =
                            'w-8 h-8 bg-orange-300 border-2 border-orange-300 rounded-full flex items-center justify-center text-white text-sm font-semibold';
                        circle.textContent = displayStepNumber;
                        if (status) status.textContent = 'Masih berlangsung';
                        if (status) status.className = 'text-xs text-orange-400 mt-1';
                    } else {
                        // Completed step
                        circle.className =
                            'w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold';
                        circle.innerHTML = '<i class="fas fa-check"></i>';
                        if (status) status.textContent = 'Selesai';
                        if (status) status.className = 'text-xs text-teal-600 mt-1';
                    }
                } else {
                    // Future step
                    stepElement.classList.add('opacity-50');
                    stepElement.classList.remove('opacity-30');
                    circle.className =
                        'w-8 h-8 bg-gray-200 border-2 border-gray-300 rounded-full flex items-center justify-center text-gray-500 text-sm font-semibold';
                    circle.textContent = displayStepNumber;
                    if (status) status.textContent = '';
                }
            }
        }

        // Update mobile stepper
        function updateMobileStepper() {
            const stepLabel = document.getElementById('step-label');
            const progressBar = document.getElementById('step-progress-bar');

            if (selectedDonationType === 'dana') {
                // For cash donations, show step as 1/2 or 2/2
                const adjustedStep = currentStep === 3 ? 2 : currentStep;
                const adjustedTotal = 2;

                if (stepLabel) stepLabel.textContent = `Step ${adjustedStep}/${adjustedTotal}`;

                if (progressBar) {
                    const progressPercent = (adjustedStep / adjustedTotal) * 100;
                    progressBar.style.width = `${progressPercent}%`;
                }
            } else {
                // Normal 3-step process for barang and jasa
                if (stepLabel) stepLabel.textContent = `Step ${currentStep}/${totalSteps}`;

                if (progressBar) {
                    const progressPercent = (currentStep / totalSteps) * 100;
                    progressBar.style.width = `${progressPercent}%`;
                }
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

        // Function to show donation breakdown with admin fee
        function updateDonationBreakdown(calculation) {
            const totalDonationSection = document.getElementById('total-donation-section');
            if (!totalDonationSection || selectedDonationType !== 'dana') {
                return;
            }

            // Check if breakdown already exists
            let breakdownElement = document.getElementById('donation-breakdown');

            if (!breakdownElement && calculation.donationAmount > 0) {
                // Create breakdown element
                breakdownElement = document.createElement('div');
                breakdownElement.id = 'donation-breakdown';
                breakdownElement.className = 'mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200 text-sm';

                // Insert after the total donation display
                totalDonationSection.appendChild(breakdownElement);
            }

            if (breakdownElement) {
                if (calculation.donationAmount > 0) {
                    breakdownElement.innerHTML = `
                    <div class="space-y-1">
                        <div class="flex justify-between text-gray-600">
                            <span>Donasi:</span>
                            <span>Rp ${formatNumber(calculation.donationAmount)}</span>
                        </div>
                        ${calculation.adminFee > 0 ? `
                            <div class="flex justify-between text-gray-600">
                                <span>Biaya Admin:</span>
                                <span>Rp ${formatNumber(calculation.adminFee)}</span>
                            </div>
                            <hr class="border-gray-300">
                            <div class="flex justify-between font-semibold text-teal-700">
                                <span>Total Bayar:</span>
                                <span>Rp ${formatNumber(calculation.totalAmount)}</span>
                            </div>
                            ` : ''}
                    </div>
                `;
                    breakdownElement.classList.remove('hidden');
                } else {
                    breakdownElement.classList.add('hidden');
                }
            }
        }

        // Update total donation display with admin fee
        function updateTotalDonation(amount) {
            const calculation = calculateTotalWithAdminFee(amount);

            // Update the main total display
            const totalDonationElement = document.getElementById('totalDonation');
            if (totalDonationElement) {
                totalDonationElement.textContent = 'Rp ' + formatNumber(calculation.totalAmount);
            }

            // Update or create breakdown display
            updateDonationBreakdown(calculation);
        }

        // Also modify the showStep function to call updateBarangListInStep2 when showing step 2
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

            if (nominalDisplay && selectedDonationType === 'dana') {
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

        // Handle nominal display input change with admin fee calculation
        function handleNominalDisplayChange(e) {
            let value = e.target.value;

            // Remove any non-numeric characters except dots
            value = value.replace(/[^\d]/g, '');

            if (value) {
                const numericValue = parseInt(value);

                // Update donation amount
                donationAmount = numericValue;

                // Update total donation display with admin fee
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

            if (selectedDonationType === 'dana') {
                // Show money donation specific elements
                uangSummary.classList.remove('hidden');
                totalDonationSection.classList.remove('hidden');
                confirmButtonSection.classList.remove('md:ml-4');

                // Update nominal display
                const nominalDisplay = document.getElementById('nominal_donasi_display');
                if (nominalDisplay) {
                    nominalDisplay.value = donationAmount > 0 ? formatNumber(donationAmount) : '';
                }

                // Update total donation with admin fee calculation
                updateTotalDonation(donationAmount);

                // Hide barang summary
                hideBarangSummaryInStep3();

            } else if (selectedDonationType === 'barang') {
                // Hide money donation specific elements
                uangSummary.classList.add('hidden');
                totalDonationSection.classList.add('hidden');
                confirmButtonSection.classList.add('md:ml-4');

                // Show barang summary
                showBarangSummaryInStep3();
            } else {
                // Hide money donation specific elements
                uangSummary.classList.add('hidden');
                totalDonationSection.classList.add('hidden');
                confirmButtonSection.classList.add('md:ml-4');

                // Hide barang summary
                hideBarangSummaryInStep3();
            }
        }

        // Function to show barang summary in step 3
        function showBarangSummaryInStep3() {
            const barangForm = window.donasiBarangFormInstance;

            if (!barangForm || barangForm.items.length === 0) {
                hideBarangSummaryInStep3();
                return;
            }

            // Check if summary already exists
            let barangSummary = document.getElementById('barang-summary-step3');

            if (!barangSummary) {
                // Create barang summary container
                barangSummary = document.createElement('div');
                barangSummary.id = 'barang-summary-step3';
                barangSummary.className = 'mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200';

                // Insert before the name/email fields
                const step3Content = document.getElementById('step3');
                const formFields = step3Content.querySelector('.grid.md\\:grid-cols-2');
                formFields.parentNode.insertBefore(barangSummary, formFields);
            }

            // Build HTML content
            let summaryHTML = `
    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
        <i class="fas fa-box mr-2 text-teal-600"></i>
        Ringkasan Barang Donasi (${barangForm.items.length} item)
    </h3>
    <div class="space-y-2 max-h-40 overflow-y-auto">
`;

            barangForm.items.forEach((item, index) => {
                const kondisiBadgeClass = item.kondisi_barang === 'baru' ?
                    'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800';

                summaryHTML += `
        <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
            <div class="flex items-center space-x-3 flex-1">
                <span class="inline-flex items-center justify-center w-6 h-6 bg-teal-100 text-teal-800 text-xs font-semibold rounded-full">
                    ${index + 1}
                </span>
                <div class="flex-1">
                    <p class="font-medium text-gray-900 text-sm">${item.nama_barang}</p>
                    <div class="flex items-center space-x-3 text-xs text-gray-600 mt-1">
                        <span>Jumlah: ${item.jumlah_barang || 1}</span>
                        <span class="px-2 py-1 text-xs font-medium rounded-full ${kondisiBadgeClass}">
                            ${item.kondisi_barang.charAt(0).toUpperCase() + item.kondisi_barang.slice(1)}
                        </span>
                    </div>
                    ${item.deskripsi_barang ? `<p class="text-xs text-gray-500 mt-1">${item.deskripsi_barang.substring(0, 50)}${item.deskripsi_barang.length > 50 ? '...' : ''}</p>` : ''}
                </div>
            </div>
            <button type="button" onclick="editBarangFromStep3()" class="text-teal-600 hover:text-teal-700 text-sm">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    `;
            });

            summaryHTML += `
    </div>
    <div class="mt-3 text-center">
        <button type="button" onclick="goToStep(1)" class="text-teal-600 hover:text-teal-700 text-sm font-medium">
            <i class="fas fa-edit mr-1"></i> Edit Daftar Barang
        </button>
    </div>
`;

            barangSummary.innerHTML = summaryHTML;
            barangSummary.classList.remove('hidden');
        }

        // Function to hide barang summary in step 3
        function hideBarangSummaryInStep3() {
            const barangSummary = document.getElementById('barang-summary-step3');
            if (barangSummary) {
                barangSummary.classList.add('hidden');
            }
        }

        // Helper function for edit button
        function editBarangFromStep3() {
            goToStep(1);
        }

        // Donation type handling
        const donationTypes = document.querySelectorAll('input[name="jenis_donasi"]');
        const donationSections = {
            'dana': document.getElementById('donasi-uang'),
            'barang': document.getElementById('donasi-barang'),
            'jasa': document.getElementById('donasi-jasa')
        };

        const nonPaymentInfoSection = document.getElementById('non-payment-info');

        // Update donation type change listener
        donationTypes.forEach(radio => {
            radio.addEventListener('change', function() {
                selectedDonationType = this.value;
                document.getElementById('jenis_donasi').value = this.value;

                // Update stepper when donation type changes
                updateStepper();
                updateMobileStepper();
                updateStep3Display();

                // Hide all donation sections
                Object.values(donationSections).forEach(section => section.classList.add('hidden'));

                // Show section based on selection
                if (donationSections[this.value]) {
                    donationSections[this.value].classList.remove('hidden');
                }

                // Reset amount if not money donation
                if (this.value !== 'dana') {
                    donationAmount = 0;
                }

                // Update judul step 2 secara real-time
                const step2Title = document.getElementById('step2-title');
                if (step2Title) {
                    step2Title.textContent = selectedDonationType === 'dana' ? 'Metode Pembayaran' :
                        'Informasi Penyerahan';
                }

                // Call payment methods visibility
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

                // Update total if we're in step 3
                if (currentStep === 3) {
                    updateTotalDonation(donationAmount);
                }
            });
        });

        // Clear nominal buttons when typing custom amount
        nominalInput.addEventListener('input', function() {
            nominalButtons.forEach(btn => {
                btn.classList.remove('border-teal-500', 'bg-teal-50');
                btn.classList.add('border-gray-200');
            });
            donationAmount = parseInt(this.value) || 0;

            // Update total if we're in step 3
            if (currentStep === 3) {
                updateTotalDonation(donationAmount);
            }
        });

        // Update handlePaymentMethodsVisibility function
        function handlePaymentMethodsVisibility() {
            if (selectedDonationType === 'dana') {
                document.getElementById('nextStep2').addEventListener('click', function() {
                    showStep(3);
                });
            } else {
                nonPaymentInfoSection.classList.remove('hidden');

                const title2 = document.getElementById('title-step2');
                const desc2 = document.getElementById('desc-step2');
                if (title2) title2.textContent = 'Informasi Penyerahan Barang atau Jasa';
                if (desc2) desc2.textContent = 'Silakan isi data diri di halaman selanjutnya dengan benar';
            }
        }

        // Step validation
        function validateStep1() {
            let isValid = true;

            // Check donation type
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');

            // Validate donation specific fields
            if (donationType.value === 'dana') {
                const nominal = document.querySelector('[name="nominal"]');
                if (!nominal.value || nominal.value < 10000) {
                    isValid = false;
                    showAlert('Mohon masukkan nominal donasi minimal Rp 10.000');
                    nominal.focus();
                }
            } else if (donationType.value === 'barang') {
                // Untuk donasi barang, validasi berdasarkan items yang sudah ditambahkan
                const barangForm = window.donasiBarangFormInstance;
                if (!barangForm || barangForm.items.length === 0) {
                    isValid = false;
                    showAlert('Mohon tambahkan minimal satu barang untuk donasi');
                    return false;
                }

                // Validate each item
                for (let i = 0; i < barangForm.items.length; i++) {
                    const item = barangForm.items[i];
                    if (!item.nama_barang || !item.kondisi_barang || !item.deskripsi_barang) {
                        isValid = false;
                        showAlert(`Barang ke-${i + 1} belum lengkap. Mohon periksa kembali.`);
                        break;
                    }
                }
            } else if (donationType.value === 'jasa') {
                const jenisJasa = document.querySelector('[name="jenis_jasa"]');
                const durasiJasa = document.querySelector('[name="durasi_jasa"]');
                if (!jenisJasa.value || !durasiJasa.value.trim()) {
                    isValid = false;
                    showAlert('Mohon lengkapi data donasi jasa');
                }
            }

            return isValid;
        }

        function validateStep2() {
            return true; // Step 2 doesn't need validation for now
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

            // Validate based on donation type
            if (selectedDonationType === 'dana') {
                if (!donationAmount || donationAmount < 10000) {
                    showAlert('Mohon masukkan nominal donasi minimal Rp 10.000');
                    const nominalDisplay = document.getElementById('nominal_donasi_display');
                    if (nominalDisplay) {
                        nominalDisplay.focus();
                    }
                    return false;
                }
            } else if (selectedDonationType === 'barang') {
                const barangForm = window.donasiBarangFormInstance;
                if (!barangForm || barangForm.items.length === 0) {
                    showAlert('Mohon tambahkan minimal satu barang untuk donasi');
                    goToStep(1);
                    return false;
                }

                // Validate each barang item
                for (let i = 0; i < barangForm.items.length; i++) {
                    const item = barangForm.items[i];
                    if (!item.nama_barang || !item.kondisi_barang || !item.deskripsi_barang) {
                        showAlert(`Data barang ke-${i + 1} tidak lengkap. Mohon periksa kembali.`);
                        goToStep(1);
                        return false;
                    }
                }
            } else if (selectedDonationType === 'jasa') {
                const jenisJasa = document.querySelector('[name="jenis_jasa"]');
                const durasiJasa = document.querySelector('[name="durasi_jasa"]');

                if (!jenisJasa || !jenisJasa.value) {
                    showAlert('Mohon pilih jenis jasa');
                    goToStep(1);
                    return false;
                }

                if (!durasiJasa || !durasiJasa.value.trim()) {
                    showAlert('Mohon isi durasi jasa');
                    goToStep(1);
                    return false;
                }
            }

            return true;
        }

        // Step navigation handlers
        document.getElementById('nextStep1').addEventListener('click', function() {
            if (validateStep1()) {
                // If donation type is 'dana', skip step 2 and go directly to step 3
                if (selectedDonationType === 'dana') {
                    showStep(3);
                } else {
                    // For 'barang' and 'jasa', go to step 2 as usual
                    showStep(2);
                    handlePaymentMethodsVisibility();
                }
            }
        });

        document.getElementById('nextStep2').addEventListener('click', function() {
            if (validateStep2()) {
                showStep(3);
            }
        });

        // Add this function to prepare form data before submission with admin fee
        function prepareFormData() {
            const form = document.getElementById('donationForm');

            // Remove existing hidden inputs for barang to avoid duplicates
            const existingBarangInputs = form.querySelectorAll('input[name^="DonasiBarang["]');
            existingBarangInputs.forEach(input => input.remove());

            // Remove existing admin fee inputs
            const existingAdminFeeInputs = form.querySelectorAll('input[name="admin_fee"], input[name="total_amount"]');
            existingAdminFeeInputs.forEach(input => input.remove());

            // If donation type is dana, add admin fee information
            if (selectedDonationType === 'dana' && donationAmount > 0) {
                const calculation = calculateTotalWithAdminFee(donationAmount);

                // Add admin fee as hidden input
                const adminFeeInput = document.createElement('input');
                adminFeeInput.type = 'hidden';
                adminFeeInput.name = 'admin_fee';
                adminFeeInput.value = calculation.adminFee;
                form.appendChild(adminFeeInput);

                // Add total amount as hidden input
                const totalAmountInput = document.createElement('input');
                totalAmountInput.type = 'hidden';
                totalAmountInput.name = 'total_amount';
                totalAmountInput.value = calculation.totalAmount;
                form.appendChild(totalAmountInput);
            }

            // If donation type is barang, add items to form data
            if (selectedDonationType === 'barang') {
                const barangForm = window.donasiBarangFormInstance;

                if (barangForm && barangForm.items.length > 0) {
                    barangForm.items.forEach((item, index) => {
                        // Create hidden inputs for each item
                        const inputs = [{
                                name: `DonasiBarang[${index}][nama_barang]`,
                                value: item.nama_barang
                            },
                            {
                                name: `DonasiBarang[${index}][jumlah_barang]`,
                                value: item.jumlah_barang || 1
                            },
                            {
                                name: `DonasiBarang[${index}][kondisi]`,
                                value: item.kondisi_barang
                            },
                            {
                                name: `DonasiBarang[${index}][deskripsi]`,
                                value: item.deskripsi_barang || ''
                            }
                        ];

                        inputs.forEach(inputData => {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = inputData.name;
                            hiddenInput.value = inputData.value;
                            form.appendChild(hiddenInput);
                        });
                    });
                }
            }
        }

        // Update the form submission handler
        document.getElementById('donationForm').addEventListener('submit', function(e) {
            if (!validateStep3()) {
                e.preventDefault();
                return;
            }

            // Prepare form data before submission
            prepareFormData();

            // Update the original nominal input with the final amount
            if (selectedDonationType === 'dana') {
                const nominalInput = document.getElementById('nominal-input');
                if (nominalInput) {
                    nominalInput.value = donationAmount;
                }
            }
        });

        // Update the prevStep handler to handle the skip logic
        document.getElementById('prevStep').addEventListener('click', function() {
            if (currentStep === 1) {
                window.location.href = "{{ url()->previous() }}";
            } else if (currentStep === 3 && selectedDonationType === 'dana') {
                // If we're on step 3 and donation type is 'dana', go back to step 1 (skip step 2)
                showStep(1);
            } else {
                // Normal back navigation
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

        
        showStep(1);
        handlePaymentMethodsVisibility();

        const defaultDonationType = document.querySelector('input[name="jenis_donasi"]:checked');

        if (defaultDonationType && donationSections[defaultDonationType.value]) {
            donationSections[defaultDonationType.value].classList.remove('hidden');
            selectedDonationType = defaultDonationType.value;
        }

        // Enhanced donasiBarangForm function
        function donasiBarangForm() {
            const instance = {
                items: [],
                form: {
                    nama_barang: '',
                    kondisi_barang: '',
                    jumlah_barang: '',
                    deskripsi_barang: ''
                },

                tambahBarang() {
                    // Validasi sederhana
                    if (!this.form.nama_barang || !this.form.kondisi_barang || !this.form.deskripsi_barang) {
                        alert('Harap isi semua kolom yang wajib (Nama Barang, Kondisi, dan Deskripsi).');
                        return;
                    }

                    // Validasi jumlah barang
                    if (this.form.jumlah_barang && this.form.jumlah_barang < 1) {
                        alert('Jumlah barang minimal 1.');
                        return;
                    }

                    // Salin data form ke list
                    this.items.push({
                        ...this.form,
                        jumlah_barang: this.form.jumlah_barang || '1' // Default 1 jika kosong
                    });

                    // Reset form
                    this.resetForm();

                    // Scroll ke atas untuk melihat item yang ditambahkan
                    document.querySelector('#donasi-barang').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                },

                hapusBarang(index) {
                    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                        this.items.splice(index, 1);
                    }
                },

                hapusSemuaBarang() {
                    if (confirm('Apakah Anda yakin ingin menghapus semua item barang?')) {
                        this.items = [];
                    }
                },

                resetForm() {
                    this.form = {
                        nama_barang: '',
                        kondisi_barang: '',
                        jumlah_barang: '',
                        deskripsi_barang: ''
                    };
                },

                // Helper method untuk mendapatkan total item
                get totalItems() {
                    return this.items.length;
                },

                // Helper method untuk validasi form
                get isFormValid() {
                    return this.form.nama_barang &&
                        this.form.kondisi_barang &&
                        this.form.deskripsi_barang;
                }
            };

            // Simpan instance globally untuk akses dari fungsi lain
            window.donasiBarangFormInstance = instance;

            return instance;
        }
    </script>
</body>

</html>
