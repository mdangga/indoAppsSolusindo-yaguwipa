<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel</title>
    <!-- Fonts -->
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

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
                <div class="flex flex-col lg:flex-row">
                    <!-- Left Side - Video Background -->
                    <div class="hidden lg:flex lg:w-1/2 img-container p-8 items-center justify-center relative">

                        {{-- <!-- Video Background -->
                        <video class="video-background" autoplay muted loop playsinline height="100%">
                            <source src="{{ asset('vidbg2.mp4') }}" type="video/mp4">
                            <!-- Fallback for browsers that don't support video -->
                            Your browser does not support the video tag.
                        </video> --}}
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
                                <img class="mx-auto h-24 w-auto" src="{{ asset('img/logo.png') }}" alt="Your Company" />
                                {{-- <h2 class="mt-6 text-2xl font-bold tracking-tight text-gray-900">Masuk ke Yaguwipa
                                </h2>
                                <p class="mt-2 text-sm text-gray-600">Isi form dengan benar
                                </p> --}}
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
                                    Belum Memiliki Akun?
                                    <a href="{{ route('register') }}"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">Daftar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </script>

</body>

</html>
