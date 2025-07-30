<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-gray-50">
    <div class="flex min-h-full items-center justify-center px-6 py-12 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Logo and Header -->
                <div class="text-center mb-8">
                    <img class="mx-auto h-24 w-auto" src="{{ asset('img/logo.png') }}" alt="yaguwipa logo" />
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Buat Akun Anda</h2>
                    <p class="mt-2 text-sm text-gray-600">Bersama kita bisa membuat perubahan yang lebih baik</p>
                </div>
                <!-- Form -->
                <form class="space-y-6" action="/register" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Global error messages --}}
                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600 bg-red-100 p-4 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-900 mb-2">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required
                            class="block w-full rounded-lg bg-white px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan Username" />
                        @error('username')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" autocomplete="new-password" required
                                class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan Password" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" class="text-gray-400 hover:text-gray-600 cursor-pointer"
                                    onclick="togglePassword('password', 'toggle-password-icon')">
                                    <svg id="toggle-password-icon" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112
                                            19c-4.478 0-8.268-2.943-9.542-7a9.957
                                            9.957 0 012.873-4.412m3.113-2.14A9.956
                                            9.956 0 0112 5c4.478 0 8.268 2.943
                                            9.542 7a9.958 9.958 0 01-4.293 5.177M15
                                            12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Password strength indicator -->
                        <div class="mt-2">
                            <div class="flex space-x-1">
                                <div class="h-1 w-full bg-gray-200 rounded-full">
                                    <div id="password-strength"
                                        class="h-1 bg-red-500 rounded-full transition-all duration-300"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                            <p id="password-hint" class="text-xs text-gray-500 mt-1">Password strength: weak</p>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">Confirm
                            Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                autocomplete="new-password" required
                                class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan Password" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button type="button" class="text-gray-400 hover:text-gray-600 cursor-pointer"
                                    onclick="togglePassword('password_confirmation', 'toggle-password-confirmation-icon')">
                                    <svg id="toggle-password-confirmation-icon" class="h-5 w-5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112
                                            19c-4.478 0-8.268-2.943-9.542-7a9.957
                                            9.957 0 012.873-4.412m3.113-2.14A9.956
                                            9.956 0 0112 5c4.478 0 8.268 2.943
                                            9.542 7a9.958 9.958 0 01-4.293 5.177M15
                                            12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3l18 18" />
                                    </svg>

                                </button>

                            </div>
                        </div>
                        <div id="password-match" class="mt-1 text-xs hidden">
                            <span class="text-red-500">Passwords do not match</span>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-900 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                            class="block w-full rounded-lg px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan Nama Lengkap" />
                        @error('nama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email
                            (opsional)</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="block w-full rounded-lg px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="contoh@email.com" />
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="no_tlp" class="block text-sm font-medium text-gray-900 mb-2">Nomor
                            Telepon</label>
                        <input type="text" name="no_tlp" id="no_tlp" value="{{ old('no_tlp') }}" required
                            class="block w-full rounded-lg px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="08xxxxxxxxxx" />
                        @error('no_tlp')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-900 mb-2">Alamat</label>
                        <textarea name="alamat" id="alamat" required
                            class="block w-full rounded-lg px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan Alamat Lengkap">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Foto Profil (opsional) --}}
                    <div>
                        <label for="profile_path" class="block text-sm font-medium text-gray-900 mb-2">Foto Profil
                            (opsional)</label>
                        <input type="file" name="profile_path" id="profile_path" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        @error('profile_path')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div>
                        <button type="submit"
                            class="w-full justify-center rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none transition duration-200">
                            Buat Akun
                        </button>
                    </div>
                </form>


                <!-- Sign in link -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">Masuk</a>
                    </p>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @enderror

    <script>
        // Toggle password visibility
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
        // Password strength checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBar = document.getElementById('password-strength');
            const strengthText = document.getElementById('password-hint');

            let strength = 0;
            let strengthLabel = 'Weak';
            let color = 'bg-red-500';

            // Check password criteria
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 25;

            if (strength >= 75) {
                strengthLabel = 'Strong';
                color = 'bg-green-500';
            } else if (strength >= 50) {
                strengthLabel = 'Medium';
                color = 'bg-yellow-500';
            }

            strengthBar.style.width = Math.min(strength, 100) + '%';
            strengthBar.className = `h-1 rounded-full transition-all duration-300 ${color}`;
            strengthText.textContent = `Password strength: ${strengthLabel.toLowerCase()}`;
        });

        // Password confirmation checker
        document.getElementById('password_confirmation').addEventListener('input', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = e.target.value;
            const matchIndicator = document.getElementById('password-match');

            if (confirmation && password !== confirmation) {
                matchIndicator.classList.remove('hidden');
            } else {
                matchIndicator.classList.add('hidden');
            }
        });

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
