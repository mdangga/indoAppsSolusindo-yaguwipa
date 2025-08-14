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
                <!-- Partners Grid -->
                <div class="px-10 sm:px-6 lg:px-14 pb-20">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                        <!-- PT Indo Apps Solusindo -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.1s;" data-aos="zoom-in" data-aos-delay="100">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/pt-indo-apps-solusindo.png" alt="PT Indo Apps Solusindo"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">PT Indo Apps
                                    Solusindo</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Denpasar Institute -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.2s;" data-aos="zoom-in" data-aos-delay="200">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/denpasar-institute.png" alt="Denpasar Institute"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Denpasar
                                    Institute</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}

                            </div>
                        </div>

                        <!-- GCOM -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.3s;" data-aos="zoom-in" data-aos-delay="300">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/gcom.png" alt="GCOM"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">GCOM</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Indo Berkah Konstruksi -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.4s;" data-aos="zoom-in" data-aos-delay="400">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/indo-berkah-konstruksi.png" alt="Indo Berkah Konstruksi"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Indo Berkah
                                    Konstruksi</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Indo Consulting -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.5s;" data-aos="zoom-in" data-aos-delay="500">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/indo-consulting.png" alt="Indo Consulting"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Indo
                                    Consulting
                                </h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Latifaba -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.6s;" data-aos="zoom-in" data-aos-delay="600">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/latifaba.png" alt="Latifaba"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Latifaba</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Nyaman Care -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.7s;" data-aos="zoom-in" data-aos-delay="700">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/nyaman-care.png" alt="Nyaman Care"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Nyaman Care
                                </h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Penerbit Yaguwipa -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.8s;" data-aos="zoom-in" data-aos-delay="800">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/penerbit-yaguwipa.png" alt="Penerbit Yaguwipa"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Penerbit
                                    Yaguwipa
                                </h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Robotic -->
                        <div class="partner-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 0.9s;" data-aos="zoom-in" data-aos-delay="900">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/robotic.png" alt="Robotic"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Robotic</h3>
                                {{-- <span class="text-gray-500 text-xs mt-2">Partner</span> --}}
                            </div>
                        </div>

                        <!-- Teknika Solusinda -->
                        <div class="partner-card bg-white/80  backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-100 stagger-animation"
                            style="animation-delay: 1.0s;" data-aos="zoom-in" data-aos-delay="1000">
                            <div class="flex flex-col items-center text-center h-full">
                                <div
                                    class="partner-logo-container w-20 h-20 sm:w-24 sm:h-24 mb-4 rounded-xl overflow-hidden shadow-md bg-white/50">
                                    <img src="img/lembaga-logo/teknika-solusinda.png" alt="Teknika Solusinda"
                                        class="partner-logo w-full h-full object-contain p-2">
                                </div>
                                <h3 class="partner-name text-sm font-semibold flex-grow flex items-center">Teknika
                                    Solusinda</h3>
                                <span class="text-gray-500 text-xs mt-2">Partner</span>
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
@endpush
