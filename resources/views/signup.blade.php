<!DOCTYPE html>
<html lang="en" class="h-full bg-gradient-to-br from-blue-50 to-indigo-100">

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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        .form-input:hover {
            border-color: #cbd5e1;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }

        .card-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .section-divider {
            border-top: 1px solid #e5e7eb;
            margin: 2rem 0;
            position: relative;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 640px) {
            .grid-2 {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="flex min-h-full items-center justify-center px-4 py-8 lg:px-8">
        <div class="w-full max-w-2xl">
            <!-- Card Container -->
            <div class="card-container rounded-3xl shadow-2xl p-8 lg:p-10">
                <!-- Logo and Header -->
                <div class="text-center mb-10">
                    <div class="relative inline-block">
                        <img class="mx-auto h-20 w-auto drop-shadow-lg" src="{{ asset('img/logo.png') }}"
                            alt="yaguwipa logo" />
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-20 blur-lg">
                        </div>
                    </div>
                    <h2
                        class="mt-8 text-3xl font-bold tracking-tight bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        Buat Akun Anda
                    </h2>
                    <p class="mt-3 text-sm text-gray-600 max-w-sm mx-auto leading-relaxed">
                        Bersama kita bisa membuat perubahan yang lebih baik
                    </p>
                </div>

                <!-- Form -->
                <form class="space-y-0" action="/register" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Global error messages --}}
                    @if ($errors->any())
                        <div class="mb-6 text-sm text-red-600 bg-red-50 border border-red-200 p-4 rounded-xl">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">Terdapat kesalahan:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Informasi Pribadi Section -->
                    <div class="space-y-6">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Informasi Pribadi</h3>
                            <p class="text-xs text-gray-500">Lengkapi data diri Anda</p>
                        </div>

                        {{-- Nama --}}
                        <div class="form-group">
                            <label for="nama" class="form-label text-sm">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                class="form-input block w-full rounded-xl px-4 py-3.5 text-gray-900 placeholder:text-gray-400"
                                placeholder="Masukkan Nama Lengkap" />
                            @error('nama')
                                <p class="text-sm text-red-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email dan Nomor Telepon dalam satu baris --}}
                        <div class="grid-2">
                            <div class="form-group">
                                <label for="email" class="form-label text-sm">
                                    Email
                                    <span class="text-xs text-gray-500 font-normal">(opsional)</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="form-input block w-full rounded-xl px-4 py-3.5 text-gray-900 placeholder:text-gray-400"
                                    placeholder="contoh@email.com" />
                                @error('email')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_tlp" class="form-label text-sm">Nomor Telepon</label>
                                <input type="text" name="no_tlp" id="no_tlp" value="{{ old('no_tlp') }}" required
                                    class="form-input block w-full rounded-xl px-4 py-3.5 text-gray-900 placeholder:text-gray-400"
                                    placeholder="08xxxxxxxxxx" />
                                @error('no_tlp')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group">
                            <label for="alamat" class="form-label text-sm">Alamat</label>
                            <textarea name="alamat" id="alamat" required rows="3"
                                class="form-input block w-full rounded-xl px-4 py-3.5 text-gray-900 placeholder:text-gray-400 resize-none"
                                placeholder="Masukkan Alamat Lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-sm text-red-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Foto Profil (opsional) --}}
                        <div class="form-group">
                            <label for="profile_path" class="form-label text-sm">
                                Foto Profil
                                <span class="text-xs text-gray-500 font-normal">(opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="file" name="profile_path" id="profile_path" accept="image/*"
                                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors border-2 border-gray-200 rounded-xl p-2" />
                            </div>
                            @error('profile_path')
                                <p class="text-sm text-red-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Section Divider -->
                    <div class="section-divider"></div>

                    <!-- Informasi Akun Section -->
                    <div class="space-y-6">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Informasi Akun</h3>
                            <p class="text-xs text-gray-500">Buat username dan password untuk akun Anda</p>
                        </div>

                        {{-- Username --}}
                        <div class="form-group">
                            <label for="username" class="form-label text-sm">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                required
                                class="form-input block w-full rounded-xl bg-white px-4 py-3.5 text-gray-900 placeholder:text-gray-400"
                                placeholder="Masukkan Username" />
                            @error('username')
                                <p class="text-sm text-red-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password dan Konfirmasi Password dalam satu baris --}}
                        <div class="grid-2">
                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password" class="form-label text-sm">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        autocomplete="new-password" required
                                        class="form-input block w-full rounded-xl bg-white px-4 py-3.5 pr-12 text-gray-900 placeholder:text-gray-400"
                                        placeholder="Masukkan Password" />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <button type="button"
                                            class="text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('password', 'toggle-password-icon')">
                                            <svg id="toggle-password-icon" class="h-5 w-5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.957 9.957 0 012.873-4.412m3.113-2.14A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.293 5.177M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label text-sm">Konfirmasi
                                    Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        autocomplete="new-password" required
                                        class="form-input block w-full rounded-xl bg-white px-4 py-3.5 pr-12 text-gray-900 placeholder:text-gray-400"
                                        placeholder="Ulangi Password" />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <button type="button"
                                            class="text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('password_confirmation', 'toggle-password-confirmation-icon')">
                                            <svg id="toggle-password-confirmation-icon" class="h-5 w-5"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.957 9.957 0 012.873-4.412m3.113-2.14A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.958 9.958 0 01-4.293 5.177M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password strength indicator dan match indicator -->
                        <div class="space-y-3">
                            <!-- Password strength indicator -->
                            <div>
                                <div class="flex space-x-1">
                                    <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                        <div id="password-strength"
                                            class="h-2 bg-red-500 rounded-full transition-all duration-500"
                                            style="width: 0%"></div>
                                    </div>
                                </div>
                                <p id="password-hint" class="text-xs text-gray-500 mt-2">Kekuatan password: lemah</p>
                            </div>

                            <!-- Password match indicator -->
                            <div id="password-match" class="text-xs hidden">
                                <span class="text-red-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Password tidak cocok
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="pt-6">
                        <button type="submit"
                            class="btn-primary w-full justify-center rounded-xl px-6 py-4 text-base font-semibold text-white shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Akun
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Sign in link -->
                <div class="mt-8 text-center border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text hover:from-blue-700 hover:to-purple-700 transition-all duration-300">
                            Masuk Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @error('username')
        <div id="login-alert"
            class="fixed top-6 right-0 z-50 px-6 py-4 bg-red-50 border-l-4 border-red-400 text-red-800 rounded-r-xl shadow-2xl transform translate-x-full opacity-0 transition-all duration-500 ease-out max-w-md">
            <div class="flex items-start justify-between space-x-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-sm">Terjadi Kesalahan</p>
                        <p class="text-sm">{{ $message }}</p>
                    </div>
                </div>
                <button onclick="closeLoginAlert()"
                    class="text-red-500 hover:text-red-700 focus:outline-none flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            let strengthLabel = 'Lemah';
            let color = 'bg-red-500';

            // Check password criteria
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 25;

            if (strength >= 100) {
                strengthLabel = 'Sangat Kuat';
                color = 'bg-green-600';
            } else if (strength >= 75) {
                strengthLabel = 'Kuat';
                color = 'bg-green-500';
            } else if (strength >= 50) {
                strengthLabel = 'Sedang';
                color = 'bg-yellow-500';
            } else if (strength >= 25) {
                strengthLabel = 'Cukup';
                color = 'bg-orange-500';
            }

            strengthBar.style.width = Math.min(strength, 100) + '%';
            strengthBar.className = `h-2 rounded-full transition-all duration-500 ${color}`;
            strengthText.textContent = `Kekuatan password: ${strengthLabel.toLowerCase()}`;
            strengthText.className =
                `text-xs mt-2 ${strength >= 75 ? 'text-green-600' : strength >= 50 ? 'text-yellow-600' : 'text-gray-500'}`;
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
                setTimeout(() => {
                    alertBox.classList.remove('translate-x-full', 'opacity-0');
                    alertBox.classList.add('translate-x-0', 'opacity-100', 'right-6');
                }, 100);

                // Auto close after 5 seconds
                setTimeout(() => {
                    closeLoginAlert();
                }, 5000);
            }
        });

        function closeLoginAlert() {
            const alertBox = document.getElementById('login-alert');
            if (alertBox) {
                alertBox.classList.remove('translate-x-0', 'opacity-100');
                alertBox.classList.add('opacity-0', 'translate-x-full');

                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 500);
            }
        }

        // Add smooth scrolling animation when form loads
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('.form-group');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    element.style.transition = 'all 0.6s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>

</html>
