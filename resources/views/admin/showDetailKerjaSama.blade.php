<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Kerja Sama</title>
    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <x-admin.navbar-admin />
    <x-admin.sidebar />

    <main class="p-4 md:p-6 md:ml-64 pt-16 md:pt-20 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Detail Pengajuan Kerja Sama</h2>
            </div>

            <div class="p-6 space-y-8">
                <!-- Informasi Lembaga -->
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Informasi Lembaga
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nama
                                    Lembaga</span>
                                <span
                                    class="text-sm font-semibold text-gray-900 mt-1">{{ $kerjasama->Mitra->User->nama }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</span>
                                <span class="text-sm text-gray-700 mt-1">{{ $kerjasama->Mitra->User->email }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Penanggung
                                    Jawab</span>
                                <span
                                    class="text-sm font-medium text-gray-700 mt-1">{{ $kerjasama->Mitra->penanggung_jawab }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Jenis Kerja
                                    Sama</span>
                                <span
                                    class="text-sm font-medium text-amber-700 mt-1">{{ $kerjasama->KategoriKerjaSama->nama }}</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Alamat</span>
                                <span class="text-sm text-gray-700 mt-1">{{ $kerjasama->Mitra->User->alamat }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">No. Telp</span>
                                <span class="text-sm text-gray-700 mt-1">{{ $kerjasama->Mitra->User->no_tlp }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Jabatan
                                    Penanggung Jawab</span>
                                <span
                                    class="text-sm font-medium text-gray-700 mt-1">{{ $kerjasama->Mitra->jabatan_penanggung_jawab }}</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status</span>
                                <div class="mt-1">
                                    @if ($kerjasama->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Menunggu
                                        </span>
                                    @elseif ($kerjasama->status === 'approved')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Diterima
                                        </span>
                                    @elseif ($kerjasama->status === 'rejected')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Ditolak
                                        </span>
                                    @elseif ($kerjasama->status === 'expired')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        @if ($kerjasama->alasan)
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Alasan</span>
                            <p class="text-sm text-gray-700 my-2 leading-relaxed">
                                {{ $kerjasama->alasan }}</p>
                        @endif
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Keterangan</span>
                        <p class="text-sm text-gray-700 my-2 leading-relaxed">
                            {{ $kerjasama->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>
                    </div>
                </div>

                <!-- Lampiran File -->
                <div class="bg-amber-50 rounded-lg p-6 border border-amber-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                            </path>
                        </svg>
                        Lampiran File
                    </h3>

                    <div class="space-y-2">
                        @forelse ($kerjasama->FilePenunjang as $lampiran)
                            <div
                                class="flex items-center p-3 bg-white rounded-lg border border-blue-200 hover:border-blue-300 transition-colors duration-200">
                                <svg class="w-4 h-4 text-blue-600 mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <a href="{{ route('kerja-sama.file.show', $lampiran->id_file_penunjang) }}" target="_blank"
                                    class="text-sm text-blue-700 hover:text-blue-800 hover:underline font-medium flex-grow">
                                    {{ $lampiran->nama_file }}
                                </a>
                                <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </div>
                        @empty
                            <div class="flex items-center justify-center p-8 text-gray-500">
                                <svg class="w-8 h-8 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-sm">Tidak ada file lampiran.</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                @if ($kerjasama->status === 'pending')
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Alasan / Catatan Donasi</h3>
                        <textarea id="alasan-text" rows="4"
                            class="w-full px-3 py-2 mb-3 text-gray-700 border rounded-lg focus:outline-none" placeholder="Masukkan alasan..."></textarea>
                        <p class="text-xs text-gray-500">jika tidak ada alasan bisa ketik 'Tidak Ada'</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.kerjaSama') }}"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>

                    @if ($kerjasama->status === 'approved')
                        <form action="{{ route('download.zip', [$kerjasama->id_kerja_sama, $kerjasama->Mitra->User->nama]) }}"
                            method="GET">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2
                             rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M18.08 15.106q.222 0 .356-.115a.4.4 0 0 0 .139-.314a.4.4 0 0 0-.14-.32a.5.5 0 0 0-.356-.122h-.508q-.03 0-.03.03v.81q0 .03.03.03z" />
                                    <path fill="currentColor"
                                        d="M17.25 22a2.25 2.25 0 0 0 2.25-2.25v-.744h1a1.5 1.5 0 0 0 1.5-1.5V13.25a1.5 1.5 0 0 0-1.5-1.5h-10a1.5 1.5 0 0 0-1.5 1.5v4.256a1.5 1.5 0 0 0 1.5 1.5H18v.744a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75v-10h4a2.25 2.25 0 0 0 2.25-2.252L12.249 3.5h5.002a.75.75 0 0 1 .75.75v7.488h1.5V4.25A2.25 2.25 0 0 0 17.25 2h-5.132a2.25 2.25 0 0 0-1.592.66L5.16 8.03a2.25 2.25 0 0 0-.66 1.592V19.75A2.25 2.25 0 0 0 6.75 22zM10.749 4.559l.002 2.94a.75.75 0 0 1-.75.751H7.06zm7.518 8.703q.43 0 .755.175q.327.17.502.49q.182.315.182.725q0 .405-.188.714a1.26 1.26 0 0 1-.526.478q-.339.168-.78.169h-.64q-.03 0-.031.03v1.36a.1.1 0 0 1-.024.067a.1.1 0 0 1-.067.024h-.955a.1.1 0 0 1-.067-.024a.1.1 0 0 1-.024-.066v-4.052a.1.1 0 0 1 .024-.066a.1.1 0 0 1 .067-.024zM14.84 17.47a.1.1 0 0 1-.025-.066v-4.052a.1.1 0 0 1 .024-.066a.1.1 0 0 1 .067-.024h.955a.1.1 0 0 1 .067.024a.1.1 0 0 1 .024.066v4.052a.1.1 0 0 1-.024.066a.1.1 0 0 1-.067.024h-.955a.1.1 0 0 1-.066-.024m-3.42.024a.1.1 0 0 1-.067-.024a.1.1 0 0 1-.024-.066v-.877a.16.16 0 0 1 .042-.109l1.76-2.146q.012-.013.006-.025t-.024-.012H11.42a.1.1 0 0 1-.067-.024a.1.1 0 0 1-.024-.066v-.793a.1.1 0 0 1 .024-.066a.1.1 0 0 1 .067-.024h2.908a.1.1 0 0 1 .067.024a.1.1 0 0 1 .024.066v.871a.16.16 0 0 1-.043.115l-1.771 2.147q-.012.012-.006.024t.024.012h1.705a.1.1 0 0 1 .067.024a.1.1 0 0 1 .024.066v.793a.1.1 0 0 1-.024.066a.1.1 0 0 1-.067.024z" />
                                </svg> Download Zip
                            </button>
                        </form>
                    @endif

                    @if ($kerjasama->status === 'pending')
                        <div class="flex flex-col sm:flex-row gap-3 sm:ml-auto">
                            <form action="{{ route('kerjaSama.approved', $kerjasama->id_kerja_sama) }}"
                                method="POST" class="alasan-form">
                                @csrf
                                <input type="hidden" name="alasan" class="hidden-alasan">
                                <button type="submit" onclick="submitWithAlasan(this)"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Terima
                                </button>
                            </form>

                            <form action="{{ route('kerjaSama.rejected', $kerjasama->id_kerja_sama) }}"
                                method="POST" class="alasan-form">
                                @csrf
                                <input type="hidden" name="alasan" class="hidden-alasan">
                                <button type="submit" onclick="submitWithAlasan(this)"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
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
    <!-- Scripts -->
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
