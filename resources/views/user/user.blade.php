<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
@php
    $user = auth()->user();

    $review = $user->Review;

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

    $emptyReview = !$review;
    $isEditReview = request()->query('edit') === '1';
@endphp


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    @vite(['resources/css/app.css', 'resources/js/AOS.js', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>

</head>

<body>
    <x-user.navbar-user :user="$user" :randomBg="$randomBg" :profilePath="$profilePath" />
    @if (session('success'))
        <x-toast type="success" message="{{ session('success') }}" position="top-right" duration="3000" />
    @endif
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Mobile Quick Actions - Only visible on mobile -->
            <div class="lg:hidden mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex justify-around items-center">
                        <a href="{{ route('beranda') }}"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Beranda</span>
                        </a>

                        <a href="{{ route('user.activity') }}"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M15.25 5q-.525 0-.888-.363T14 3.75t.363-.888t.887-.362t.888.363t.362.887t-.363.888T15.25 5m0 16.5q-.525 0-.888-.363T14 20.25t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362m4-13q-.525 0-.888-.363T18 7.25t.363-.888T19.25 6t.888.363t.362.887t-.363.888t-.887.362m0 9.5q-.525 0-.888-.363T18 16.75t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362m1.5-4.75q-.525 0-.888-.363T19.5 12t.363-.888t.887-.362t.888.363T22 12t-.363.888t-.887.362M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2v2Q8.65 4 6.325 6.325T4 12t2.325 5.675T12 20zm3.3-5.3L11 12.4V7h2v4.6l3.7 3.7z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Recent Activity</span>
                        </a>

                        <a href="{{ $user->role === 'mitra' ? route('kerja-sama.formStore') : route('mitra.join') }}"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Kolaborasi</span>
                        </a>

                        <a href="{{ route('daftar.donasi') }}"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M16 12c2.76 0 5-2.24 5-5s-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5m5.45 5.6c-.39-.4-.88-.6-1.45-.6h-7l-2.08-.73l.33-.94L13 16h2.8c.35 0 .63-.14.86-.37s.34-.51.34-.82c0-.54-.26-.91-.78-1.12L8.95 11H7v9l7 2l8.03-3c.01-.53-.19-1-.58-1.4M5 11H.984v11H5z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Donasi</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Recent Activity --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                                <a href="{{ route('user.activity') }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
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
                                                    <span class="text-xs text-gray-500 mb-2">
                                                        {{ $activity->updated_at->format('d M Y H:i') }}
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
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Individual Review -->
                    @if ($emptyReview || $isEditReview)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tulis Ulasan</h3>
                            <form
                                action="{{ $isEditReview ? route('review.update', $review->id_review) : route('review.store') }}"
                                method="POST">
                                @csrf
                                @if ($isEditReview)
                                    @method('PUT')
                                @endif

                                <!-- Rating Input dengan Bintang -->
                                <div class="mb-4" x-data="{ rating: {{ old('rating', $review->rating ?? 0) }} }">
                                    <label for="rating"
                                        class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button" @click="rating = {{ $i }}"
                                                @keydown.enter.prevent="rating = {{ $i }}"
                                                :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"
                                                class="text-2xl focus:outline-none transition">
                                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" :value="rating">
                                    @error('rating')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>


                                <!-- Review Textarea -->
                                <div class="mb-4">
                                    <label for="review"
                                        class="block text-sm font-medium text-gray-700 mb-1">Ulasan</label>
                                    <textarea id="review" name="review" rows="4"
                                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 p-3"
                                        placeholder="Tulis ulasanmu di sini..." required>{{ old('review', $review->review ?? '') }}</textarea>
                                    @error('review')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('dashboard') }}"
                                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            Batal
                                        </a>
                                        <button type="submit"
                                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                            {{ $isEditReview ? 'Update Ulasan' : 'Kirim Ulasan' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <div class="flex items-start space-x-4">
                                <!-- Avatar -->
                                @if ($profilePath)
                                    <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-300" />
                                @else
                                    <span
                                        class="w-10 h-10 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 text-lg">
                                        {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                                    </span>
                                @endif


                                <!-- Review Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header with name, date, and actions -->
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="font-medium text-gray-900">{{ $user->nama }}</span>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ url()->current() }}?edit=1" title="Edit Review"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('review.delete', $review->id_review) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" title="Hapus Review"
                                                            class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div class="flex space-x-0.5">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <svg class="w-4 h-4 text-yellow-400 fill-current"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4 text-gray-300 fill-current"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review Text -->
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        {{ $review->review }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Desktop Sidebar - Profile & Quick Actions -->
                <div class="md:space-y-6 lg:block">
                    <!-- Desktop Quick Actions - Hidden on mobile -->
                    <div class="hidden lg:block bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('beranda') }}"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Beranda</span>
                            </a>

                            <a href="{{ route('user.activity') }}"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-600"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M15.25 5q-.525 0-.888-.363T14 3.75t.363-.888t.887-.362t.888.363t.362.887t-.363.888T15.25 5m0 16.5q-.525 0-.888-.363T14 20.25t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362m4-13q-.525 0-.888-.363T18 7.25t.363-.888T19.25 6t.888.363t.362.887t-.363.888t-.887.362m0 9.5q-.525 0-.888-.363T18 16.75t.363-.888t.887-.362t.888.363t.362.887t-.363.888t-.887.362m1.5-4.75q-.525 0-.888-.363T19.5 12t.363-.888t.887-.362t.888.363T22 12t-.363.888t-.887.362M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2v2Q8.65 4 6.325 6.325T4 12t2.325 5.675T12 20zm3.3-5.3L11 12.4V7h2v4.6l3.7 3.7z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Recent Activity</span>
                            </a>

                            <a href="{{ $user->role === 'mitra' ? route('kerja-sama.formStore') : route('mitra.join') }}"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600"
                                        viewBox="0 0 640 512">
                                        <path fill="currentColor"
                                            d="m323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5L373 188.8l139 128V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2m22.8 124.4l-51.7 40.2c-31.5 24.6-77.2 18.2-100.8-14.2c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48v224h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8zM16 128c-8.8 0-16 7.2-16 16v208c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V128zm32 192a16 16 0 1 1 0 32a16 16 0 1 1 0-32m496-192v224c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16zm32 208a16 16 0 1 1 32 0a16 16 0 1 1-32 0" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Kolaborasi</span>
                            </a>

                            <a href="{{ route('daftar.donasi') }}"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M16 12c2.76 0 5-2.24 5-5s-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5m5.45 5.6c-.39-.4-.88-.6-1.45-.6h-7l-2.08-.73l.33-.94L13 16h2.8c.35 0 .63-.14.86-.37s.34-.51.34-.82c0-.54-.26-.91-.78-1.12L8.95 11H7v9l7 2l8.03-3c.01-.53-.19-1-.58-1.4M5 11H.984v11H5z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Donasi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
