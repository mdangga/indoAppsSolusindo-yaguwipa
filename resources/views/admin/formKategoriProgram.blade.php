<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Tailwind + JS Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>

<body class="bg-gray-50">
    <x-admin.navbar />
    <x-admin.sidebar />
    <main class="p-6 sm:ml-64 pt-24 transition-all ">

        <div class="w-full bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                {{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
            </h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php $isEdit = isset($kategori); @endphp

            <form
                action="{{ $isEdit ? route('kategoriProgram.update', $kategori->id_kategori_program) : route('kategoriProgram.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif
                <div class="mt-4">
                    <label for="nama" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama ?? '') }}"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" />
                    @error('nama')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
                {{-- Tombol Submit --}}
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
