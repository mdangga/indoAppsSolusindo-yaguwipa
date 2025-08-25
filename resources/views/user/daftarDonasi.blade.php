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
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Donasi</title>
    @vite(['resources/css/app.css', 'resources/js/AOS.js', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <x-user.header-user :user="$user" :randomBg="$randomBg" :profilePath="$profilePath" :title="'Salurkan Donasi Anda'" :description="'Pilih program donasi yang ingin Anda dukung. Setiap
                                                                                                                                                                                                                                                                        kontribusi Anda akan memberikan dampak positif.'" />
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Kategori Donasi -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Kategori Donasi</h2>
                <form method="GET" class="flex flex-wrap gap-3">
                    <button type="submit" name="kategori_id" value=""
                        class="px-4 py-2 {{ empty($kategori_id) ? 'bg-amber-500 text-white' : 'bg-white border border-gray-300 text-gray-900' }} rounded-full hover:text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 transition-all">
                        Semua Program
                    </button>
                    @foreach ($kategoris as $kategori)
                        <button type="submit" name="kategori_id" value="{{ $kategori->id_kategori_program }}"
                            class="px-4 py-2 {{ $kategori_id == $kategori->id_kategori_program ? 'bg-amber-500 text-white' : 'bg-white border border-gray-300 text-gray-900' }} rounded-full hover:text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 transition-all">
                            {{ $kategori->nama }}
                        </button>
                    @endforeach
                </form>
            </div>

            <!-- Daftar Program Donasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ($campaigns as $campaign)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col md:flex-row">

                        <!-- Gambar di kiri -->
                        <div class="relative md:w-1/3">
                            <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="Program Donasi"
                                class="w-full h-48 md:h-full object-cover">

                        </div>

                        <!-- Detail di kanan -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="mb-2">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $campaign->nama }}</h3>
                                    <div class="space-x-1">
                                        <span class="bg-amber-100 text-amber-800 text-xs px-3 py-1 rounded-full">
                                            {{ $campaign->Program->KategoriProgram->nama ?? '-' }}
                                        </span>
                                        <span
                                            class=" 
                                        {{ $campaign->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }} 
                                        text-xs px-2 py-1 rounded-full">
                                            {{ ucfirst($campaign->status) }}
                                        </span>
                                    </div>
                                </div>

                                <p class="text-gray-600 mb-4">
                                    {{ \Illuminate\Support\Str::words($campaign->deskripsi, 26, '...') }}
                                </p>


                                @php
                                    $terkumpul = $campaign->donasi
                                        ->filter(
                                            fn($d) => $d->donasiDana && $d->donasiDana->status_verifikasi === 'PAID',
                                        )
                                        ->sum(fn($d) => $d->donasiDana->nominal);
                                    $percent =
                                        $campaign->target_dana > 0
                                            ? min(100, round(($terkumpul / $campaign->target_dana) * 100))
                                            : 0;
                                @endphp

                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                                        <span>Terkumpul</span>
                                        <span>Rp {{ number_format($terkumpul, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $percent }}%">
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-500 mt-1">
                                        <span>Target Rp {{ number_format($campaign->target_dana, 0, ',', '.') }}</span>
                                        <span>{{ $percent }}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-gray-500">hari tersisa</p>
                                    @php
                                        $endDate = \Carbon\Carbon::parse($campaign->tanggal_selesai);
                                        $daysLeft = $endDate->isFuture() ? $today->diff($endDate)->days : 0;
                                    @endphp
                                    <p class="font-medium">{{ $daysLeft }} hari</p>
                                </div>
                                <a href="{{ route('form.donasi', $campaign->id_campaign) }}"
                                    class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg hover:scale-105 active:scale-95 active:bg-amber-700 text-sm font-medium transition-all duration-300">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</body>

</html>
