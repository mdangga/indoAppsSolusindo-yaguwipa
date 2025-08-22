<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Kerja Sama</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <x-admin.navbar-admin />
    <x-admin.sidebar />

    <main class="p-4 md:p-6 md:ml-64 pt-16 md:pt-20 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Detail Donasi</h2>
            </div>

            <div class="p-6 space-y-8">
                <!-- Informasi Lembaga -->
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Donatur
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nama</span>
                                <span class="text-sm font-semibold text-gray-900 mt-1">{{ $donasi->nama }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</span>
                                <span class="text-sm text-gray-700 mt-1">{{ $donasi->email }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Anonim</span>
                                <div class="mt-1">
                                    @if ($donasi->anonim == 1)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">

                                            Privat
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-black border border-gray-200">

                                            Publik
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">No
                                    Telepon</span>
                                <span class="text-sm font-semibold text-gray-900 mt-1">
                                    {{ optional($donasi->User)->no_tlp ?? '-' }}
                                </span>

                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Alamat</span>
                                <span
                                    class="text-sm text-gray-700 mt-1">{{ optional($donasi->User)->alamat ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status</span>
                                <div class="mt-1">
                                    @if ($donasi->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Menunggu
                                        </span>
                                    @elseif ($donasi->status === 'approved')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Diterima
                                        </span>
                                    @elseif ($donasi->status === 'rejected')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Gagal
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($donasi->alasan)
                            <div>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Alasan
                                    Penolakan</span>
                                <p class="text-sm text-gray-700 mt-1">
                                    {{ $donasi->alasan }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Keterangan -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pesan dari donatur
                        </span>
                        <p class="text-sm text-gray-700 mt-2 leading-relaxed">
                            {{ $donasi->pesan ?? '-' }}</p>
                    </div>
                </div>
                <!-- Detail Berdasarkan Jenis Donasi -->
                @if (strtolower($donasi->JenisDonasi->nama) === 'barang')
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Daftar Barang Donasi
                        </h3>

                        <div class="space-y-4">
                            @foreach ($donasi->donasiBarang as $barang)
                                <div
                                    class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <!-- Left Side - Info -->
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 mb-1">{{ $barang->nama_barang }}
                                            </h4>
                                            @if ($barang->deskripsi)
                                                <p class="text-sm text-gray-600 mb-2">{{ $barang->deskripsi }}</p>
                                            @endif

                                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                <span><strong>Jumlah:</strong> {{ $barang->jumlah_barang }}</span>
                                                <span><strong>Kondisi:</strong> {{ ucfirst($barang->kondisi) }}</span>
                                                @if ($barang->status_verifikasi === 'pending')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Menunggu
                                                    </span>
                                                @elseif ($barang->status_verifikasi === 'approved')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Diterima
                                                    </span>
                                                @elseif ($barang->status_verifikasi === 'rejected')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Right Side - Buttons -->
                                        @if ($barang->status_verifikasi === 'pending')
                                            <div class="flex items-center space-x-2 ml-4">
                                                <form method="POST"
                                                    action="{{ route('barang.approved', $barang->id_donasi_barang) }}">
                                                    @csrf
                                                    <input type="hidden" name="status_verifikasi" value="disetujui">
                                                    <button type="submit"
                                                        class="px-3 py-1.5 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition-colors">
                                                        Setujui
                                                    </button>
                                                </form>

                                                <form method="POST"
                                                    action="{{ route('barang.rejected', $barang->id_donasi_barang) }}">
                                                    @csrf
                                                    <input type="hidden" name="status_verifikasi" value="ditolak">
                                                    <button type="submit"
                                                        class="px-3 py-1.5 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition-colors"
                                                        onclick="return confirm('Yakin ingin menolak?')">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary -->
                        <div class="mt-6 text-sm text-gray-600">
                            <span>Total: {{ count($donasi->donasiBarang) }} item</span>
                        </div>
                    </div>
                @elseif (strtolower($donasi->JenisDonasi->nama) === 'jasa')
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Donasi Jasa
                        </h3>
                        <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-shadow">
                            <div class="flex items-center justify-between">
                                <!-- Left Side - Info -->
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 mb-1 uppercase">
                                        {{ $donasi->DonasiJasa->jenis_jasa }}</h4>

                                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                                        <span><strong>Durasi:</strong>
                                            {{ ucfirst($donasi->DonasiJasa->durasi_jasa) }}</span>
                                        @if ($donasi->DonasiJasa->status_verifikasi === 'pending')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Menunggu
                                            </span>
                                        @elseif ($donasi->DonasiJasa->status_verifikasi === 'approved')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Diterima
                                            </span>
                                        @elseif ($donasi->DonasiJasa->status_verifikasi === 'rejected')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Ditolak
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($donasi->status === 'pending')
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Alasan / Catatan Donasi</h3>
                        <textarea id="alasan-text" rows="4"
                            class="w-full px-3 py-2 mb-3 text-gray-700 border rounded-lg focus:outline-none border-gray-300"
                            placeholder="Masukkan alasan..."></textarea>
                        <p class="text-xs text-gray-500">jika tidak ada alasan bisa ketik 'Tidak Ada'</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.donasi') }}"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>

                    @if ($donasi->status === 'pending')
                        <div class="flex flex-col sm:flex-row gap-3 sm:ml-auto">
                            <!-- Terima -->
                            @if (strtolower($donasi->JenisDonasi->nama) !== 'dana')
                                <form action="{{ route('donasi.approved', $donasi->id_donasi) }}" method="POST"
                                    class="alasan-form">
                                    @csrf
                                    <input type="hidden" name="alasan" class="hidden-alasan">
                                    <button type="button" onclick="submitWithAlasan(this)"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                            @endif

                            <!-- Tolak -->
                            <form action="{{ route('donasi.rejected', $donasi->id_donasi) }}" method="POST"
                                class="alasan-form">
                                @csrf
                                <input type="hidden" name="alasan" class="hidden-alasan">
                                <button type="button" onclick="submitWithAlasan(this)"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script>
        function submitWithAlasan(button) {
            const alasan = document.getElementById('alasan-text').value.trim();
            if (!alasan) {
                alert('Alasan wajib diisi sebelum memproses donasi.');
                return;
            }
            const form = button.closest('form');
            form.querySelector('.hidden-alasan').value = alasan;
            form.submit();
        }
    </script>
</body>

</html>
