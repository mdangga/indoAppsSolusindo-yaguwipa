@php
    $totalDonatur = count($donations);

    $today = new DateTime();
    $endDate = new DateTime($campaign->tanggal_selesai);

    $interval = $today->diff($endDate);
@endphp

@extends('layouts.main')

@section('title', "{$campaign->nama} - Detail Campaign")

@push('styles')
    {{-- custom style --}}
    @vite('resources/css/detail-campaign.css')

    {{-- AOS css --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
@endpush

@section('content')
    <main class="bg-gray-50 text-gray-800">
        <!-- Hero Section -->
        <section class="bg-white pt-20 pb-12">
            <div class="relative flex items-center justify-center h-screen max-w-6xl mx-auto px-4">
                <!-- Campaign Header -->
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 lg:p-12 shadow-sm border border-gray-100"
                    data-aos="fade-up">

                    <div class="flex items-center space-x-4 mb-6">
                        <a href="{{ auth()->check() && auth()->user()->role !== 'admin' ? route('dashboard') : route('beranda.program') }}"
                            class="text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="fas fa-arrow-left text-lg"></i>
                        </a>
                        <h1 class="text-lg font-semibold text-gray-900">Detail Campaign</h1>
                    </div>



                    <!-- Title & Description -->
                    <div class="grid lg:grid-cols-2 gap-12 items-start">
                        <div>
                            <div>
                                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                    {{ $campaign->nama }}
                                </h1>
                                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                    {{ $campaign->deskripsi }}
                                </p>
                            </div>

                            <!-- Badges Row -->
                            <div class="flex flex-wrap items-center gap-3 mb-6">
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-circle text-green-500 text-xs mr-2"></i>Campaign Aktif
                                </span>
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    {{ $campaign->Program->KategoriProgram->nama }}
                                </span>
                            </div>
                        </div>
                        <!-- Campaign Stats -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200">
                            <!-- Progress Section -->
                            @php
                                // Hitung total dana terkumpul dari donasi_dana yang status_verifikasi 'approved'
                                $terkumpul = $campaign->donasi
                                    ->filter(
                                        fn($d) => $d->donasiDana && $d->donasiDana->status_verifikasi === 'approved',
                                    )
                                    ->sum(fn($d) => $d->donasiDana->nominal);

                                // Hitung persentase progres
                                $persentase =
                                    $campaign->target_dana && $campaign->target_dana > 0
                                        ? min(100, round(($terkumpul / $campaign->target_dana) * 100))
                                        : 0;
                            @endphp
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Progress Campaign</h3>
                                    <span class="text-2xl font-bold text-green-600">{{ $persentase }}%</span>
                                </div>

                                <div class="bg-gray-200 rounded-full h-4 mb-4 overflow-hidden">
                                    <div class="progress-bar h-full rounded-full" style="width: {{ $persentase }}%"></div>
                                </div>

                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900 mb-1">Rp
                                            {{ number_format($terkumpul, 0, ',', '.') }}</div>
                                        <div class="text-sm text-gray-600">Terkumpul</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900 mb-1">
                                            @if ($campaign->target_dana)
                                                Rp {{ number_format($campaign->target_dana, 0, ',', '.') }}
                                            @else
                                                Tidak Ditentukan
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">Target</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Stats -->
                            <div class="grid grid-cols-2 gap-4 mb-8 p-4 bg-gray-50 rounded-xl">
                                <div class="text-center">
                                    <div class="text-xl font-bold text-amber-600">{{ $totalDonatur }}</div>
                                    <div class="text-xs text-gray-600">Donatur</div>
                                </div>
                                <div class="text-center">
                                    @if ($interval->invert)
                                        <div class="text-xl font-bold text-blue-600">{{ $interval->days }}</div>
                                        <div class="text-xs text-gray-600">Hari yang lalu</div>
                                    @else
                                        <div class="text-xl font-bold text-blue-600">{{ $interval->days }}</div>
                                        <div class="text-xs text-gray-600">Hari Tersisa</div>
                                    @endif
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <a type="button" aria-label="Donasi Sekarang"
                                href="{{ route('form.donasi', $campaign->id_campaign) }}"
                                class="flex items-center justify-center gap-2 w-full bg-amber-600 hover:bg-amber-700 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M20 17q.86 0 1.45.6t.58 1.4L14 22l-7-2v-9h1.95l7.27 2.69q.78.31.78 1.12q0 .47-.34.82t-.86.37H13l-1.75-.67l-.33.94L13 17zM16 3.23Q17.06 2 18.7 2q1.36 0 2.3 1t1 2.3q0 1.03-1 2.46t-1.97 2.39T16 13q-2.08-1.89-3.06-2.85t-1.97-2.39T10 5.3q0-1.36.97-2.3t2.34-1q1.6 0 2.69 1.23M.984 11H5v11H.984z" />
                                </svg>
                                Donasi Sekarang
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Daftar Donatur -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100" data-aos="fade-up">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Donatur Terbaru</h2>
                            <span class="text-sm text-gray-500">{{ $totalDonatur }} orang telah berdonasi</span>
                        </div>

                        <div class="space-y-4 max-h-96 overflow-y-auto">
                            @forelse ($donations as $donation)
                                <div
                                    class="donor-card p-4 rounded-xl card-hover {{ $loop->first ? 'border-2 border-amber-300' : '' }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-amber-500 to-amber-800 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                                {{ strtoupper(substr($donation->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">
                                                    {{ $donation->anonim ? 'Orang Baik' : $donation->nama }}
                                                </h4>
                                                <p class="text-sm text-gray-600">
                                                    {{ $donation->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            @if (strtolower($donation->JenisDonasi->nama) == 'dana')
                                                <p class="font-bold text-amber-600">
                                                    Rp
                                                    {{ number_format(optional($donation->DonasiDana)->nominal, 0, ',', '.') }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $donation->pesan ?? 'Tanpa pesan' }}
                                                </p>
                                            @elseif (strtolower($donation->JenisDonasi->nama) == 'barang')
                                                @php
                                                    $barang = $donation->DonasiBarang;
                                                    $totalBarang = $barang->count();
                                                @endphp

                                                @foreach ($barang->take(2) as $item)
                                                    <div class="font-bold text-amber-600">
                                                        {{ $item->nama_barang }} ({{ $item->jumlah_barang }} unit)
                                                    </div>
                                                    <div class="text-gray-600 text-sm mb-2">
                                                        Kondisi: {{ $item->kondisi }}
                                                    </div>
                                                @endforeach

                                                @if ($totalBarang > 2)
                                                    <div class="text-gray-600 text-sm">
                                                        dan {{ $totalBarang - 2 }} barang lainnya
                                                    </div>
                                                @endif
                                                <p class="text-xs text-gray-500">
                                                    {{ $donation->pesan ?? 'Tanpa pesan' }}
                                                </p>
                                            @elseif (strtolower($donation->JenisDonasi->nama) == 'jasa')
                                                <!-- Jasa -->
                                                <div class="font-bold text-amber-600">
                                                    {{ $donation->DonasiJasa->jenis_jasa }}
                                                    ({{ $donation->DonasiJasa->durasi_jasa }})
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    {{ $donation->pesan ?? 'Tanpa pesan' }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center">Belum ada donasi.</p>
                            @endforelse
                        </div>
                        <div class="mt-6 text-center">
                            <button class="text-amber-600 hover:text-amber-800 font-medium transition-colors">
                                Lihat Semua Donatur <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>

                    </div>

                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6">

                    <!-- Statistik -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100" data-aos="fade-left"
                        data-aos-delay="100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Campaign</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Hari tersisa</span>
                                <span class="font-semibold text-amber-600">{{ $interval->days }} hari</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Campaign dimulai</span>
                                <span
                                    class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($campaign->tanggal_mulai)->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Lokasi</span>
                                <span class="font-semibold text-gray-900">{{ $campaign->lokasi }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    {{-- AOS js --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    @vite('resources/js/AOS.js')
    <script>
        // Donation button functionality
        document.querySelectorAll('.donate-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showDonationModal();
            });
        });


        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush
