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

    $status = $kerjasama->status ?? 'pending';

    $steps = [
        [
            'title' => 'Pengajuan Dikirim',
            'date' => $kerjasama->created_at
                ? 'Diajukan pada ' . $kerjasama->created_at->format('d M Y H:i')
                : 'Belum ada tanggal',
        ],
        [
            'title' => 'Review',
            'date' => $kerjasama->status === 'pending' ? 'Sedang diproses' : 'Review selesai',
        ],
        [
            'title' => 'Hasil Review',
            'date' =>
                $kerjasama->status === 'pending'
                    ? 'Menunggu Keputusan'
                    : 'Disetujui pada ' . $kerjasama->updated_at->format('d M Y H:i'),
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
        <x-user.header-user :user="$user" :randomBg="$randomBg" :profilePath="$profilePath" :route="url()->previous()" :title="'Detail Kerja Sama'"
            :description="'Detail lengkap pengajuan kerja sama Anda dengan lembaga'" />

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 space-y-8">
                    <!-- Status Timeline - Pending State -->
                    <div class="border-b border-gray-200 pb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Progres Pengajuan Kerja Sama</h3>
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

                    <!-- Informasi Kerja Sama -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-gray-600 mr-2"></i>
                            Detail Kerja Sama
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Jenis Kerja
                                        Sama</span>
                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                        {{ $kerjasama->KategoriKerjaSama->nama }}
                                    </p>
                                </div>

                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Tanggal
                                        Pengajuan</span>
                                    <p class="text-sm text-gray-700 mt-1">
                                        {{ $kerjasama->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>

                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Durasi Kerja
                                        Sama</span>
                                    <p class="text-sm text-gray-700 mt-1">
                                        {{ $kerjasama->durasi }} bulan
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <span
                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status</span>
                                    <div class="mt-1">
                                        @if ($kerjasama->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-2"></i> Menunggu Persetujuan
                                            </span>
                                        @elseif ($kerjasama->status === 'approved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-2"></i> Disetujui
                                            </span>
                                        @elseif ($kerjasama->status === 'rejected')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-2"></i> Ditolak
                                            </span>
                                        @elseif ($kerjasama->status === 'expired')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-calendar-times mr-2"></i> Selesai
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if ($kerjasama->alasan)
                                    <div>
                                        <span
                                            class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Alasan</span>
                                        <p class="text-sm text-gray-700 mt-1">
                                            {{ $kerjasama->alasan }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Deskripsi Kerja
                                Sama</span>
                            <p class="text-sm text-gray-700 mt-2 leading-relaxed whitespace-pre-line">
                                {{ $kerjasama->keterangan ?? 'Tidak ada deskripsi tambahan.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Lampiran Dokumen -->
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-paperclip text-blue-600 mr-2"></i>
                            Dokumen Pendukung
                        </h3>

                        <div class="space-y-3">
                            @forelse ($kerjasama->FilePenunjang as $lampiran)
                                <div
                                    class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-200 hover:border-blue-300 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-alt text-blue-500 mr-3"></i>
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $lampiran->nama_file }}
                                        </span>
                                    </div>
                                    <a href="{{ route('kerja-sama.file.show', $lampiran->id_file_penunjang) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                        Lihat Dokumen
                                        <i class="fas fa-external-link-alt ml-2"></i>
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-folder-open text-3xl mb-3"></i>
                                    <p>Tidak ada dokumen pendukung</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                        @if ($kerjasama->status === 'pending')
                            <form action="{{ route('kerja-sama.destroy', $kerjasama->id_kerja_sama) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan pengajuan kerja sama ini?')">
                                    <i class="fas fa-times mr-2"></i> Batalkan Pengajuan
                                </button>
                            </form>
                        @endif
                        @if ($kerjasama->status === 'rejected' || $kerjasama->status === 'expired')
                            <form action="{{ route('kerja-sama.formEdit', $kerjasama->id_kerja_sama) }}"
                                method="GET">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                                        viewBox="0 0 24 24">
                                        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                            <path
                                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352z" />
                                            <path
                                                d="M19.846 4.318a2.2 2.2 0 0 0-.437-.692a2 2 0 0 0-.654-.463a1.92 1.92 0 0 0-1.544 0a2 2 0 0 0-.654.463l-.546.578l2.852 3.02l.546-.579a2.1 2.1 0 0 0 .437-.692a2.24 2.24 0 0 0 0-1.635M17.45 8.721L14.597 5.7L9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.5.5 0 0 0 .255-.145l4.778-5.06Z" />
                                        </g>
                                    </svg></i> Update Pengajuan
                                </button>
                            </form>
                        @endif
                        @if ($kerjasama->status === 'approved')
                            <form action="{{ route('download.zip', [$kerjasama->id_kerja_sama, $user->nama]) }}"
                                method="GET">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M18.08 15.106q.222 0 .356-.115a.4.4 0 0 0 .139-.314a.4.4 0 0 0-.14-.32a.5.5 0 0 0-.356-.122h-.508q-.03 0-.03.03v.81q0 .03.03.03z" />
                                        <path fill="currentColor"
                                            d="M17.25 22a2.25 2.25 0 0 0 2.25-2.25v-.744h1a1.5 1.5 0 0 0 1.5-1.5V13.25a1.5 1.5 0 0 0-1.5-1.5h-10a1.5 1.5 0 0 0-1.5 1.5v4.256a1.5 1.5 0 0 0 1.5 1.5H18v.744a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75v-10h4a2.25 2.25 0 0 0 2.25-2.252L12.249 3.5h5.002a.75.75 0 0 1 .75.75v7.488h1.5V4.25A2.25 2.25 0 0 0 17.25 2h-5.132a2.25 2.25 0 0 0-1.592.66L5.16 8.03a2.25 2.25 0 0 0-.66 1.592V19.75A2.25 2.25 0 0 0 6.75 22zM10.749 4.559l.002 2.94a.75.75 0 0 1-.75.751H7.06zm7.518 8.703q.43 0 .755.175q.327.17.502.49q.182.315.182.725q0 .405-.188.714a1.26 1.26 0 0 1-.526.478q-.339.168-.78.169h-.64q-.03 0-.031.03v1.36a.1.1 0 0 1-.024.067a.1.1 0 0 1-.067.024h-.955a.1.1 0 0 1-.067-.024a.1.1 0 0 1-.024-.066v-4.052a.1.1 0 0 1 .024-.066a.1.1 0 0 1 .067-.024zM14.84 17.47a.1.1 0 0 1-.025-.066v-4.052a.1.1 0 0 1 .024-.066a.1.1 0 0 1 .067-.024h.955a.1.1 0 0 1 .067.024a.1.1 0 0 1 .024.066v4.052a.1.1 0 0 1-.024.066a.1.1 0 0 1-.067.024h-.955a.1.1 0 0 1-.066-.024m-3.42.024a.1.1 0 0 1-.067-.024a.1.1 0 0 1-.024-.066v-.877a.16.16 0 0 1 .042-.109l1.76-2.146q.012-.013.006-.025t-.024-.012H11.42a.1.1 0 0 1-.067-.024a.1.1 0 0 1-.024-.066v-.793a.1.1 0 0 1 .024-.066a.1.1 0 0 1 .067-.024h2.908a.1.1 0 0 1 .067.024a.1.1 0 0 1 .024.066v.871a.16.16 0 0 1-.043.115l-1.771 2.147q-.012.012-.006.024t.024.012h1.705a.1.1 0 0 1 .067.024a.1.1 0 0 1 .024.066v.793a.1.1 0 0 1-.024.066a.1.1 0 0 1-.067.024z" />
                                    </svg></i> Download Zip
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
