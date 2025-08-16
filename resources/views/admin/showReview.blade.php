@extends('layouts.showAdmin')

@section('title', 'Admin - Review Users')
@section('header', 'Review Users')

@section('content')
    {{-- Search and Filter Form --}}
    <form action="{{ route('admin.review') }}" method="GET" class="bg-white mb-6 p-4 rounded-lg border border-gray-200">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 items-end">
            {{-- Search Input --}}
            <div class="lg:col-span-8">
                <div class="relative">
                    <input type="text" id="search" name="search" placeholder="Cari berdasarkan konten review..."
                        value="{{ request('search') }}"
                        class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-lg text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                    @if (request('search'))
                        <a href="{{ route('admin.review') }}" class="absolute right-0 top-0 h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 absolute right-2 top-[23%]"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M18.3 5.71a.996.996 0 0 0-1.41 0L12 10.59L7.11 5.7A.996.996 0 1 0 5.7 7.11L10.59 12L5.7 16.89a.996.996 0 1 0 1.41 1.41L12 13.41l4.89 4.89a.996.996 0 1 0 1.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="lg:col-span-4 flex gap-2">
                <button type="submit"
                    class="flex-1 bg-blue-600 text-white rounded-lg text-sm py-2
                       hover:bg-blue-700 transition-all duration-200 flex items-center justify-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                    Cari
                </button>

                @php
                    $filterAktif = request()->has('cek_kata') && request('cek_kata') == 1;
                @endphp

                <a href="{{ request()->fullUrlWithQuery(['cek_kata' => $filterAktif ? null : 1]) }}"
                    class="flex-1 px-3 py-2 {{ $filterAktif ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white rounded-lg text-sm transition-all duration-200 flex items-center justify-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                    {{ $filterAktif ? 'Matikan Filter' : 'Cek Kata Kotor' }}
                </a>
            </div>
        </div>

        {{-- Filter Info --}}
        @if (request('search') || request('cek_kata') || request('status'))
            <div class="mt-3 p-2 bg-blue-100 rounded-lg border border-blue-200 text-sm">
                <div class="flex items-center text-blue-800">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <span class="font-medium">Filter Aktif:</span>
                    @if (request('search'))
                        <span class="ml-2 px-2 py-0.5 bg-blue-200 rounded-full text-xs">
                            Pencarian: "{{ request('search') }}"
                        </span>
                    @endif
                    @if (request('cek_kata'))
                        <span class="ml-2 px-2 py-0.5 bg-red-200 text-red-800 rounded-full text-xs">
                            Highlight Kata Kotor
                        </span>
                    @endif
                    @if (request('status'))
                        <span
                            class="ml-2 px-2 py-0.5 {{ request('status') === 'approved' ? 'bg-green-200 text-green-800' : 'bg-amber-200 text-amber-800' }} rounded-full text-xs">
                            Filter by Status: "{{ request('status') }}"
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </form>


    {{-- Stats Section --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
            <div class="flex items-center">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Total Review</p>
                    <p class="text-lg font-bold text-gray-900">{{ $reviews->total() }}</p>
                </div>
            </div>
        </div>
        @php
            $approved = request()->has('status') && request('status') == 'approved';
            $pending = request()->has('status') && request('status') == 'pending';
        @endphp
        <a href="{{ request()->fullUrlWithQuery(['status' => $approved ? null : 'approved']) }}"
            class="bg-white p-4 rounded-lg shadow border border-gray-100 cursor-pointer hover:bg-gray-100 hover:border-green-200 transform active:scale-95 transition-all duration-200"
            title="Approved Reviews">
            <div class="flex items-center">
                <div class="bg-green-100 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Approved</p>
                    <p class="text-lg font-bold text-gray-900">{{ $reviews->where('status', 'show')->count() }}</p>
                </div>
            </div>
        </a>
        <a href="{{ request()->fullUrlWithQuery(['status' => $pending ? null : 'pending']) }}"
            class="bg-white p-4 rounded-lg shadow border border-gray-100 cursor-pointer hover:bg-gray-100 hover:border-amber-200 transform active:scale-95 transition-all duration-200"
            title="Pending Reviews">
            <div class="flex items-center">
                <div class="bg-amber-100 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-xs font-medium text-gray-600">Pending</p>
                    <p class="text-lg font-bold text-gray-900">{{ $reviews->where('status', 'hide')->count() }}</p>
                </div>
            </div>
        </a>

        @if (!(request('search') || request('cek_kata') || request('status')))
            <div class="bg-white p-4 rounded-lg shadow border border-gray-100">
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs font-medium text-gray-600">Avg Rating</p>
                        <p class="text-lg font-bold text-gray-900">{{ number_format($reviews->avg('rating'), 1) }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Reviews Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @forelse ($reviews as $review)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm transition-all duration-300 overflow-hidden">
                {{-- Status Badge --}}
                <div class="p-6 pb-0">
                    <div class="flex items-center justify-between mb-4">
                        {{-- Star Rating --}}
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5  {{ $i <= $review->rating ? 'text-yellow-400 fill-current' : 'fill-gray-300' }}"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm font-medium text-gray-600">({{ $review->rating }}/5)</span>
                        </div>

                        {{-- Status Badge --}}
                        @if (auth()->user()->role === 'admin')
                            <div class="flex items-center">
                                @if ($review->status === 'show')
                                    <div
                                        class="flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Approved
                                    </div>
                                @else
                                    <div
                                        class="flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Pending
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Review Content --}}
                <div class="px-6 pb-4">
                    <div class="bg-gray-50 rounded-xl p-4 mb-4 relative">
                        <svg class="w-8 h-8 text-gray-300 absolute top-2 left-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z" />
                        </svg>
                        <div class="pl-10">
                            <p class="text-gray-700 leading-relaxed italic">
                                @if (request('cek_kata'))
                                    @php
                                        $kataKotor = App\Models\KataKotor::pluck('kata')->toArray();
                                        $highlightedReview = $review->review;
                                        foreach ($kataKotor as $word) {
                                            $highlightedReview = str_ireplace(
                                                $word,
                                                '<span class="bg-red-200 text-red-800 px-1 rounded font-semibold animate-pulse">' .
                                                    $word .
                                                    '</span>',
                                                $highlightedReview,
                                            );
                                        }
                                    @endphp
                                    {!! $highlightedReview !!}
                                @else
                                    "{{ $review->review }}"
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- User Info --}}
                <div class="px-6 pb-4">
                    <div class="flex items-center">
                        @php
                            $profilePath = $review->User->profile_path ?? null;
                            $src = null;
                            $initial = strtoupper(
                                Str::substr($review->User->username ?? ($review->User->name ?? 'U'), 0, 1),
                            );
                            if ($profilePath) {
                                if (preg_match('/^https?:\/\//i', $profilePath)) {
                                    $src = $profilePath;
                                } else {
                                    $normalized = ltrim(preg_replace('#^storage/#', '', $profilePath), '/');
                                    $src = asset('storage/' . $normalized);
                                }
                            }
                        @endphp

                        @if ($src)
                            <img src="{{ $src }}" alt="Foto Profil {{ $review->User->nama ?? 'Pengguna' }}"
                                class="w-12 h-12 rounded-full object-cover border-3 border-white shadow-lg ring-2 ring-gray-200" />
                        @else
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full text-white flex items-center justify-center font-bold text-lg shadow-lg ring-2 ring-white">
                                {{ $initial }}
                            </div>
                        @endif

                        <div class="ml-4 flex-1">
                            <h4 class="font-semibold text-gray-900 capitalize text-lg">
                                {{ $review->User->nama ?? 'Anonim' }}
                            </h4>
                            <div class="flex items-center">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 capitalize">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                    </svg>
                                    {{ $review->User->role ?? 'Pengguna' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons for Admin --}}
                @if (auth()->user()->role === 'admin')
                    <div class="px-6 pb-6">
                        <div class="flex gap-3 pt-4 border-t border-gray-100">
                            @if ($review->status === 'hide')
                                <form action="{{ route('review.approve', $review->id_review) }}" method="POST"
                                    class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('review.delete', $review->id_review) }}" method="POST"
                                class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus review ini?')"
                                    class="w-full px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.436L3 21l2.436-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada review ditemukan</h3>
                    <p class="text-gray-600 mb-6">
                        @if (request('search'))
                            Tidak ada review yang sesuai dengan pencarian "{{ request('search') }}"
                        @else
                            Belum ada review yang perlu dimoderasi
                        @endif
                    </p>
                    @if (request('search') || request('cek_kata'))
                        <a href="{{ route('admin.review') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Tampilkan Semua Review
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    @if ($reviews->hasPages())
        <div class="flex justify-center items-center space-x-4 mt-6">
            <!-- Previous Button -->
            @if ($reviews->onFirstPage())
                <span
                    class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                    ← Previous
                </span>
            @else
                <a href="{{ $reviews->previousPageUrl() }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    ← Previous
                </a>
            @endif

            <!-- Page Numbers -->
            <div class="flex space-x-1">
                @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                    @if ($page == $reviews->currentPage())
                        <span
                            class="px-3 py-2 text-sm font-medium text-white bg-amber-400 border border-amber-500/50 rounded-lg">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Next Button -->
            @if ($reviews->hasMorePages())
                <a href="{{ $reviews->nextPageUrl() }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    Next →
                </a>
            @else
                <span
                    class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                    Next →
                </span>
            @endif
        </div>
    @endif
@endsection

@push('scripts')
@endpush
