@php
    $user = auth()->user();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->logo) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .file-upload-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-upload-container input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            min-height: 60px;
        }

        .file-upload-label:hover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }

        .file-upload-label.has-file {
            border-color: #10b981;
            background-color: #ecfdf5;
            border-style: solid;
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .shadow-custom {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-border {
            background: linear-gradient(white, white) padding-box;
            border-radius: 16px;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="flex min-h-full items-center justify-center px-4 py-8 lg:px-8">
        <div class="w-full max-w-6xl">
            <!-- Card Container -->
            <div class="gradient-border border-gray-100 border-2 shadow-custom p-8 lg:p-10 animate-fade-in">
                <!-- Logo and Header -->
                <div class="text-center mb-10">
                    <div class="inline-block p-3 bg-gradient-to-r from-blue-50 to-indigo-100 rounded-full mb-6">
                        <img class="h-16 w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                            alt="yaguwipa logo" />
                    </div>
                    <h2
                        class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent mb-3">
                        Daftar Kerja Sama
                    </h2>
                    <p class="text-md text-gray-600 font-medium">Bersama kita bisa membuat perubahan yang lebih baik</p>
                </div>

                <!-- Form -->
                <form action="{{ route('kerja-sama.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf

                    <!-- Main Form Grid - Split into 2 columns -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Kategori Kerja Sama -->
                            <div x-data="{ kategoriDipilih: '' }" x-cloak class="space-y-2">
                                <label for="id_kategori_kerja_sama"
                                    class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kategori Kerja Sama
                                </label>
                                <select name="id_kategori_kerja_sama" id="id_kategori_kerja_sama" required
                                    x-model="kategoriDipilih"
                                    class="w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3 text-gray-900">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategoriKerjaSama as $kategori)
                                        <option value="{{ $kategori->id_kategori_kerja_sama }}">{{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                    <option value="other">Lainnya</option>
                                </select>

                                <div x-show="kategoriDipilih === 'other'"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100" class="mt-4">
                                    <label for="kategori_baru" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tulis Kategori Baru
                                    </label>
                                    <input type="text" name="kategori_baru" id="kategori_baru"
                                        placeholder="Masukkan kategori kerja sama baru"
                                        x-bind:required="kategoriDipilih === 'other'"
                                        class="w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3">
                                </div>
                                @error('id_kategori_kerja_sama')
                                    <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Program -->
                            <div class="space-y-2">
                                <label for="id_program"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Program</label>
                                <select name="id_program" id="id_program" required
                                    class="w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3 text-gray-900">
                                    <option value="" selected disabled>Pilih Program</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id_program }}">{{ $program->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_program')
                                    <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" required
                                        class="w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3">
                                    @error('tanggal_mulai')
                                        <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Selesai
                                    </label>
                                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" required
                                        class="w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3">
                                    @error('tanggal_selesai')
                                        <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Keterangan -->
                            <div class="space-y-2">
                                <label for="keterangan"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="9" required
                                    placeholder="Jelaskan detail kerja sama yang diinginkan..."
                                    class="w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 p-3 resize-none"></textarea>
                                @error('keterangan')
                                    <p class="text-sm text-red-600 mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- File Uploads Section -->
                    <div class="space-y-6 border-t-2 border-gray-200 pt-8">
                        <h3 class="text-xl font-bold text-gray-800 text-center mb-6">
                            Dokumen Penunjang
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                            <!-- Profil Lembaga -->
                            <div class="space-y-2" x-data="{ fileName: '' }">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Profil Lembaga
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" name="file_penunjang[profil_lembaga]" id="profil_lembaga"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                    <label for="profil_lembaga" class="file-upload-label"
                                        :class="{ 'has-file': fileName }">
                                        <div class="text-center">
                                            <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-xs font-medium text-center"
                                                x-text="fileName || 'Pilih File Profil'"></span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Proposal Kemitraan -->
                            <div class="space-y-2" x-data="{ fileName: '' }">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Proposal Kemitraan/Program
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" name="file_penunjang[proposal_kemitraan]" id="proposal_kemitraan"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                    <label for="proposal_kemitraan" class="file-upload-label"
                                        :class="{ 'has-file': fileName }">
                                        <div class="text-center">
                                            <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-xs font-medium text-center"
                                                x-text="fileName || 'Pilih File Proposal'"></span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Surat Permohonan -->
                            <div class="space-y-2" x-data="{ fileName: '' }">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Surat Permohonan
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" name="file_penunjang[surat_permohonan]" id="surat_permohonan"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                    <label for="surat_permohonan" class="file-upload-label"
                                        :class="{ 'has-file': fileName }">
                                        <div class="text-center">
                                            <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-xs font-medium text-center"
                                                x-text="fileName || 'Pilih File Surat'"></span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Dokumen Legalitas -->
                            <div class="space-y-2" x-data="{ fileName: '' }">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Dokumen Legalitas <span class="text-gray-500 text-xs">(Opsional)</span>
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" name="file_penunjang[dokumen_legalitas]" id="dokumen_legalitas"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                    <label for="dokumen_legalitas" class="file-upload-label"
                                        :class="{ 'has-file': fileName }">
                                        <div class="text-center">
                                            <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                            <span class="text-xs font-medium text-center"
                                                x-text="fileName || 'Pilih File Legalitas'"></span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 max-w-2xl mx-auto">
                            <p class="text-sm text-blue-700 text-center">
                                <strong>Catatan:</strong> Format file yang diterima: PDF, DOCX. Maksimal
                                ukuran per file adalah 2MB.
                            </p>
                        </div>

                        @error('file_penunjang')
                            <p class="text-sm text-red-600 mt-2 font-medium text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full max-w-md mx-auto flex justify-center items-center py-4 px-6 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" class="w-5 h-5 mr-3">
                                <g fill="none">
                                    <path
                                        d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                    <path fill="currentColor"
                                        d="m21.433 4.861l-6 15.5a1 1 0 0 1-1.624.362l-3.382-3.235l-2.074 2.073a.5.5 0 0 1-.853-.354v-4.519L2.309 9.723a1 1 0 0 1 .442-1.691l17.5-4.5a1 1 0 0 1 1.181 1.329ZM19 6.001L8.032 13.152l1.735 1.66L19 6Z" />
                                </g>
                            </svg>
                            Ajukan Kerja Sama
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // File size validation (2MB = 2 * 1024 * 1024 bytes)
        const maxFileSize = 2 * 1024 * 1024;

        function validateFileSize(input) {
            if (input.files[0]) {
                if (input.files[0].size > maxFileSize) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB per file.');
                    input.value = '';
                    return false;
                }
            }
            return true;
        }

        // Add file size validation to all file inputs
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                validateFileSize(e.target);
            });
        });

        // Form submission validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            let hasError = false;

            fileInputs.forEach(input => {
                if (input.files[0] && input.files[0].size > maxFileSize) {
                    hasError = true;
                }
            });

            if (hasError) {
                e.preventDefault();
                alert('Ada file yang melebihi batas ukuran 2MB. Silakan pilih file yang lebih kecil.');
            }
        });
    </script>
</body>

</html>
