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
            <img src="{{ asset('img/logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap text-gray-200">Yaguwipa</span>
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
