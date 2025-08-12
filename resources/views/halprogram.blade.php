<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $program->name }} - Program Yayasan</title>

    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- navbar --}}
    <x-navbar :menus="$menus ?? []" />

    {{-- Konten Utama --}}
    <main class="max-w-4xl mx-auto px-4 pt-32 pb-10">
        <article class="bg-white rounded-xl shadow-md p-8">
            {{-- Judul --}}
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $program->nama }}</h1>

            {{-- Gambar --}}
            @if ($program->image_path)
                <img src="{{ asset('storage/' . $program->image_path) }}" alt="{{ $program->nama }}"
                    class="w-full h-64 object-cover rounded-lg shadow mb-4">
            @endif

            {{-- Status dan Kategori --}}
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="inline-block px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
                    {{ $program->KategoriProgram->nama ?? 'Tanpa Kategori' }}
                </span>
                <span
                    class="inline-block px-3 py-1 text-sm rounded-full
           {{ $program->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $program->status }}
                </span>
            </div>

            {{-- Deskripsi --}}
            <div class="prose max-w-none text-justify mb-6">
                <p>{{ $program->deskripsi }}</p>
            </div>

            {{-- Pihak yang Terlibat --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Pihak yang Terlibat:</h2>
                <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
                    @forelse($program->institusiTerlibat as $institusi)
                        <li>
                            {{ $institusi->nama }}
                            <span class="text-xs text-gray-400">
                                ({{ \Carbon\Carbon::parse($institusi->joined_at)->translatedFormat('d M Y') }})
                            </span>
                        </li>
                    @empty
                        <li class="text-gray-400 italic">Belum ada institusi terlibat.</li>
                    @endforelse
                </ul>
            </div>
        </article>

        {{-- Bagian Campaign Donasi --}}
        <section class="mt-8" data-aos="fade-up">
            {{-- List Campaign Donasi --}}
            <div class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Daftar Campaign Donasi</h2>

                @forelse ($campaigns as $item)
                    <div class="border-b border-gray-200 pb-6 mb-6" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ route('campaign.slug', $item->slug) }}" class="flex flex-col md:flex-row gap-6">
                            {{-- Foto Campaign --}}
                            <div class="md:w-64 md:flex-shrink-0">
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->nama }}"
                                    class="w-full h-48 md:h-40 object-cover rounded-lg shadow-sm">
                            </div>

                            {{-- Detail Campaign --}}
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ $item->nama }}
                                </h3>

                                {{-- Progress Bar --}}
                                @php
                                    // Hitung total dana terkumpul dari donasi_dana yang status_verifikasi 'approved'
                                    $terkumpul = $item->donasi
                                        ->filter(
                                            fn($d) => $d->donasiDana &&
                                                $d->donasiDana->status_verifikasi === 'approved',
                                        )
                                        ->sum(fn($d) => $d->donasiDana->nominal);

                                    // Hitung persentase progres
                                    $persentase =
                                        $item->target_dana && $item->target_dana > 0
                                            ? min(100, round(($terkumpul / $item->target_dana) * 100))
                                            : 0;
                                @endphp

                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Terkumpul</span>
                                        <span>{{ $persentase }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full" style="width: {{ $persentase }}%">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Terkumpul</p>
                                        <p class="text-lg font-bold text-green-600">Rp
                                            {{ number_format($terkumpul, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Target</p>
                                        <p class="text-lg font-bold text-gray-900">
                                            @if ($item->target_dana)
                                                Rp {{ number_format($item->target_dana, 0, ',', '.') }}
                                            @else
                                                Tidak Ditentukan
                                            @endif
                                        </p>
                                    </div>
                                </div>


                                {{-- Status Campaign --}}
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-block px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                        {{ $item->status }}
                                    </span>
                                    {{-- <span class="text-sm text-gray-500">• 156 donatur</span> --}}
                                </div>
                            </div>
                          </a>
                    </div>
                @empty
                @endforelse
            </div>
        </section>
    </main>

    {{-- footer --}}
    <x-footer />

    <script>
        AOS.init();
    </script>
</body>

</html>
