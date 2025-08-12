<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .form-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
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
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        .btn-secondary {
            background: white;
            border: 2px solid #e5e7eb;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            border-color: #6366f1;
            color: #6366f1;
            transform: translateY(-1px);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .stepper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .stepper-line {
            height: 3px;
            background: #e5e7eb;
            border-radius: 2px;
            position: relative;
            overflow: hidden;
        }

        .stepper-progress {
            height: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        .stepper-text {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.5rem;
            text-align: center;
        }

        @media (max-width: 640px) {
            .grid-2 {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-out;
        }
    </style>
</head>

<body class="h-full bg-gray-50 ">
    <div class="flex min-h-full items-center justify-center px-4 py-8 lg:px-8">
        <div class="w-full max-w-lg">
            <!-- Card Container -->
            <div class="card-container rounded-2xl shadow-xl p-6 lg:p-8">
                <!-- Logo and Header -->
                <div class="text-center mb-6">
                    <div class="relative inline-block">
                        <img class="mx-auto h-16 w-auto drop-shadow-lg" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                            alt="yaguwipa logo" />
                        <div
                            class="absolute -inset-3 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full opacity-20 blur-lg">
                        </div>
                    </div>
                    <h2
                        class="mt-6 text-2xl font-bold tracking-tight bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        Buat Akun Anda
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 max-w-sm mx-auto leading-relaxed">
                        Bersama kita bisa membuat perubahan yang lebih baik
                    </p>
                </div>

                <!-- Progress Stepper -->
                <div class="stepper">
                    <div class="w-full">
                        <div class="stepper-line w-full">
                            <div id="stepper-progress" class="stepper-progress" style="width: 33.33%"></div>
                        </div>
                        <div class="stepper-text">
                            <span id="step-text">Langkah 1 dari 3 - Informasi Akun</span>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form id="register-form" class="space-y-0" action="/register" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div
                            class="fixed top-6 right-6 z-50 w-full max-w-xs bg-red-50 border border-red-200 text-red-600 text-sm p-4 rounded-xl shadow-lg space-y-2 animate-fade-in">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">Terdapat kesalahan:</span>
                            </div>
                            <ul class="list-disc list-inside pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <!-- Step 1: Informasi Akun -->
                    <div id="step-1" class="step active">
                        <div class="space-y-4">
                            {{-- <div class="text-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Informasi Akun</h3>
                                <p class="text-xs text-gray-500">Buat username dan password untuk akun Anda</p>
                            </div> --}}

                            {{-- Username --}}
                            <div class="form-group">
                                <label for="username" class="form-label text-sm">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}"
                                    required
                                    class="form-input block w-full rounded-xl bg-white px-4 py-3 text-gray-900 placeholder:text-gray-400"
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

                            {{-- Password --}}
                            <div class="form-group">
                                <label for="password" class="form-label text-sm">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" autocomplete="new-password"
                                        required
                                        class="form-input block w-full rounded-xl bg-white px-4 py-3 pr-12 text-gray-900 placeholder:text-gray-400"
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
                                <!-- Password strength indicator -->
                                <div class="mt-2">
                                    <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                        <div id="password-strength"
                                            class="h-2 bg-red-500 rounded-full transition-all duration-500"
                                            style="width: 0%"></div>
                                    </div>
                                    <p id="password-hint" class="text-xs text-gray-500 mt-1">Kekuatan password: lemah
                                    </p>
                                </div>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label text-sm">Konfirmasi
                                    Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        autocomplete="new-password" required
                                        class="form-input block w-full rounded-xl bg-white px-4 py-3 pr-12 text-gray-900 placeholder:text-gray-400"
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
                                <!-- Password match indicator -->
                                <div id="password-match" class="text-xs mt-1 hidden">
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
                    </div>

                    <!-- Step 2: Informasi Pribadi -->
                    <div id="step-2" class="step">
                        <div class="space-y-4">
                            {{-- <div class="text-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h3>
                                <p class="text-xs text-gray-500">Lengkapi data diri Anda</p>
                            </div> --}}

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="nama" class="form-label text-sm">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    required
                                    class="form-input block w-full rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400"
                                    placeholder="Masukkan Nama Lengkap" />
                                @error('nama')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email" class="form-label text-sm">
                                    Email
                                    <span class="text-xs text-gray-500 font-normal">(opsional)</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="form-input block w-full rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400"
                                    placeholder="contoh@email.com" />
                                @error('email')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Nomor Telepon --}}
                            <div class="form-group">
                                <label for="no_tlp" class="form-label text-sm">Nomor Telepon</label>
                                <input type="text" name="no_tlp" id="no_tlp" value="{{ old('no_tlp') }}"
                                    required
                                    class="form-input block w-full rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400"
                                    placeholder="08xxxxxxxxxx" />
                                @error('no_tlp')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group">
                                <label for="alamat" class="form-label text-sm">Alamat</label>
                                <textarea name="alamat" id="alamat" required rows="3"
                                    class="form-input block w-full rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400 resize-none"
                                    placeholder="Masukkan Alamat Lengkap">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Foto Profil -->
                    <div id="step-3" class="step">
                        <div class="space-y-4">
                            <div class="text-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Foto Profil</h3>
                                <p class="text-xs text-gray-500">Upload foto profil Anda (opsional)</p>
                            </div>

                            {{-- Foto Profil --}}
                            <div class="form-group">
                                <label for="profile_path" class="form-label text-sm">
                                    Foto Profil
                                    <span class="text-xs text-gray-500 font-normal">(opsional)</span>
                                </label>
                                <div class="relative">
                                    <input type="file" name="profile_path" id="profile_path" accept="image/*"
                                        class="block w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 file:transition-colors border-2 border-gray-200 rounded-xl p-2" />
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Format yang didukung: JPG, PNG, GIF (Max: 2MB)
                                </p>
                                @error('profile_path')
                                    <p class="text-sm text-red-600 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-indigo-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-indigo-800">Hampir selesai!</p>
                                        <p class="text-xs text-indigo-600">Anda dapat melewati langkah ini dan
                                            menambahkan foto nanti.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6">
                        <button type="button" id="prev-btn"
                            class="btn-secondary px-6 py-3 rounded-xl font-semibold text-sm hidden"
                            onclick="previousStep()">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </span>
                        </button>

                        <button type="button" id="next-btn"
                            class="btn-primary ml-auto px-6 py-3 rounded-xl font-semibold text-sm text-white"
                            onclick="nextStep()">
                            <span class="flex items-center">
                                Selanjutnya
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </button>

                        <button type="submit" id="submit-btn"
                            class="btn-primary ml-auto px-6 py-3 rounded-xl font-semibold text-sm text-white hidden">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Akun
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Sign in link -->
                <div class="mt-6 text-center border-t border-gray-200 pt-4">
                    <p class="text-sm text-gray-600">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text hover:from-indigo-700 hover:to-purple-700 transition-all duration-300">
                            Masuk Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

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

        // Step navigation functions
        function nextStep() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    document.getElementById(`step-${currentStep}`).classList.remove('active');
                    currentStep++;
                    document.getElementById(`step-${currentStep}`).classList.add('active');
                    updateStepper();
                    updateButtons();
                }
            }
        }

        function previousStep() {
            if (currentStep > 1) {
                document.getElementById(`step-${currentStep}`).classList.remove('active');
                currentStep--;
                document.getElementById(`step-${currentStep}`).classList.add('active');
                updateStepper();
                updateButtons();
            }
        }

        function updateStepper() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('stepper-progress').style.width = progress + '%';

            let stepText = '';
            switch (currentStep) {
                case 1:
                    stepText = 'Langkah 1 dari 3 - Informasi Akun';
                    break;
                case 2:
                    stepText = 'Langkah 2 dari 3 - Informasi Pribadi';
                    break;
                case 3:
                    stepText = 'Langkah 3 dari 3 - Foto Profil';
                    break;
            }
            document.getElementById('step-text').textContent = stepText;
        }

        function updateButtons() {
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');

            if (currentStep === 1) {
                prevBtn.classList.add('hidden');
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            } else if (currentStep === totalSteps) {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            }
        }

        function validateCurrentStep() {
            let isValid = true;
            const currentStepEl = document.getElementById(`step-${currentStep}`);
            const requiredFields = currentStepEl.querySelectorAll('input[required], textarea[required]');

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            // Additional validation for step 1 (password confirmation)
            if (currentStep === 1) {
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;

                if (password !== passwordConfirmation) {
                    document.getElementById('password_confirmation').classList.add('border-red-500');
                    document.getElementById('password-match').classList.remove('hidden');
                    isValid = false;
                } else {
                    document.getElementById('password_confirmation').classList.remove('border-red-500');
                    document.getElementById('password-match').classList.add('hidden');
                }
            }

            if (!isValid) {
                // Show error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'text-sm text-red-600 bg-red-50 border border-red-200 p-3 rounded-xl mb-4';
                errorDiv.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Mohon lengkapi semua field yang wajib diisi</span>
                    </div>
                `;

                // Remove existing error if any
                const existingError = currentStepEl.querySelector('.text-red-600.bg-red-50');
                if (existingError) {
                    existingError.remove();
                }

                currentStepEl.insertBefore(errorDiv, currentStepEl.firstChild);

                // Auto remove error after 3 seconds
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.remove();
                    }
                }, 3000);
            }

            return isValid;
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
                `text-xs mt-1 ${strength >= 75 ? 'text-green-600' : strength >= 50 ? 'text-yellow-600' : 'text-gray-500'}`;
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

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateButtons();
            updateStepper();
        });
    </script>
</body>

</html>
