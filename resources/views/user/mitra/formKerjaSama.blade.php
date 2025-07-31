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
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full bg-gray-50">
    <div class="flex min-h-full items-center justify-center px-4 py-12 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Logo and Header -->
                <div class="text-center mb-8">
                    <img class="mx-auto h-24 w-auto" src="{{ asset('img/logo.png') }}" alt="yaguwipa logo" />
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Daftar Kerja Sama</h2>
                    <p class="mt-2 text-sm text-gray-600">Bersama kita bisa membuat perubahan yang lebih baik</p>
                </div>
                <!-- Form -->
                <form action="{{ route('kerja-sama.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div x-data="{ kategoriDipilih: '' }" x-cloak>
                        <label for="id_kategori_kerja_sama" class="block text-sm font-medium text-gray-700">Kategori
                            Kerja Sama</label>
                        <select name="id_kategori_kerja_sama" id="id_kategori_kerja_sama" required
                            x-model="kategoriDipilih"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($kategoriKerjaSama as $kategori)
                                <option value="{{ $kategori->id_kategori_kerja_sama }}">{{ $kategori->nama }}</option>
                            @endforeach
                            <option value="other">Lainnya</option>
                        </select>

                        <div x-show="kategoriDipilih === 'other'" x-transition class="mt-2">
                            <label for="kategori_baru" class="block text-sm font-medium text-gray-700">Tulis Kategori
                                Baru</label>
                            <input type="text" name="kategori_baru" id="kategori_baru"
                                placeholder="Masukkan kategori kerja sama baru"
                                x-bind:required="kategoriDipilih === 'other'"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>


                    <div>
                        <label for="id_program" class="block text-sm font-medium text-gray-700">Program</label>
                        <select name="id_program" id="id_program" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @foreach ($programs as $program)
                                <option value="{{ $program->id_program }}">{{ $program->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal
                                Mulai</label>
                            <input type="date" name="tanggal_mulai" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal
                                Selesai</label>
                            <input type="date" name="tanggal_selesai" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="file_penunjang" class="block text-sm font-medium text-gray-700">File
                            Penunjang</label>
                        <input type="file" name="file_penunjang[]" id="file_penunjang" multiple
                            class="mt-1 block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        <p class="mt-1 text-sm text-gray-500">Kamu dapat mengunggah lebih dari satu file. Format yang
                            diizinkan: PDF, DOCX, JPG, PNG. Maks 2MB per file.</p>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Ajukan Kerja Sama
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.getElementById('file_penunjang').addEventListener('change', function(e) {
            const fileList = Array.from(e.target.files).map(f => f.name).join(', ');
            alert("File yang dipilih:\n" + fileList);
        });
    </script>
</body>

</html>
