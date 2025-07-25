<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 min-h-screen py-12">
    <!-- Modal Overlay -->
    <div id="modal-overlay" class="fixed inset-0 bg-gray-50 z-50 flex items-center justify-center p-4">
        <!-- Modal Content -->
        <div
            class="bg-white rounded-xl shadow-sm max-w-2xl w-full mx-auto transform transition-all duration-300 scale-100">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-semi bold tracking-tight text-gray-600">Pilih Jenis Registrasi</h2>
                    <p class="mt-2 text-sm text-gray-600">Pilih salah satu kategori untuk melanjutkan pendaftaran</p>
                </div>
                <div class="grid md:grid-cols-2 gap-6 ">
                    <!-- Mitra Card -->
                    <div class="card-selector border-2 border-gray-100 rounded-xl p-6 cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition-all duration-200 hover:scale-102"
                        onclick="selectCard('mitra')" id="mitra-card">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Mitra</h3>
                            <p class="text-gray-600 text-sm">Daftarkan organisasi atau perusahaan Anda sebagai mitra</p>
                        </div>
                    </div>
                    <!-- Donatur Card -->
                    <div class="card-selector rounded-xl border-2 border-gray-100 p-6 cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition-all duration-200 hover:scale-102"
                        onclick="selectCard('donatur')" id="donatur-card">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Donatur</h3>
                            <p class="text-gray-600 text-sm">Daftarkan diri Anda sebagai donatur individual</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4">
        <!-- Registration Form -->
        <div class="bg-white rounded-xl shadow-sm p-8" id="registration-form" style="display: none;">
            <div class="flex min-h-full items-center justify-center p-6 lg:px-8">
                <div class="w-full">
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-semibold tracking-tight text-gray-600" id="form-title"></h2>
                        <p class="mt-2 text-sm text-gray-600" id="form-subtitle"></p>
                    </div>

                    <form action="{{ route('add.dataUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id_user" id="id_user" value="{{ $user->id_user }}" hidden>
                        <input type="text" name="role" id="role" value="" hidden>
                        <!-- Nama - selalu tampil -->
                        <div class="mt-4">
                            <!-- Label di luar kotak -->
                            <p class="text-sm font-semibold text-gray-700 mb-2">Upload Foto Profil <span
                                    class="text-gray-400"> (Opsional)</span></p>

                            <label
                                class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <!-- Ini yang akan berubah -->
                                    <span id="upload-text" class="font-medium text-gray-600">
                                        Drag atau drop untuk memilih file
                                    </span>
                                </span>
                                <input type="file" name="profile_path" id="profile_path" class="hidden"
                                    onchange="updateLabelText(event)">
                            </label>

                            <p class="text-[12px] text-gray-400 mt-1">Format: JPEG, JPG, PNG • Max: 2MB
                            </p>
                        </div>
                        <div class="mt-4">
                            <label for="nama" class="block text-sm font-medium text-gray-900 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" name="nama" id="nama" autocomplete="nama" required
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan nama" />
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- No Telepon - selalu tampil -->
                            <div class="mt-4">
                                <label for="no_tlp" class="block text-sm font-medium text-gray-900 mb-2">No
                                    Telepon</label>
                                <div class="relative">
                                    <input type="text" name="no_tlp" id="no_tlp" autocomplete="no_tlp" required
                                        class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan no telepon" />
                                </div>
                            </div>

                            <!-- Email - selalu tampil -->
                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email <span
                                        class="text-gray-400" id="email-opsional"> (Opsional)</span></label>
                                <div class="relative">
                                    <input type="email" name="email" id="email" autocomplete="email"
                                        class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan email" />
                                </div>
                            </div>
                        </div>
                        <!-- Alamat - selalu tampil -->
                        <div class="mt-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-900 mb-2">Alamat<span
                                    class="text-gray-400" id="alamat-opsional"> (Opsional)</span></label>
                            <div class="relative">
                                <textarea
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                    name="alamat" id="alamat" cols="30" rows="3" placeholder="Masukkan alamat"></textarea>
                            </div>
                        </div>
                        <!-- Fields khusus Mitra -->
                        <div id="mitra-fields" style="display: none;">
                            <!-- Website - hanya tampil di mitra -->
                            <div class="mt-4">
                                <label for="website"
                                    class="block text-sm font-medium text-gray-900 mb-2">Website<span
                                        class="text-gray-400" id="website-opsional"> (Opsional)</span></label>
                                <div class="relative">
                                    <input type="url" name="website" id="website" autocomplete="website"
                                        class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan alamat website" />
                                </div>
                            </div>
                            <!-- Penanggung Jawab dan Jabatan -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="mt-4">
                                    <label for="penanggung_jawab"
                                        class="block text-sm font-medium text-gray-900 mb-2">Penanggung Jawab</label>
                                    <div class="relative">
                                        <input type="text" name="penanggung_jawab" id="penanggung_jawab"
                                            autocomplete="penanggung_jawab"
                                            class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan penanggung jawab" />
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="jabatan_penanggung_jawab"
                                        class="block text-sm font-medium text-gray-900 mb-2">Jabatan Penanggung
                                        Jawab</label>
                                    <div class="relative">
                                        <input type="text" name="jabatan_penanggung_jawab"
                                            id="jabatan_penanggung_jawab" autocomplete="jabatan_penanggung_jawab"
                                            class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border-gray-300 placeholder:text-gray-400 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan jabatan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit" id="submit-btn"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateLabelText(event) {
            const input = event.target;
            const textSpan = document.getElementById('upload-text');

            if (input.files.length > 0) {
                const fileName = input.files[0].name;
                textSpan.innerHTML = `File dipilih: <span class="text-green-600 font-medium">${fileName}</span>`;
            }
        }


        let selectedType = '';

        function selectCard(type) {
            selectedType = type;
            document.getElementById('role').value = type;

            // Hide modal with animation
            const modal = document.getElementById('modal-overlay');
            const modalContent = modal.querySelector('.bg-white');

            modalContent.style.transform = 'scale(0.9)';
            modalContent.style.opacity = '0';

            setTimeout(() => {
                modal.style.display = 'none';
                // Show form
                document.getElementById('registration-form').style.display = 'block';

                // Add entrance animation for form
                const form = document.getElementById('registration-form');
                form.style.opacity = '0';
                form.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    form.style.transition = 'all 0.3s ease-out';
                    form.style.opacity = '1';
                    form.style.transform = 'translateY(0)';
                }, 50);
            }, 300);

            // Update form based on selection
            if (type === 'mitra') {
                document.getElementById('form-title').textContent = 'Daftarkan Mitra Anda';
                document.getElementById('form-subtitle').textContent =
                    'Bergabunglah sebagai mitra dan mulai berkolaborasi dengan kami';
                document.getElementById('mitra-fields').style.display = 'block';
                document.getElementById('submit-btn').textContent = 'Daftar sebagai Mitra';
                // Set required for mitra fields
                // document.getElementById('website').required = true;
                document.getElementById('penanggung_jawab').required = true;
                document.getElementById('jabatan_penanggung_jawab').required = true;

                document.getElementById('website-opsional').textContent = ' (Opsional)';
                document.getElementById('email-opsional').textContent = ''; // Email jadi wajib
                document.getElementById('alamat-opsional').textContent = ''; // Alamat jadi wajib

            } else {
                document.getElementById('form-title').textContent = 'Daftarkan Diri Anda';
                document.getElementById('form-subtitle').textContent =
                    'Bergabunglah sebagai donatur dan mulai berbagi kebaikan';
                document.getElementById('mitra-fields').style.display = 'none';
                document.getElementById('submit-btn').textContent = 'Daftar sebagai Donatur';
                // Remove required for mitra fields
                document.getElementById('website').required = false;
                document.getElementById('penanggung_jawab').required = false;
                document.getElementById('jabatan_penanggung_jawab').required = false;

                // Remove required for donatur optional fields
                document.getElementById('alamat').required = false;
                document.getElementById('email').required = false;

                document.getElementById('email-opsional').textContent = ' (Opsional)'; // Email jadi wajib
                document.getElementById('alamat-opsional').textContent = ' (Opsional)'; // Alamat jadi wajib

            }
        }

        // Optional: Close modal when clicking outside
        document.getElementById('modal-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                // Uncomment the following lines if you want to allow closing by clicking outside
                // this.style.display = 'none';
                // document.getElementById('registration-form').style.display = 'block';
            }
        });
    </script>
</body>

</html>
