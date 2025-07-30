@php
    $user = auth()->user();
@endphp
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
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Daftar Mitra</h2>
                    <p class="mt-2 text-sm text-gray-600">Bersama kita bisa membuat perubahan yang lebih baik</p>
                </div>
                <!-- Form -->
                <form class="space-y-6" action="{{ route('add.dataMitra', $user->id_user) }}" method="POST">
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

                    {{-- Email --}}
                    @if (!$user->email)
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="block w-full rounded-lg px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="contoh@email.com" />
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif



                    {{-- Website --}}
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-900 mb-2">Website
                        </label>
                        <input type="url" name="website" id="website" value="{{ old('website') }}"
                            class="block w-full rounded-lg px-4 py-3 border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="https://www.google.com" />
                        @error('website')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="mt-4">
                            <label for="penanggung_jawab"
                                class="block text-sm font-medium text-gray-900 mb-2">Penanggung Jawab</label>
                            <div class="relative">
                                <input type="text" name="penanggung_jawab" id="penanggung_jawab" required
                                    autocomplete="penanggung_jawab"
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan penanggung jawab" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="jabatan_penanggung_jawab"
                                class="block text-sm font-medium text-gray-900 mb-2">Jabatan</label>
                            <div class="relative">
                                <input type="text" name="jabatan_penanggung_jawab" id="jabatan_penanggung_jawab"
                                    required autocomplete="jabatan_penanggung_jawab"
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan jabatan" />
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div>
                        <button type="submit"
                            class="w-full justify-center rounded-lg bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none transition duration-200">
                            Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
