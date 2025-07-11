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
                    <h2 class="text-3xl font-semi   bold    tracking-tight text-gray-600">Pilih Jenis Registrasi</h2>
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
    <div class="max-w-xl mx-auto px-4">
        <!-- Registration Form -->
        <div class="bg-white rounded-xl shadow-sm p-8" id="registration-form" style="display: none;">
            <div class="flex min-h-full items-center justify-center p-6 lg:px-8">
                <div class="w-full">
                    <!-- Logo and Header -->
                    <div class="text-center mb-8">
                        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-gray-600" id="form-title"></h2>
                        <p class="mt-2 text-sm text-gray-600" id="form-subtitle"></p>
                    </div>

                    <form action="">
                        <!-- Nama - selalu tampil -->
                        <div class="mt-4">
                            <label for="nama" class="block text-sm font-medium text-gray-900 mb-2">Nama</label>
                            <div class="relative">
                                <input type="text" name="nama" id="nama" autocomplete="nama" required
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                    placeholder="" />
                            </div>
                        </div>
                        <!-- No Telepon - selalu tampil -->
                        <div class="mt-4">
                            <label for="no_tlp" class="block text-sm font-medium text-gray-900 mb-2">No
                                Telepon</label>
                            <div class="relative">
                                <input type="text" name="no_tlp" id="no_tlp" autocomplete="no_tlp" required
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                    placeholder="" />
                            </div>
                        </div>

                        <!-- Email - selalu tampil -->
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
                            <div class="relative">
                                <input type="email" name="email" id="email" autocomplete="email" required
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                    placeholder="" />
                            </div>
                        </div>
                        <!-- Alamat - selalu tampil -->
                        <div class="mt-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-900 mb-2">Alamat</label>
                            <div class="relative">
                                <textarea
                                    class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                    name="alamat" id="alamat" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <!-- Fields khusus Mitra -->
                        <div id="mitra-fields" style="display: none;">
                            <!-- Website - hanya tampil di mitra -->
                            <div class="mt-4">
                                <label for="website"
                                    class="block text-sm font-medium text-gray-900 mb-2">Website</label>
                                <div class="relative">
                                    <input type="url" name="website" id="website" autocomplete="website"
                                        class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                        placeholder="" />
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
                                            class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                            placeholder="" />
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="jabatan_penanggung_jawab"
                                        class="block text-sm font-medium text-gray-900 mb-2">Jabatan Penanggung
                                        Jawab</label>
                                    <div class="relative">
                                        <input type="text" name="jabatan_penanggung_jawab"
                                            id="jabatan_penanggung_jawab" autocomplete="jabatan_penanggung_jawab"
                                            class="block w-full rounded-lg bg-white px-4 py-3 text-base text-gray-900 border border-gray-300 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0 transition-colors"
                                            placeholder="" />
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
        let selectedType = '';

        function selectCard(type) {
            selectedType = type;

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
                document.getElementById('website').required = true;
                document.getElementById('penanggung_jawab').required = true;
                document.getElementById('jabatan_penanggung_jawab').required = true;
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
