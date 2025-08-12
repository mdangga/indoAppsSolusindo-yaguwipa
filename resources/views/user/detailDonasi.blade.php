@php
    $today = new DateTime();
    $user = auth()->user();

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

    $profilePath = optional($user)->profile_path;

    $status = $donasi->status ?? 'pending';

    $steps = [
        [
            'title' => 'Pengajuan Dikirim',
            'date' => $donasi->created_at
                ? 'Diajukan pada ' . $donasi->created_at->format('d M Y H:i')
                : 'Belum ada tanggal',
        ],
        [
            'title' => 'Pengecekan',
            'date' => $donasi->status === 'pending' ? 'Sedang diproses' : 'Review selesai',
        ],
        [
            'title' => 'Hasil Pengecekan',
            'date' =>
                $donasi->status === 'pending'
                    ? 'Menunggu Keputusan'
                    : 'Disetujui pada ' . $donasi->updated_at->format('d M Y H:i'),
        ],
    ];

    function stepConfig($status, $index)
    {
        if ($status === 'approved') {
            return [
                'bg' => 'bg-green-100',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M21.192 5.465a1 1 0 0 1 0 1.414L9.95 18.122a1.1 1.1 0 0 1-1.556 0l-5.586-5.586a1 1 0 1 1 1.415-1.415l4.95 4.95L19.777 5.465a1 1 0 0 1 1.414 0Z"/></g></svg>',
            ];
        }

        if ($status === 'pending') {
            if ($index === 0) {
                return [
                    'bg' => 'bg-green-100',
                    'icon' =>
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M21.192 5.465a1 1 0 0 1 0 1.414L9.95 18.122a1.1 1.1 0 0 1-1.556 0l-5.586-5.586a1 1 0 1 1 1.415-1.415l4.95 4.95L19.777 5.465a1 1 0 0 1 1.414 0Z"/></g></svg>',
                ];
            }
            if ($index === 1) {
                return [
                    'bg' => 'bg-yellow-100',
                    'icon' =>
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"><path fill="currentColor" d="M15 16.69V13h1.5v2.82l2.44 1.41l-.75 1.3zM19.5 3.5L18 2l-1.5 1.5L15 2l-1.5 1.5L12 2l-1.5 1.5L9 2L7.5 3.5L6 2L4.5 3.5L3 2v20l1.5-1.5L6 22l1.5-1.5L9 22l1.58-1.58c.14.19.3.36.47.53A7.001 7.001 0 0 0 21 11.1V2zM11.1 11c-.6.57-1.07 1.25-1.43 2H6v-2zm-2.03 4c-.07.33-.07.66-.07 1s0 .67.07 1H6v-2zM18 9H6V7h12zm2.85 7c0 .64-.12 1.27-.35 1.86c-.26.58-.62 1.14-1.07 1.57c-.43.45-.99.81-1.57 1.07c-.59.23-1.22.35-1.86.35c-2.68 0-4.85-2.17-4.85-4.85c0-1.29.51-2.5 1.42-3.43c.93-.91 2.14-1.42 3.43-1.42c2.67 0 4.85 2.17 4.85 4.85"/></svg>',
                ];
            }
            return [
                'bg' => 'bg-gray-100',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0a9 9 0 0 1 18 0"/></svg>',
            ];
        }

        if (in_array($status, ['rejected', 'expired'])) {
            return [
                'bg' => 'bg-red-100',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="m12 13.414l5.657 5.657a1 1 0 0 0 1.414-1.414L13.414 12l5.657-5.657a1 1 0 0 0-1.414-1.414L12 10.586L6.343 4.929A1 1 0 0 0 4.93 6.343L10.586 12l-5.657 5.657a1 1 0 1 0 1.414 1.414z"/></g></svg>',
            ];
        }

        return [
            'bg' => 'bg-gray-100',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0a9 9 0 0 1 18 0"/></svg>',
        ];
    }
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Program Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <x-user.header-user :user="$user" :randomBg="$randomBg" :profilePath="$profilePath" :route="url()->previous()" :title="'Detail Donasi'"
            :description="'Detail lengkap pengajuan Donasi Anda dengan lembaga'" />

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 space-y-8">
                    <!-- Status Timeline - Pending State -->
                    <div class="border-b border-gray-200 pb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Progres Pengajuan Donasi</h3>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                            @foreach ($steps as $i => $step)
                                @php
                                    $conf = stepConfig($status, $i);
                                @endphp
                                <div class="flex-1 text-center">
                                    <div
                                        class="w-12 h-12 rounded-full {{ $conf['bg'] }} flex items-center justify-center mx-auto mb-2">
                                        {!! $conf['icon'] !!}
                                    </div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $step['title'] }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $step['date'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Informasi Donasi -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-gray-600 mr-2"></i>
                            Detail Donasi
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Jenis
                                        Donasi</span>
                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ $donasi->JenisDonasi->nama }}
                                    </p>
                                </div>

                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Tanggal
                                        Pengajuan</span>
                                    <p class="text-sm text-gray-700 mt-1">
                                        {{ $donasi->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>

                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">No
                                        Telepon</span>
                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ optional($donasi->User)->no_tlp ?? '-' }}
                                    </p>

                                </div>

                                <div>
                                    <span
                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Alamat</span>
                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ optional($donasi->User)->alamat ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <span
                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status</span>
                                    <div class="mt-1">
                                        @if ($donasi->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-2"></i> Menunggu Persetujuan
                                            </span>
                                        @elseif ($donasi->status === 'approved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-2"></i> Disetujui
                                            </span>
                                        @elseif ($donasi->status === 'rejected')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-2"></i> Ditolak
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if ($donasi->alasan)
                                    <div>
                                        <span
                                            class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Alasan</span>
                                        <p class="text-sm text-gray-700 mt-1">
                                            {{ $donasi->alasan }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pesan</span>
                            <p class="text-sm text-gray-700 mt-2 leading-relaxed whitespace-pre-line">
                                {{ $donasi->pesan ?? 'Tidak ada deskripsi tambahan.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Lampiran Dokumen -->
                    @if ($donasi->jenisDonasi->nama === 'Barang')
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
                                                    <span><strong>Kondisi:</strong>
                                                        {{ ucfirst($barang->kondisi) }}</span>
                                                    @if ($barang->status_verifikasi === 'approved')
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Summary -->
                            <div class="mt-6 text-sm text-gray-600">
                                <span>Total: {{ count($donasi->donasiBarang) }} item</span>
                            </div>
                        </div>
                    @elseif ($donasi->JenisDonasi->nama === 'Jasa')
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Donasi Jasa
                            </h3>
                            <div
                                class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 mb-1 uppercase">
                                            {{ $donasi->DonasiJasa->jenis_jasa }}</h4>

                                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                                            <span><strong>Durasi:</strong>
                                                {{ ucfirst($donasi->DonasiJasa->durasi_jasa) }}</span>
                                            @if ($donasi->DonasiJasa->status_verifikasi === 'approved')
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
                </div>
            </div>
        </div>
    </div>
</body>

</html>
