<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel</title>
    <!-- Fonts -->
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AOS Library -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .img-container {
            position: relative;
            overflow: hidden;
        }

        .img-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(6, 8, 220, 0.8) 0%, rgba(147, 51, 234, 0.2) 50%, rgba(252, 253, 175, 0.4) 100%);
            z-index: 2;
            opacity: 0.5;
            background-color: rgba(0, 0, 0, 0.805);
            -webkit-backdrop-filter: blur(50px);
            backdrop-filter: blur(50px);
        }

        .content-overlay {
            position: relative;
            z-index: 3;
        }
    </style>
</head>

<body class="h-full bg-gray-50">
    <div class="flex min-h-full items-center justify-center px-6 py-12 lg:px-8">
        <div class="w-full max-w-4xl">
            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden sm:s">
                <a href="{{ route('beranda') }}"
                    class="fixed m-4 flex items-center justify-center w-14 h-14 rounded-full 
          bg-gradient-to-br from-gray-200 to-gray-300 
          shadow-[inset_0_4px_8px_rgba(0,0,0,0.2),inset_0_-2px_4px_rgba(255,255,255,0.6),inset_0_0_0_1px_rgba(0,0,0,0.05)] 
          transform translate-y-0 
          transition-all duration-200 ease-out
          hover:bg-gradient-to-br hover:from-gray-150 hover:to-gray-250
          hover:shadow-[inset_0_3px_6px_rgba(0,0,0,0.15),inset_0_-1px_3px_rgba(255,255,255,0.7),inset_0_0_0_1px_rgba(0,0,0,0.03)] 
          active:shadow-[inset_0_6px_12px_rgba(0,0,0,0.25),inset_0_2px_4px_rgba(0,0,0,0.15),inset_0_0_0_1px_rgba(0,0,0,0.08)]
          active:translate-y-[1px]
          active:bg-gradient-to-br active:from-gray-250 active:to-gray-350
          text-gray-700
          backdrop-blur-md
          z-50">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path
                            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                </a>


                <div class="flex flex-col lg:flex-row">
                    <!-- Left Side - Video Background -->
                    <div class="hidden lg:flex lg:w-1/2 img-container p-8 items-center justify-center relative">
                        <!-- Video Background -->
                        <img class="img-background grayscale-25 blur-[1px]"
                            src="{{ asset('storage/' . $site['yayasanProfile']->background) }}">

                        <!-- Video Overlay -->
                        <div class="img-overlay"></div>

                        <!-- Content Overlay -->
                        <div class="content-overlay text-center text-white">
                            <div class="mb-8">
                                <div
                                    class="w-24 h-24 mx-auto bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="text-3xl font-bold mb-4">Welcome Back!</h1>
                            <p class="text-lg text-white/90 mb-8">Masuk untuk mengakses akun Anda dan melanjutkan
                                perjalanan Anda bersama kami.</p>
                            <div class="flex justify-center space-x-2">
                                <div class="w-2 h-2 bg-white/60 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-white/60 rounded-full animate-bounce"
                                    style="animation-delay: 0.1s"></div>
                                <div class="w-2 h-2 bg-white/60 rounded-full animate-bounce"
                                    style="animation-delay: 0.2s"></div>
                            </div>
                        </div>

                        <!-- Decorative elements -->
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32 z-3">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24 z-3">
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="lg:w-1/2 p-8 lg:p-12">
                        <div class="max-w-md mx-auto">
                            <!-- Logo -->
                            <div class="text-center mb-8">
                                <img class="mx-auto h-24 w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="logo yayasan" />
                            </div>

                            <!-- Form -->
                            <form class="space-y-6" action="/login" method="POST">
                                @csrf
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-900 mb-2">Username
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="username" id="username" required
                                            class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan Password" placeholder="Enter your username" />
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-900 mb-2">Password</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password"
                                            autocomplete="new-password" required
                                            class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan Password" />
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <button type="button"
                                                class="text-gray-400 hover:text-gray-600 cursor-pointer"
                                                onclick="togglePassword('password', 'toggle-password-icon')">
                                                <svg id="toggle-password-icon" class="h-5 w-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112
                                                        19c-4.478 0-8.268-2.943-9.542-7a9.957
                                                        9.957 0 012.873-4.412m3.113-2.14A9.956
                                                        9.956 0 0112 5c4.478 0 8.268 2.943
                                                        9.542 7a9.958 9.958 0 01-4.293 5.177M15
                                                        12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M3 3l18 18" />
                                                </svg>

                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="cursor-pointer group relative flex w-full justify-center rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 hover:shadow-lg">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">

                                        </span>
                                        Sign in
                                    </button>
                                </div>
                            </form>

                            <!-- Sign up link -->
                            <div class="mt-8 text-center">
                                <p class="text-sm text-gray-600">
                                    Belum Memiliki Akun atau Akun Kamu Terhapus?
                                </p>
                                <div class="mt-2 space-x-4">
                                    <a href="{{ route('register') }}"
                                        class="font-semibold text-gray-400 hover:text-indigo-500 transition-colors">
                                        Daftar
                                    </a>
                                    <span class="text-gray-400">|</span>
                                    <a href="{{ route('restore') }}"
                                        class="font-semibold text-gray-400 hover:text-orange-500 transition-colors">
                                        Pulihkan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @error('username')
            <div id="login-alert"
                class="fixed top-6 right-0 z-50 px-4 py-3 bg-red-100 border border-red-400 text-red-800 rounded-lg shadow-lg transform translate-x-full opacity-0 transition duration-500 ease-out">
                <div class="flex items-start justify-between space-x-4">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">{{ $message }}</span>
                    </div>
                    <button onclick="closeLoginAlert()" class="text-red-500 hover:text-red-700 focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @enderror
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            const isPassword = field.type === 'password';

            field.type = isPassword ? 'text' : 'password';

            icon.innerHTML = isPassword ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.478 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.064 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112
                       19c-4.478 0-8.268-2.943-9.542-7a9.957
                       9.957 0 012.873-4.412m3.113-2.14A9.956
                       9.956 0 0112 5c4.478 0 8.268 2.943
                       9.542 7a9.958 9.958 0 01-4.293 5.177M15
                       12a3 3 0 11-6 0 3 3 0 016 0z" />
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />`;
        }

        // Animasi masuk saat halaman dimuat
        window.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('login-alert');
            if (alertBox) {
                alertBox.classList.remove('translate-x-full', 'opacity-0');
                alertBox.classList.add('translate-x-1', 'opacity-100', 'right-6');

                // Auto close after 5 seconds
                setTimeout(() => {
                    alertBox.classList.remove('right-6');
                    alertBox.classList.add('opacity-0', 'translate-x-full');
                }, 5000);
            }
        });

        function closeLoginAlert() {
            const alertBox = document.getElementById('login-alert');
            if (alertBox) {
                alertBox.classList.add('opacity-0', 'translate-x-full');
            }
        }
    </script>

</body>

</html>
