<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Donasi - Berbagi Kebaikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                <i class="fas fa-heart text-red-500 mr-3"></i>
                Form Donasi
            </h1>
            <p class="text-gray-600 text-lg">Berbagi kebaikan untuk sesama yang membutuhkan</p>
        </div>

        <!-- Main Form -->
        <div class="max-w-4xl mx-auto">
            <form id="donationForm" class="bg-white rounded-2xl shadow-2xl overflow-hidden">

                <!-- Progress Bar -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6">
                    <div class="flex justify-between items-center text-white">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-white bg-opacity-30 rounded-full flex items-center justify-center">
                                <span class="text-sm font-semibold">1</span>
                            </div>
                            <span class="font-medium">Data Donatur</span>
                        </div>
                        <div class="flex items-center space-x-2 opacity-50">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <span class="text-sm font-semibold">2</span>
                            </div>
                            <span class="font-medium">Pembayaran</span>
                        </div>
                        <div class="flex items-center space-x-2 opacity-50">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <span class="text-sm font-semibold">3</span>
                            </div>
                            <span class="font-medium">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Data Donatur -->
                <div id="step1" class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Donatur</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-blue-500"></i>Nama Lengkap *
                            </label>
                            <input type="text" name="nama" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Masukkan nama lengkap">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-blue-500"></i>Email *
                            </label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="nama@email.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-phone mr-2 text-blue-500"></i>No. Telepon *
                            </label>
                            <input type="tel" name="telepon" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>Kota
                            </label>
                            <input type="text" name="kota"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Kota tempat tinggal">
                        </div>
                    </div>

                    <!-- Jenis Donasi -->
                    <div class="mt-8">
                        <label class="block text-sm font-medium text-gray-700 mb-4">
                            <i class="fas fa-hand-holding-heart mr-2 text-blue-500"></i>Jenis Donasi *
                        </label>
                        <div class="grid md:grid-cols-3 gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="jenis_donasi" value="uang" class="sr-only peer" required>
                                <div
                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                    <i class="fas fa-money-bill-wave text-3xl text-green-500 mb-3"></i>
                                    <h3 class="font-semibold text-gray-800">Donasi Uang</h3>
                                    <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk uang tunai</p>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="jenis_donasi" value="barang" class="sr-only peer">
                                <div
                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                    <i class="fas fa-box text-3xl text-orange-500 mb-3"></i>
                                    <h3 class="font-semibold text-gray-800">Donasi Barang</h3>
                                    <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk barang</p>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="jenis_donasi" value="jasa" class="sr-only peer">
                                <div
                                    class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                    <i class="fas fa-handshake text-3xl text-purple-500 mb-3"></i>
                                    <h3 class="font-semibold text-gray-800">Donasi Jasa</h3>
                                    <p class="text-sm text-gray-600 mt-2">Donasi dalam bentuk jasa/keahlian</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Detail Donasi Uang -->
                    <div id="donasi-uang" class="hidden mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-coins mr-2 text-blue-500"></i>Nominal Donasi *
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                            <button type="button"
                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-200"
                                data-nominal="25000">
                                Rp 25.000
                            </button>
                            <button type="button"
                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-200"
                                data-nominal="50000">
                                Rp 50.000
                            </button>
                            <button type="button"
                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-200"
                                data-nominal="100000">
                                Rp 100.000
                            </button>
                            <button type="button"
                                class="nominal-btn border-2 border-gray-200 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50 transition duration-200"
                                data-nominal="250000">
                                Rp 250.000
                            </button>
                        </div>
                        <input type="number" name="nominal" id="nominal-input"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Atau masukkan nominal lainnya" min="10000">
                    </div>

                    <!-- Detail Donasi Barang -->
                    <div id="donasi-barang" class="hidden mt-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>Jenis Barang *
                                </label>
                                <select name="jenis_barang"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
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
                                    <i class="fas fa-weight mr-2 text-blue-500"></i>Estimasi Nilai (Rp)
                                </label>
                                <input type="number" name="nilai_barang"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Estimasi nilai barang">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clipboard-list mr-2 text-blue-500"></i>Deskripsi Barang *
                            </label>
                            <textarea name="deskripsi_barang" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Jelaskan kondisi dan detail barang yang akan didonasikan"></textarea>
                        </div>
                    </div>

                    <!-- Detail Donasi Jasa -->
                    <div id="donasi-jasa" class="hidden mt-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tools mr-2 text-blue-500"></i>Jenis Jasa *
                                </label>
                                <select name="jenis_jasa"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
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
                                    <i class="fas fa-clock mr-2 text-blue-500"></i>Estimasi Waktu
                                </label>
                                <input type="text" name="waktu_jasa"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Contoh: 2 jam, 1 hari, dll">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clipboard-list mr-2 text-blue-500"></i>Deskripsi Jasa *
                            </label>
                            <textarea name="deskripsi_jasa" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Jelaskan jasa/keahlian yang bisa Anda berikan"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" id="nextStep1"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition duration-200">
                            Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Pembayaran -->
                <div id="step2" class="hidden p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Metode Pembayaran</h2>

                    <!-- Payment Methods untuk Donasi Uang -->
                    <div id="payment-methods" class="hidden space-y-4">
                        <!-- E-Wallet -->
                        <div class="border-2 border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas fa-mobile-alt mr-2 text-blue-500"></i>E-Wallet
                            </h3>
                            <div class="grid md:grid-cols-3 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="gopay" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200">
                                        <div
                                            class="bg-green-500 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <span class="font-medium">GoPay</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="ovo" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-purple-500 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition duration-200">
                                        <div
                                            class="bg-purple-500 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fas fa-mobile"></i>
                                        </div>
                                        <span class="font-medium">OVO</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="dana" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                        <div
                                            class="bg-blue-500 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fas fa-coins"></i>
                                        </div>
                                        <span class="font-medium">DANA</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Bank Transfer -->
                        <div class="border-2 border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas fa-university mr-2 text-blue-500"></i>Transfer Bank
                            </h3>
                            <div class="grid md:grid-cols-4 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="bca" class="sr-only peer">
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
                                    <input type="radio" name="payment_method" value="bni" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-orange-500 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition duration-200">
                                        <div
                                            class="bg-orange-500 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <span class="font-medium">BNI</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="bri" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-blue-800 peer-checked:border-blue-800 peer-checked:bg-blue-50 transition duration-200">
                                        <div
                                            class="bg-blue-800 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <span class="font-medium">BRI</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Credit Card -->
                        <div class="border-2 border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas fa-credit-card mr-2 text-blue-500"></i>Kartu Kredit/Debit
                            </h3>
                            <div class="grid md:grid-cols-3 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="visa" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-blue-700 peer-checked:border-blue-700 peer-checked:bg-blue-50 transition duration-200">
                                        <div
                                            class="bg-blue-700 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fab fa-cc-visa"></i>
                                        </div>
                                        <span class="font-medium">Visa</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="mastercard"
                                        class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-red-500 peer-checked:border-red-500 peer-checked:bg-red-50 transition duration-200">
                                        <div
                                            class="bg-red-500 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fab fa-cc-mastercard"></i>
                                        </div>
                                        <span class="font-medium">Mastercard</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="amex" class="sr-only peer">
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 text-center hover:border-green-600 peer-checked:border-green-600 peer-checked:bg-green-50 transition duration-200">
                                        <div
                                            class="bg-green-600 text-white rounded-lg p-3 w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                            <i class="fab fa-cc-amex"></i>
                                        </div>
                                        <span class="font-medium">American Express</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Info untuk Donasi Barang/Jasa -->
                    <div id="non-payment-info" class="hidden">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                                <div>
                                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Informasi Penyerahan</h3>
                                    <p class="text-blue-700 mb-4">
                                        Untuk donasi barang atau jasa, tim kami akan menghubungi Anda dalam 1x24 jam
                                        untuk mengatur jadwal penyerahan atau koordinasi lebih lanjut.
                                    </p>
                                    <div class="space-y-2 text-sm text-blue-600">
                                        <p><i class="fas fa-check mr-2"></i>Tim akan menghubungi via telepon/email</p>
                                        <p><i class="fas fa-check mr-2"></i>Koordinasi jadwal yang sesuai</p>
                                        <p><i class="fas fa-check mr-2"></i>Konfirmasi detail donasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" id="prevStep2"
                            class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </button>
                        <button type="button" id="nextStep2"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition duration-200">
                            Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Konfirmasi -->
                <div id="step3" class="hidden p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Konfirmasi Donasi</h2>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Donasi</h3>
                        <div id="donation-summary" class="space-y-3 text-gray-700">
                            <!-- Summary akan diisi oleh JavaScript -->
                        </div>
                    </div>

                    <!-- Pesan/Doa -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment-dots mr-2 text-blue-500"></i>Pesan atau Doa (Opsional)
                        </label>
                        <textarea name="pesan" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Tuliskan pesan atau doa untuk penerima donasi..."></textarea>
                    </div>

                    <!-- Anonim -->
                    <div class="mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="anonim" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700">
                                <i class="fas fa-user-secret mr-2 text-blue-500"></i>Donasi secara anonim
                            </span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1 ml-14">Nama Anda tidak akan ditampilkan secara publik</p>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-6">
                        <label class="flex items-start cursor-pointer">
                            <input type="checkbox" name="terms" required class="mt-1 mr-3">
                            <span class="text-sm text-gray-700">
                                Saya menyetujui <a href="#" class="text-blue-500 hover:underline">syarat dan
                                    ketentuan</a>
                                serta <a href="#" class="text-blue-500 hover:underline">kebijakan privasi</a>
                                yang berlaku.
                            </span>
                        </label>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" id="prevStep3"
                            class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 transform hover:scale-105 transition duration-200">
                            <i class="fas fa-heart mr-2"></i> Konfirmasi Donasi
                        </button>
                    </div>
                </div>

            </form>

            <!-- Success Modal -->
            <div id="successModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl p-8 max-w-md mx-4 text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-3xl text-green-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Terima Kasih!</h3>
                    <p class="text-gray-600 mb-6">Donasi Anda telah berhasil dikirim. Kami akan segera memproses donasi
                        Anda.</p>
                    <button onclick="location.reload()"
                        class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-indigo-700 transition duration-200">
                        Donasi Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form state management
        let currentStep = 1;
        const totalSteps = 3;

        // DOM elements
        const steps = {
            1: document.getElementById('step1'),
            2: document.getElementById('step2'),
            3: document.getElementById('step3')
        };

        const nextButtons = {
            1: document.getElementById('nextStep1'),
            2: document.getElementById('nextStep2')
        };

        const prevButtons = {
            2: document.getElementById('prevStep2'),
            3: document.getElementById('prevStep3')
        };

        // Progress bar update
        function updateProgressBar() {
            const progressItems = document.querySelectorAll('.bg-gradient-to-r .flex');
            progressItems.forEach((item, index) => {
                const stepNumber = index + 1;
                if (stepNumber <= currentStep) {
                    item.classList.remove('opacity-50');
                    item.querySelector('.w-8').classList.remove('bg-white', 'bg-opacity-20');
                    item.querySelector('.w-8').classList.add('bg-white', 'bg-opacity-30');
                } else {
                    item.classList.add('opacity-50');
                    item.querySelector('.w-8').classList.remove('bg-white', 'bg-opacity-30');
                    item.querySelector('.w-8').classList.add('bg-white', 'bg-opacity-20');
                }
            });
        }

        // Show step
        function showStep(step) {
            // Hide all steps
            Object.values(steps).forEach(stepElement => {
                stepElement.classList.add('hidden');
            });

            // Show current step
            steps[step].classList.remove('hidden');
            currentStep = step;
            updateProgressBar();
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
                // Sembunyikan semua bagian donasi
                Object.values(donationSections).forEach(section => section.classList.add('hidden'));
                paymentMethodsSection.classList.add('hidden');
                nonPaymentInfoSection.classList.add('hidden');

                // Tampilkan bagian sesuai pilihan
                if (donationSections[this.value]) {
                    donationSections[this.value].classList.remove('hidden');
                }

                if (this.value === 'uang') {
                    paymentMethodsSection.classList.remove('hidden');
                } else {
                    nonPaymentInfoSection.classList.remove('hidden');
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
                    btn.classList.remove('border-blue-500', 'bg-blue-50');
                    btn.classList.add('border-gray-200');
                });

                // Activate clicked button
                this.classList.remove('border-gray-200');
                this.classList.add('border-blue-500', 'bg-blue-50');

                // Set nominal value
                const nominal = this.getAttribute('data-nominal');
                nominalInput.value = nominal;
            });
        });

        // Clear nominal buttons when typing custom amount
        nominalInput.addEventListener('input', function() {
            nominalButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'bg-blue-50');
                btn.classList.add('border-gray-200');
            });
        });

        // Step navigation
        nextButtons[1].addEventListener('click', function() {
            if (validateStep1()) {
                showStep(2);
                handlePaymentMethodsVisibility();
            }
        });

        nextButtons[2].addEventListener('click', function() {
            if (validateStep2()) {
                showStep(3);
                generateSummary();
            }
        });

        prevButtons[2].addEventListener('click', function() {
            showStep(1);
        });

        prevButtons[3].addEventListener('click', function() {
            showStep(2);
        });

        // Step validation
        function validateStep1() {
            const requiredFields = ['jenis_donasi'];
            let isValid = true;

            requiredFields.forEach(field => {
                const element = document.querySelector(`[name="${field}"]`);
                if (field === 'jenis_donasi') {
                    const checked = document.querySelector(`[name="${field}"]:checked`);
                    if (!checked) {
                        isValid = false;
                        alert('Mohon pilih jenis donasi');
                        return;
                    }
                } else {
                    if (!element.value.trim()) {
                        isValid = false;
                        element.focus();
                        alert(`Mohon isi ${field}`);
                        return;
                    }
                }
            });

            // Validate donation specific fields
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');
            if (donationType) {
                if (donationType.value === 'uang') {
                    const nominal = document.querySelector('[name="nominal"]');
                    if (!nominal.value || nominal.value < 10000) {
                        isValid = false;
                        alert('Mohon masukkan nominal donasi minimal Rp 10.000');
                        nominal.focus();
                    }
                } else if (donationType.value === 'barang') {
                    const jenisBarang = document.querySelector('[name="jenis_barang"]');
                    const deskripsiBarang = document.querySelector('[name="deskripsi_barang"]');
                    if (!jenisBarang.value || !deskripsiBarang.value.trim()) {
                        isValid = false;
                        alert('Mohon lengkapi data donasi barang');
                    }
                } else if (donationType.value === 'jasa') {
                    const jenisJasa = document.querySelector('[name="jenis_jasa"]');
                    const deskripsiJasa = document.querySelector('[name="deskripsi_jasa"]');
                    if (!jenisJasa.value || !deskripsiJasa.value.trim()) {
                        isValid = false;
                        alert('Mohon lengkapi data donasi jasa');
                    }
                }
            }

            return isValid;
        }

        function validateStep2() {
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');
            if (donationType && donationType.value === 'uang') {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
                if (!paymentMethod) {
                    alert('Mohon pilih metode pembayaran');
                    return false;
                }
            }
            return true;
        }

        // Handle payment methods visibility
        function handlePaymentMethodsVisibility() {
            const donationType = document.querySelector('input[name="jenis_donasi"]:checked');
            const paymentMethods = document.getElementById('payment-methods');
            const nonPaymentInfo = document.getElementById('non-payment-info');

            if (donationType && donationType.value === 'uang') {
                paymentMethods.classList.remove('hidden');
                nonPaymentInfo.classList.add('hidden');
            } else {
                paymentMethods.classList.add('hidden');
                nonPaymentInfo.classList.remove('hidden');
            }
        }

        // Generate summary
        function generateSummary() {
            const summaryContainer = document.getElementById('donation-summary');
            const formData = new FormData(document.getElementById('donationForm'));
            let summaryHTML = '';

            // Basic info
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Nama:</span><span>${formData.get('nama')}</span></div>`;
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Email:</span><span>${formData.get('email')}</span></div>`;
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Telepon:</span><span>${formData.get('telepon')}</span></div>`;

            // Donation info
            const donationType = formData.get('jenis_donasi');
            summaryHTML +=
                `<div class="flex justify-between"><span class="font-medium">Jenis Donasi:</span><span class="capitalize">${donationType}</span></div>`;

            if (donationType === 'uang') {
                const nominal = parseInt(formData.get('nominal'));
                summaryHTML +=
                    `<div class="flex justify-between"><span class="font-medium">Nominal:</span><span class="text-green-600 font-semibold">Rp ${nominal.toLocaleString('id-ID')}</span></div>`;

                const paymentMethod = formData.get('payment_method');
                if (paymentMethod) {
                    summaryHTML +=
                        `<div class="flex justify-between"><span class="font-medium">Metode Pembayaran:</span><span class="capitalize">${paymentMethod}</span></div>`;
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

            summaryContainer.innerHTML = summaryHTML;
        }

        // Form submission
        document.getElementById('donationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate terms
            const terms = document.querySelector('[name="terms"]');
            if (!terms.checked) {
                alert('Mohon setujui syarat dan ketentuan');
                return;
            }

            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
            document.getElementById('successModal').classList.add('flex');

            // Here you would normally send the data to your server
            console.log('Form submitted:', new FormData(this));
        });

        // Initialize
        showStep(1);
    </script>
</body>

</html>
