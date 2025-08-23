@extends('layouts.main')

@section('title', 'Partners')

@push('styles')
    {{-- AOS css --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
@endpush

@section('content')
    <main class="content-wrapper">
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <x-header-page title="PARTNERS YAGUWIPA"
                    description="Bersama-sama membangun masa depan yang lebih baik melalui kolaborasi strategis dengan mitra terpercaya di berbagai bidang industri." />

                <div class="px-10 sm:px-6 lg:px-14 pb-20">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @forelse ($partners as $partner)
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.1s;" data-aos="zoom-in" data-aos-delay="100">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="{{ asset('storage/' . $partner->profile_path) }}" alt="{{ $partner->nama }}"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">{{ $partner->nama }}</h3>
                            </div>
                        </div>
                    @empty
                    @endforelse
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
@endpush
