<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel - Register</title>
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
                    <img class="mx-auto h-24 w-auto" src="{{ asset('img/logo.png') }}" alt="Your Company" />
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Buat Akun Anda</h2>
                    <p class="mt-2 text-sm text-gray-600">Bersama kita bisa membuat perubahan yang lebih baik</p>
                </div>

                <!-- Form -->
                <form class="space-y-6" action="/register" method="POST">
                    @csrf
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-900 mb-2">Username</label>
                        <div class="relative">
                            <input type="text" name="username" id="username" autocomplete="username" required
                                class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan username" />
                        </div>
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
                                    onclick="togglePassword('password')">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
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
                                placeholder="Confirm your password" />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">

                                <button type="button" class="text-gray-400 hover:text-gray-600 cursor-pointer"
                                    onclick="togglePassword('password_confirmation')">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>

                            </div>
                        </div>
                        <div id="password-match" class="mt-1 text-xs hidden">
                            <span class="text-red-500">Passwords do not match</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="group relative flex w-full justify-center rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline  focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 hover:shadow-lg cursor-pointer">
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

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
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
    </script>
</body>

</html>
