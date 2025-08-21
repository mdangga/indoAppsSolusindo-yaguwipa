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
    $hoverBg = $colorMap[$randomBg];

    $profilePath = optional($user)->profile_path;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Aktivitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <x-user.header-user :user="$user" :randomBg="$randomBg" :profilePath="$profilePath" :title="'Semua Aktivitas'" :description="'Semua aktivitas terbaru yang telah Anda lakukan, baik donasi maupun kerja sama.'" />

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Filter Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Aktivitas Saya</h1>
            <div class="mt-4 md:mt-0">
                <div class="relative">
                    <select id="filter-status"
                        class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activities List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="divide-y divide-gray-200">
                @forelse ($recentActivities as $activity)
                    @if ($activity instanceof \App\Models\KerjaSama)
                        <!-- Kerja Sama Item -->
                        <a href="{{ route('kerja-sama.detail', $activity->id_kerja_sama) }}"
                            class="block hover:bg-gray-50 transition-colors duration-150">
                            <div class="px-6 py-4">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-handshake text-blue-600 text-xl"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">
                                                {{ $activity->kategoriKerjaSama->nama ?? 'Kerja Sama' }}
                                            </h4>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ Str::limit($activity->keterangan, 100) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-xs text-gray-500 mb-2">
                                            {{ $activity->updated_at->format('d M Y H:i') }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                            @switch($activity->status)
                                                @case('approved') bg-green-100 text-green-800 @break
                                                @case('rejected') bg-red-100 text-red-800 @break
                                                @case('pending') bg-yellow-100 text-yellow-800 @break
                                                @default bg-gray-100 text-gray-800
                                            @endswitch">
                                            {{ str_replace('_', ' ', ucfirst($activity->status ?? '-')) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @elseif ($activity instanceof \App\Models\Donasi)
                        <!-- Donasi Item -->
                        <a href="{{ route('user-donasi.detail', $activity->id_donasi) }}"
                            class="block hover:bg-gray-50 transition-colors duration-150">
                            <div class="px-6 py-4">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-gift text-green-600 text-xl"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">
                                                {{ $activity->Campaign->nama ?? 'Donasi' }}
                                            </h4>
                                            <p class="text-sm text-gray-500 mt-1">
                                                @if (!empty($activity->DonasiDana) && $activity->DonasiDana->count())
                                                    Dana:
                                                    Rp{{ number_format(optional($activity->DonasiDana->first())->nominal ?? 0, 0, ',', '.') }}
                                                @elseif(!empty($activity->DonasiBarang) && $activity->DonasiBarang->count())
                                                    Barang:
                                                    @foreach ($activity->DonasiBarang as $barang)
                                                        {{ $barang->nama_barang ?? '-' }}
                                                        ({{ $barang->jumlah_barang ?? '0' }})
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                @elseif(!empty($activity->DonasiJasa) && $activity->DonasiJasa->count())
                                                    Jasa: {{ $activity->DonasiJasa->jenis_jasa ?? '-' }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-xs text-gray-500 mb-2" id="updateAt" data-utc="{{ $activity->updated_at }}">
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        @switch($activity->status_verifikasi ?? $activity->status)
                                            @case('approved') bg-green-100 text-green-800 @break
                                            @case('rejected') bg-red-100 text-red-800 @break
                                            @case('pending') bg-yellow-100 text-yellow-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch">
                                            {{ str_replace('_', ' ', ucfirst($activity->status_verifikasi ?? ($activity->status ?? '-'))) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada aktivitas</p>
                        <a href="{{ url()->previous() }}"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                            Kembali ke Beranda
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        @if ($recentActivities->hasPages())
            <div class="flex justify-center items-center space-x-2 mt-6">
                {{-- Previous Button --}}
                @if ($recentActivities->onFirstPage())
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                        ← Previous
                    </span>
                @else
                    <a href="{{ $recentActivities->previousPageUrl() }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                        ← Previous
                    </a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex space-x-1">
                    @php
                        $current = $recentActivities->currentPage();
                        $last = $recentActivities->lastPage();
                        $start = max($current - 2, 1);
                        $end = min($current + 2, $last);
                    @endphp

                    {{-- First page & ellipsis --}}
                    @if ($start > 1)
                        <a href="{{ $recentActivities->url(1) }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                            1
                        </a>
                        @if ($start > 2)
                            <span class="px-3 py-2 text-sm text-gray-400">...</span>
                        @endif
                    @endif

                    {{-- Range pages --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $current)
                            <span
                                class="px-3 py-2 text-sm font-medium text-white bg-amber-400 border border-amber-500/50 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $recentActivities->url($page) }}"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last page & ellipsis --}}
                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <span class="px-3 py-2 text-sm text-gray-400">...</span>
                        @endif
                        <a href="{{ $recentActivities->url($last) }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                            {{ $last }}
                        </a>
                    @endif
                </div>

                {{-- Next Button --}}
                @if ($recentActivities->hasMorePages())
                    <a href="{{ $recentActivities->nextPageUrl() }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                        Next →
                    </a>
                @else
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                        Next →
                    </span>
                @endif
            </div>
        @endif
    </div>

    <script>
        function convertUTCToLocal(utcTimeString) {
            const utcDate = new Date(utcTimeString + (utcTimeString.includes('UTC') ? '' : ' UTC'));
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };

            const formatter = new Intl.DateTimeFormat('us-US', options);
            const formattedDate = formatter.format(utcDate);
            const timezoneName = Intl.DateTimeFormat().resolvedOptions().timeZone;

            // tambahkan ini  (${timezoneName}) jika ingin menambahkan timezone
            return `${formattedDate}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const updateAtElements = document.querySelectorAll('#updateAt');
            updateAtElements.forEach(function(element) {
                const updateAtUTC = element.getAttribute('data-utc');
                if (updateAtUTC) {
                    element.textContent = convertUTCToLocal(updateAtUTC);
                }
            });
        });

        document.getElementById('filter-status').addEventListener('change', function() {
            const status = this.value;
            window.location.href = "{{ route('user.activity') }}" + (status ? `?status=${status}` : '');
        });
    </script>
</body>

</html>
