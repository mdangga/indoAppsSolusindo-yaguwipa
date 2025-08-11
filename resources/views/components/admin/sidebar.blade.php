<style>
    /* Custom animations for smooth dropdown */
    .dropdown-content {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        visibility: hidden;
        transition: max-height 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
    }

    .dropdown-content.open {
        max-height: 500px;
        /* sesuaikan dengan kebutuhan */
        opacity: 1;
        visibility: visible;
    }

    .dropdown-arrow {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dropdown-arrow.rotated {
        transform: rotate(180deg);
    }
</style>
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-[#343a40] border-r border-[#4d565f] sm:translate-x-0"
    aria-label="Sidebar">

    <!-- Logo Section -->
    <div class="flex items-center px-3 py-3 border-b border-white/15 lg:px-5 lg:pl-3">
        <a href="{{ route('admin.profiles') }}" class="flex items-center">
            <img src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" class="h-8 me-3" alt="Logo Yayasan" />
            <span class="hidden sm:inline self-center text-sm font-semibold  text-gray-200 max-w-[150px]"
                title="{{ $site['yayasanProfile']->nama_yayasan }}">
                {{ $site['yayasanProfile']->nama_yayasan }}
            </span>
        </a>
    </div>


    <!-- Sidebar Content -->
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium pt-4">
            <!-- Generals Dropdown -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]"
                    onclick="toggleDropdown('generals')">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M495.9 166.6c3.2 8.7.5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4l-55.6 17.8c-8.8 2.8-18.6.3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4c-1.1-8.4-1.7-16.9-1.7-25.5s.6-17.1 1.7-25.4l-43.3-39.4c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160a80 80 0 1 0 0 160" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Generals</span>
                    <svg class="w-3 h-3 dropdown-arrow" id="generals-arrow" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="generals-content" class="dropdown-content">
                    <li class="py-1">
                        <a href="{{ route('admin.profiles') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Profile</a>
                    </li>
                    <li class="py-1">
                        <a href="{{ route('admin.menus') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Menu</a>
                    </li>
                    <li class="py-1">
                        <a href="{{ route('admin.sosmed') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Sosial
                            Media</a>
                    </li>
                </ul>
            </li>
            <!-- User -->
            <li>
                <a type="button" href="{{ route('admin.user') }}"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none">
                            <path
                                d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                            <path fill="currentColor"
                                d="M11 2a5 5 0 1 0 0 10a5 5 0 0 0 0-10m.123 12.55a1 1 0 0 0-.913-1.525c-2.21.14-4.195.858-5.651 1.813c-.728.478-1.348 1.031-1.796 1.63C2.32 17.057 2 17.755 2 18.5c0 1.535 1.278 2.346 2.495 2.763c1.28.439 2.99.638 4.832.707a1 1 0 0 0 .995-1.29A7.5 7.5 0 0 1 10 18.5a7.46 7.46 0 0 1 1.123-3.95m6.288 6.232a5.4 5.4 0 0 1-.822 0l-.087.325a1 1 0 0 1-1.932-.518l.09-.337q-.362-.18-.693-.42l-.26.259a1 1 0 0 1-1.414-1.414l.33-.331a5.4 5.4 0 0 1-.517-1.202a1 1 0 0 1 1.918-.568c.878 2.963 5.074 2.963 5.952 0a1 1 0 1 1 1.918.568c-.13.44-.306.841-.518 1.202l.331.33a1 1 0 0 1-1.414 1.415l-.26-.26q-.332.24-.693.421l.09.337a1 1 0 1 1-1.932.518z" />
                        </g>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Users</span>
                </a>
            </li>
            <!-- Institusi -->
            <li>
                <a type="button" href="{{ route('admin.institusi') }}"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path
                                d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-3.59 1.787A.5.5 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.5 4.5 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                            <path
                                d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0a1.5 1.5 0 0 0 3 0" />
                        </g>
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Institusi</span>
                </a>
            </li>
            {{-- kerja-sama --}}
            <li>
                <a type="button" href="{{ route('admin.kerjaSama') }}"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="640" height="512" viewBox="0 0 640 512">
                        <path fill="currentColor"
                            d="m323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5L373 188.8l139 128V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2m22.8 124.4l-51.7 40.2c-31.5 24.6-77.2 18.2-100.8-14.2c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48v224h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8zM16 128c-8.8 0-16 7.2-16 16v208c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V128zm32 192a16 16 0 1 1 0 32a16 16 0 1 1 0-32m496-192v224c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16zm32 208a16 16 0 1 1 32 0a16 16 0 1 1-32 0" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Kerja Sama</span>
                </a>
            </li>
            <!-- News and Event Dropdown -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg text-gray-200 hover:bg-[#535c66] group"
                    onclick="toggleDropdown('news-event')">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path fill="currentColor"
                            d="M5 12v-2h2v2zm10-7.506A1.5 1.5 0 0 0 13.5 3H3.423a1.5 1.5 0 0 0-1.5 1.5v9a2.5 2.5 0 0 0 2.5 2.5h11.154a2.5 2.5 0 0 0 2.5-2.5v-6a1.5 1.5 0 0 0-1.5-1.5H16v7.23a.5.5 0 0 1-1 0zM4 6.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5M9.5 9h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1M9 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5M4.5 9h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">News and
                        Event</span>
                    <svg class="w-3 h-3 dropdown-arrow" id="news-event-arrow" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="news-event-content" class="dropdown-content">
                    <li class="py-1">
                        <a href="{{ route('admin.kategoriBerita') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Kategori</a>
                    </li>
                    <li class="py-1">
                        <a href="{{ route('admin.berita') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">News
                            and Event</a>
                    </li>
                </ul>
            </li>

            <!-- Gallery Dropdown -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]"
                    onclick="toggleDropdown('gallery')">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="576" height="512" viewBox="0 0 576 512">
                        <path fill="currentColor"
                            d="M160 32c-35.3 0-64 28.7-64 64v224c0 35.3 28.7 64 64 64h352c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm236 106.7l96 144c4.9 7.4 5.4 16.8 1.2 24.6S480.9 320 472 320H200c-9.2 0-17.6-5.3-21.6-13.6s-2.9-18.2 2.9-25.4l64-80c4.6-5.7 11.4-9 18.7-9s14.2 3.3 18.7 9l17.3 21.6l56-84c4.5-6.6 12-10.6 20-10.6s15.5 4 20 10.7M192 128a32 32 0 1 1 64 0a32 32 0 1 1-64 0m-144-8c0-13.3-10.7-24-24-24S0 106.7 0 120v224c0 75.1 60.9 136 136 136h320c13.3 0 24-10.7 24-24s-10.7-24-24-24H136c-48.6 0-88-39.4-88-88z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Gallery</span>
                    <svg class="w-3 h-3 dropdown-arrow" id="gallery-arrow" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="gallery-content" class="dropdown-content ">
                    <li class="py-1">
                        <a href="{{ route('admin.galleryPhoto') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Photo</a>
                    </li>
                    <li class="py-1">
                        <a href="{{ route('admin.galleryVideo') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Video</a>
                    </li>
                </ul>
            </li>
            <!-- Programs Dropdown -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]"
                    onclick="toggleDropdown('programs')">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="448" height="512" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M128 0c17.7 0 32 14.3 32 32v32h128V32c0-17.7 14.3-32 32-32s32 14.3 32 32v32h48c26.5 0 48 21.5 48 48v48H0v-48c0-26.5 21.5-48 48-48h48V32c0-17.7 14.3-32 32-32M0 192h448v272c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48zm80 64c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h96c8.8 0 16-7.2 16-16v-96c0-8.8-7.2-16-16-16z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Program</span>
                    <svg class="w-3 h-3 dropdown-arrow" id="programs-arrow" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="programs-content" class="dropdown-content">
                    <li class="py-1">
                        <a href="{{ route('admin.kategoriProgram') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Kategori
                            Program</a>
                    </li>
                    <li class="py-1">
                        <a href="{{ route('admin.program') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Program</a>
                    </li>
                </ul>
            </li>

            {{-- campaign --}}
            <li>
                <a type="button" href="{{ route('admin.campaigns') }}"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="640" height="512" viewBox="0 0 640 512">
                        <path fill="currentColor"
                            d="m47.6 300.4l180.7 168.7c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9l180.7-168.7c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141c-45.6-7.6-92 7.3-124.6 39.9l-12 12l-12-12c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Campaign</span>
                </a>
            </li>

            {{-- donasi --}}
            <li>
                <a type="button" href="{{ route('admin.donasi') }}"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]">

                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M16 12c2.76 0 5-2.24 5-5s-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5m5.45 5.6c-.39-.4-.88-.6-1.45-.6h-7l-2.08-.73l.33-.94L13 16h2.8c.35 0 .63-.14.86-.37s.34-.51.34-.82c0-.54-.26-.91-.78-1.12L8.95 11H7v9l7 2l8.03-3c.01-.53-.19-1-.58-1.4M5 11H.984v11H5z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Donasi</span>
                </a>
            </li>

            <!-- Publications Dropdown -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-200 transition duration-75 rounded-lg group hover:bg-[#535c66]"
                    onclick="toggleDropdown('Publications')">
                    <svg class="shrink-0 w-5 h-5 text-gray-200 transition duration-75 group-hover:text-gray-200"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m19 2l-5 4.5v11l5-4.5zM6.5 5C4.55 5 2.45 5.4 1 6.5v14.66c0 .25.25.5.5.5c.1 0 .15-.07.25-.07c1.35-.65 3.3-1.09 4.75-1.09c1.95 0 4.05.4 5.5 1.5c1.35-.85 3.8-1.5 5.5-1.5c1.65 0 3.35.31 4.75 1.06c.1.05.15.03.25.03c.25 0 .5-.25.5-.5V6.5c-.6-.45-1.25-.75-2-1V19c-1.1-.35-2.3-.5-3.5-.5c-1.7 0-4.15.65-5.5 1.5V6.5C10.55 5.4 8.45 5 6.5 5" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-normal">Publikasi</span>
                    <svg class="w-3 h-3 dropdown-arrow" id="Publications-arrow" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="Publications-content" class="dropdown-content">
                    <li class="py-1">
                        <a href="{{ route('admin.jenisPublikasi') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Jenis
                            Publikasi</a>
                    </li>
                    <li class="py-1">
                        <a href="{{ route('admin.publikasi') }}"
                            class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-[#535c66] font-normal">Publikasi</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>

<script>
    function toggleDropdown(id) {
        const content = document.getElementById(id + '-content');
        const arrow = document.getElementById(id + '-arrow');

        // Close other dropdowns
        const allContents = document.querySelectorAll('.dropdown-content');
        const allArrows = document.querySelectorAll('.dropdown-arrow');

        allContents.forEach(item => {
            if (item.id !== id + '-content') {
                item.classList.remove('open');
            }
        });

        allArrows.forEach(item => {
            if (item.id !== id + '-arrow') {
                item.classList.remove('rotated');
            }
        });

        // Toggle current dropdown
        content.classList.toggle('open');
        arrow.classList.toggle('rotated');
    }
</script>
