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

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Quill Snow Theme --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    {{-- Highlight.js Theme --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />

    {{-- KaTeX CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

</head>

<body class="bg-gray-50">
    <x-admin.navbar />
    <x-admin.sidebar />
    <main class="p-6 sm:ml-64 pt-24 transition-all ">
        <div class="w-full bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                {{ isset($program) ? 'Edit Program' : 'Tambah Program Baru' }}
            </h1>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <strong class="font-medium">Terjadi kesalahan:</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    <strong class="font-medium">Berhasil!</strong>
                    <p class="mt-1">{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST"
                action="{{ isset($program) ? route('program.update', $program->id_program) : route('program.store') }}"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if (isset($program))
                    @method('PUT')
                @endif

                <!-- Kategori Program -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label for="id_kategori_program" class="block mb-2 text-sm font-medium text-gray-900">
                            Kategori Program <span class="text-red-500">*</span>
                        </label>
                        <select name="id_kategori_program" id="id_kategori_program"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoriProgram as $kategori)
                                <option value="{{ $kategori->id_kategori_program }}"
                                    {{ old('id_kategori_program', $program->id_kategori_program ?? '') == $kategori->id_kategori_program ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_program')
                            <small class="text-red-600 mt-1 block">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nama Program -->
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Program <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama"
                            value="{{ old('nama', $program->nama ?? '') }}" placeholder="Masukkan nama program"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            required>
                        @error('nama')
                            <small class="text-red-600 mt-1 block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Deskripsi Program -->
                <div>
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">
                        Deskripsi Program
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Masukkan deskripsi program"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">{{ old('deskripsi', $program->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <small class="text-red-600 mt-1 block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                @if (!empty($program) && !empty($program->image_path))
                    {{-- Mode Edit: Tampilkan gambar --}}
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        {{-- Kolom 1 dan 2: Upload + Caption --}}
                        <div class="col-span-2 grid grid-rows-2 gap-4">
                            {{-- Upload Gambar --}}
                            <div>
                                <label for="image_path" class="block mb-2 text-sm font-medium text-gray-900">
                                    Upload Gambar
                                </label>
                                <input type="file" name="image_path" id="image_path" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
                                @error('image_path')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Caption --}}
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                                    Status Program <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="aktif"
                                        {{ old('status', $program->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="nonaktif"
                                        {{ old('status', $program->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                                        Non-Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-red-600 mt-1 block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Kolom 3: Gambar --}}
                        <div class="row-span-2 flex justify-center items-center h-full">
                            <div class="h-full flex items-center">
                                <img src="{{ asset('storage/' . $program->image_path) }}" alt="Current Image"
                                    class="max-h-32 rounded shadow">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        {{-- Upload Gambar --}}
                        <div class="h-full flex flex-col">
                            <label for="image_path" class="block mb-2 text-sm font-medium text-gray-900">
                                Upload Gambar
                            </label>
                            <input type="file" name="image_path" id="image_path" accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
                            <p class="mt-1 text-sm text-gray-500">
                                PNG, JPG, JPEG (Max. 2MB)
                                @if (isset($program) && $program->image_path)
                                    - Kosongkan jika tidak ingin mengubah gambar
                                @endif
                            </p>
                            @error('image_path')
                                <small class="text-red-600 mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="h-full flex flex-col">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                                Status Program <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                <option value="aktif"
                                    {{ old('status', $program->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="nonaktif"
                                    {{ old('status', $program->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                                    Non-Aktif
                                </option>
                            </select>
                            @error('status')
                                <small class="text-red-600 mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                @endif
                <!-- Institusi Terlibat -->
                <div>
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Institusi Terlibat</h2>
                    <div id="institusi-wrapper">
                        @if (isset($program) && $program->institusiTerlibat && count($program->institusiTerlibat) > 0)
                            @foreach ($program->institusiTerlibat as $index => $institusi)
                                <div class="institusi-group bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-center mb-3">
                                        <h3 class="text-md font-medium text-gray-700">Institusi {{ $index + 1 }}
                                        </h3>
                                        <button type="button" onclick="hapusInstitusi(this)"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium {{ $index == 0 && count($program->institusiTerlibat) == 1 ? 'hidden' : '' }}">
                                            Hapus
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-700">Pilih
                                                Institusi</label>
                                            <select name="institusi[{{ $index }}][id]"
                                                class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                                <option value="">-- Pilih Institusi --</option>
                                                @foreach ($institusiList as $ins)
                                                    <option value="{{ $ins->id_institusi }}"
                                                        {{ old('institusi.' . $index . '.id', $institusi->id_institusi ?? '') == $ins->id_institusi ? 'selected' : '' }}>
                                                        {{ $ins->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-700">Atau Tambah
                                                Nama
                                                Baru</label>
                                            <input type="text" name="institusi[{{ $index }}][nama]"
                                                value="{{ old('institusi.' . $index . '.nama', $institusi->nama_custom ?? '') }}"
                                                placeholder="Nama institusi baru"
                                                class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                                {{ old('institusi.' . $index . '.id', $institusi->id_institusi ?? '') ? 'disabled style=opacity:0.5' : '' }}>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                                            <input type="text" name="institusi[{{ $index }}][alamat]"
                                                value="{{ old('institusi.' . $index . '.alamat', $institusi->alamat ?? '') }}"
                                                placeholder="Alamat institusi"
                                                class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                        </div>

                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-700">Website</label>
                                            <input type="url" name="institusi[{{ $index }}][website]"
                                                value="{{ old('institusi.' . $index . '.website', $institusi->website ?? '') }}"
                                                placeholder="https://website.com"
                                                class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                        </div>
                                    </div>

                                    <!-- Logo Institusi -->
                                    <div class="mt-4">
                                        <label class="block mb-1 text-sm font-medium text-gray-700">
                                            Logo Institusi
                                        </label>
                                        <div class="flex items-center gap-4">
                                            <div class="flex-1">
                                                <input type="file" name="institusi[{{ $index }}][logo]"
                                                    accept="image/*"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                                <p class="mt-1 text-sm text-gray-500">
                                                    PNG, JPG, JPEG (Max. 2MB)
                                                </p>
                                            </div>
                                            @if ($institusi->logo_path)
                                                <div class="w-16 h-16">
                                                    <img src="{{ asset('storage/' . $institusi->logo_path) }}"
                                                        alt="Logo Institusi" class="w-full h-full object-contain">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="block mb-1 text-sm font-medium text-gray-700">
                                            Tanggal Mulai <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" name="institusi[{{ $index }}][tanggal]"
                                            value="{{ old('institusi.' . $index . '.tanggal', $institusi->pivot->tanggal ? date('Y-m-d', strtotime($institusi->pivot->tanggal)) : '') }}"
                                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                            required>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="institusi-group bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-md font-medium text-gray-700">Institusi 1</h3>
                                    <button type="button" onclick="hapusInstitusi(this)"
                                        class="text-red-600 hover:text-red-800 text-sm font-medium hidden">
                                        Hapus
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Pilih
                                            Institusi</label>
                                        <select name="institusi[0][id]"
                                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                            <option value="">-- Pilih Institusi --</option>
                                            @foreach ($institusiList as $ins)
                                                <option value="{{ $ins->id_institusi }}">{{ $ins->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Atau Tambah Nama
                                            Baru</label>
                                        <input type="text" name="institusi[0][nama]"
                                            placeholder="Nama institusi baru"
                                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                                        <input type="text" name="institusi[0][alamat]"
                                            placeholder="Alamat institusi"
                                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Website</label>
                                        <input type="url" name="institusi[0][website]"
                                            placeholder="https://website.com"
                                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    </div>
                                </div>

                                <!-- Logo Institusi -->
                                <div class="mt-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">
                                        Logo Institusi
                                    </label>
                                    <input type="file" name="institusi[0][logo]" accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                    <p class="mt-1 text-sm text-gray-500">
                                        PNG, JPG, JPEG (Max. 2MB)
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">
                                        Tanggal Mulai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="institusi[0][tanggal]"
                                        class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                        required>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="button" onclick="tambahInstitusi()"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Institusi
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.program') }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                            {{ isset($program) ? 'Update Program' : 'Simpan Program' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        // Initialize index based on existing institusi count
        let index = {{ isset($program) && $program->institusi ? count($program->institusi) : 1 }};

        // Available institusi options for dynamic creation
        const institusiOptions = `
            <option value="">-- Pilih Institusi --</option>
            @foreach ($institusiList as $ins)
                <option value="{{ $ins->id_institusi }}">{{ $ins->nama }}</option>
            @endforeach
        `;

        function tambahInstitusi() {
            const wrapper = document.getElementById('institusi-wrapper');
            const div = document.createElement('div');
            div.classList.add('institusi-group', 'bg-gray-50', 'border', 'border-gray-200', 'rounded-lg', 'p-4', 'mb-4');
            div.innerHTML = `
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-md font-medium text-gray-700">Institusi ${index + 1}</h3>
                    <button type="button" onclick="hapusInstitusi(this)" 
                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                        Hapus
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Pilih Institusi</label>
                        <select name="institusi[${index}][id]" class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            ${institusiOptions}
                        </select>
                    </div>
                    
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Atau Tambah Nama Baru</label>
                        <input type="text" name="institusi[${index}][nama]" placeholder="Nama institusi baru"
                            class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" name="institusi[${index}][alamat]" placeholder="Alamat institusi"
                        class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        required>
                </div>
            
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Website <span class="text-red-500">*</span></label>
                    <input type="url" name="institusi[${index}][website]" placeholder="https://website.com"
                        class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        required>
                    </div>
                </div>
        
                <!-- Logo Institusi -->
                <div class="mt-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Logo Institusi
                        <span class="text-red-500 logo-required" style="display:none">*</span>
                    </label>
                    <input type="file" name="institusi[${index}][logo]" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        <p class="mt-1 text-sm text-gray-500">
                            PNG, JPG, JPEG (Max. 2MB)
                        </p>
                </div>
                
                <div class="mt-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="institusi[${index}][tanggal]" 
                        class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5" 
                        required>
                </div>
            `;
            const select = div.querySelector('select[name*="[id]"]');
            const logoRequired = div.querySelector('.logo-required');
            const logoInput = div.querySelector('input[name*="[logo]"]');

            select.addEventListener('change', function() {
                if (this.value) {
                    logoInput.removeAttribute('required');
                    logoRequired.style.display = 'none';
                } else {
                    logoInput.setAttribute('required', 'required');
                    logoRequired.style.display = 'inline';
                }
            });
            wrapper.appendChild(div);
            index++;

            // Show delete button for first institusi if more than one exists
            updateDeleteButtons();
        }

        function hapusInstitusi(button) {
            const institusiGroup = button.closest('.institusi-group');
            institusiGroup.remove();

            // Re-index the remaining institusi
            reIndexInstitusi();
            updateDeleteButtons();
        }

        function reIndexInstitusi() {
            const institusiGroups = document.querySelectorAll('.institusi-group');
            institusiGroups.forEach((group, newIndex) => {
                // Update header
                const header = group.querySelector('h3');
                header.textContent = `Institusi ${newIndex + 1}`;

                // Update all input names
                const inputs = group.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('institusi[')) {
                        const newName = name.replace(/institusi\[\d+\]/, `institusi[${newIndex}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });

            // Update global index
            index = institusiGroups.length;
        }

        function updateDeleteButtons() {
            const institusiGroups = document.querySelectorAll('.institusi-group');
            const deleteButtons = document.querySelectorAll('.institusi-group button[onclick*="hapusInstitusi"]');

            deleteButtons.forEach(button => {
                if (institusiGroups.length > 1) {
                    button.classList.remove('hidden');
                } else {
                    button.classList.add('hidden');
                }
            });
        }

        // Validate form before submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const institusiGroups = document.querySelectorAll('.institusi-group');
            let hasValidInstitusi = false;
            let isValid = true;
            const errorMessages = [];

            institusiGroups.forEach((group, index) => {
                const selectValue = group.querySelector('select').value;
                const namaInput = group.querySelector('input[name*="[nama]"]');
                const alamatInput = group.querySelector('input[name*="[alamat]"]');
                const websiteInput = group.querySelector('input[name*="[website]"]');
                const logoInput = group.querySelector('input[name*="[logo]"]');
                const existingLogo = group.querySelector('img');

                if (selectValue) {
                    hasValidInstitusi = true;
                } else {
                    if (!namaInput.value.trim()) {
                        errorMessages.push(`Nama institusi ke-${index + 1} wajib diisi`);
                        isValid = false;
                    }
                    if (!alamatInput.value.trim()) {
                        errorMessages.push(`Alamat institusi ke-${index + 1} wajib diisi`);
                        isValid = false;
                    }
                    if (!websiteInput.value.trim()) {
                        errorMessages.push(`Website institusi ke-${index + 1} wajib diisi`);
                        isValid = false;
                    }
                    if (!logoInput.files[0] && !existingLogo) {
                        errorMessages.push(`Logo institusi ke-${index + 1} wajib diupload`);
                        isValid = false;
                    }

                    if (namaInput.value.trim()) {
                        hasValidInstitusi = true;
                    }
                }
            });

            if (!hasValidInstitusi) {
                errorMessages.push(
                    'Minimal satu institusi harus diisi (pilih dari dropdown atau tambah nama baru)');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert('Terjadi kesalahan:\n\n' + errorMessages.join('\n'));
            }
        });

        // Auto-hide/show institusi nama input based on select
        document.addEventListener('change', function(e) {
            if (e.target.matches('select[name*="institusi"][name*="[id]"]')) {
                const group = e.target.closest('.institusi-group');
                const namaInput = group.querySelector('input[name*="[nama]"]');
                const alamatInput = group.querySelector('input[name*="[alamat]"]');
                const websiteInput = group.querySelector('input[name*="[website]"]');

                if (e.target.value) {
                    namaInput.value = '';
                    namaInput.setAttribute('disabled', 'disabled');
                    namaInput.style.opacity = '0.5';
                    alamatInput.value = '';
                    alamatInput.setAttribute('disabled', 'disabled');
                    alamatInput.style.opacity = '0.5';
                    websiteInput.value = '';
                    websiteInput.setAttribute('disabled', 'disabled');
                    websiteInput.style.opacity = '0.5';
                } else {
                    namaInput.removeAttribute('disabled');
                    namaInput.style.opacity = '1';
                    alamatInput.removeAttribute('disabled');
                    alamatInput.style.opacity = '1';
                    websiteInput.removeAttribute('disabled');
                    websiteInput.style.opacity = '1';
                }
            }
        });

        // Initialize form state on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state for existing institusi
            document.querySelectorAll('select[name*="institusi"][name*="[id]"]').forEach(select => {
                const group = select.closest('.institusi-group');
                const namaInput = group.querySelector('input[name*="[nama]"]');
                const alamatInput = group.querySelector('input[name*="[alamat]"]');
                const websiteInput = group.querySelector('input[name*="[website]"]');

                if (select.value) {
                    namaInput.setAttribute('disabled', 'disabled');
                    namaInput.style.opacity = '0.5';
                    alamatInput.setAttribute('disabled', 'disabled');
                    alamatInput.style.opacity = '0.5';
                    websiteInput.setAttribute('disabled', 'disabled');
                    websiteInput.style.opacity = '0.5';
                }
            });

            updateDeleteButtons();
        });
    </script>
</body>

</html>
