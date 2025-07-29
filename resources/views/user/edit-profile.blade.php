@php
    $user = auth()->user();

    $displayUser = $user->role === 'mitra' ? $user->UserToMitra : $user->UserToDonatur;

    $colorMap = [
        'bg-red-400' => 'hover:bg-red-300',
        'bg-blue-400' => 'hover:bg-blue-300',
        'bg-green-400' => 'hover:bg-green-300',
        'bg-yellow-400' => 'hover:bg-yellow-300',
        'bg-purple-400' => 'hover:bg-purple-300',
        'bg-pink-400' => 'hover:bg-pink-300',
        'bg-teal-400' => 'hover:bg-teal-300',
        'bg-orange-400' => 'hover:bg-orange-300',
    ];

    $colors = array_keys($colorMap);
    $userIdentifier = $user->email ?? $user->id;
    $colorIndex = crc32($userIdentifier) % count($colors);
    $randomBg = $colors[$colorIndex];
    $hoverBg = $colorMap[$randomBg];

    $profilePath = optional($displayUser)->profile_path;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    @vite(['resources/css/app.css', 'resources/js/AOS.js', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 hover:scale-110 transition-all duration-100" viewBox="0 0 1024 1024">
                                <path fill="currentColor"
                                    d="M685.248 104.704a64 64 0 0 1 0 90.496L368.448 512l316.8 316.8a64 64 0 0 1-90.496 90.496L232.704 557.248a64 64 0 0 1 0-90.496l362.048-362.048a64 64 0 0 1 90.496 0" />
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-md lg:text-xl font-bold text-gray-900">Edit Profile</h1>
                            <p class="text-sm lg:text-md text-gray-600">Kelola informasi akun Anda</p>
                        </div>

                    </div>
                    <div class="flex items-center gap-3">
                        <div>
                            <p class="text-right text-sm font-medium text-gray-900 leading-tight">
                                {{ $displayUser->nama ?? $user->username }}
                            </p>
                            <p class="text-right text-xs text-gray-500">
                                {{ ucfirst($user->role) }}
                            </p>
                        </div>

                        @if ($profilePath)
                            <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                class="w-10 h-10 rounded-full object-cover border-2 border-gray-300" />
                        @else
                            <div
                                class="w-10 h-10 {{ $randomBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase text-sm">
                                {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-8">

                <!-- Profile Photo Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Foto Profile</h2>
                        <p class="text-sm text-gray-600">Ubah foto profile Anda</p>
                    </div>
                    <div class="px-6 py-6">
                        <form action="{{ route('edit-profile.photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center space-x-6">
                                <div class="flex-shrink-0">
                                    @if ($profilePath)
                                        <img id="imagePreview" src="{{ asset('storage/' . $profilePath) }}"
                                            alt="Profile"
                                            class="w-20 h-20 rounded-full object-cover border-4 border-gray-200 transition duration-300 ease-in-out" />
                                    @else
                                        <div id="imagePreviewWrapper"
                                            class="w-20 h-20 {{ $randomBg }} rounded-full text-white flex items-center justify-center font-bold text-2xl">
                                            {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="grid grid-cols-7 gap-4">
                                        <div class="col-span-6">
                                            <label for="profile_path"
                                                class="flex items-center justify-center w-full px-4 py-3 bg-white text-blue-700 border border-blue-200 rounded-lg cursor-pointer transition hover:bg-blue-50 hover:border-blue-300">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m3 14l.234.663c.91 2.578 1.365 3.868 2.403 4.602s2.406.735 5.14.735h2.445c2.735 0 4.102 0 5.14-.735c1.039-.734 1.494-2.024 2.404-4.602L21 14M12 4v10m0-10c-.7 0-2.008 1.994-2.5 2.5M12 4c.7 0 2.008 1.994 2.5 2.5" />
                                                </svg>
                                                <span id="labelText" class="text-sm font-medium">Pilih Gambar</span>
                                                <input id="profile_path" name="profile_path" type="file"
                                                    accept="image/*" class="hidden" />
                                            </label>
                                        </div>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                                            Upload
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">JPG, JPEG, PNG atau GIF. Maksimal 2MB.</p>
                                    @error('profile_path')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Personal Information Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Personal</h2>
                        <p class="text-sm text-gray-600">Update informasi personal Anda</p>
                    </div>
                    <div class="px-6 py-6">
                        <form action="{{ route('edit-profile.info') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="username"
                                        class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                    <input type="text" id="username" name="username"
                                        value="{{ old('username', $user->username) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('username')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" id="nama" name="nama"
                                        value="{{ old('nama', $displayUser->nama ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $displayUser->email ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="no_tlp" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                        Telepon</label>
                                    <input type="tel" id="no_tlp" name="no_tlp"
                                        value="{{ old('no_tlp', $displayUser->no_tlp ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('no_tlp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="alamat"
                                        class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $displayUser->alamat ?? '') }}</textarea>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                @if ($user->role === 'mitra')
                                    <div>
                                        <label for="website"
                                            class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                                        <input type="url" id="website" name="website"
                                            value="{{ old('website', $displayUser->website ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @error('website')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                            </div>

                            @if ($user->role === 'mitra')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="penanggung_jawab"
                                            class="block text-sm font-medium text-gray-700 mb-2">Penanggung
                                            Jawab</label>
                                        <input type="text" id="penanggung_jawab" name="penanggung_jawab"
                                            value="{{ old('penanggung_jawab', $displayUser->penanggung_jawab ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @error('penanggung_jawab')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="jabatan_penanggung_jawab"
                                            class="block text-sm font-medium text-gray-700 mb-2">Jabatan Penanggung
                                            Jawab</label>
                                        <input type="text" id="jabatan_penanggung_jawab"
                                            name="jabatan_penanggung_jawab"
                                            value="{{ old('jabatan_penanggung_jawab', $displayUser->jabatan_penanggung_jawab ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @error('jabatan_penanggung_jawab')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors font-medium">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Ganti Password</h2>
                        <p class="text-sm text-gray-600">Pastikan akun Anda menggunakan password yang kuat</p>
                    </div>
                    <div class="px-6 py-6">
                        <form action="{{ route('edit-profile.password') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="current_password"
                                    class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <input type="password" id="current_password" name="current_password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="new_password"
                                        class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" id="new_password" name="new_password"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="new_password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" id="new_password_confirmation"
                                        name="new_password_confirmation"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                @error('new_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400 mr-2 mt-0.5" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="text-sm text-yellow-700">
                                        <p class="font-medium">Tips keamanan password:</p>
                                        <ul class="mt-1 list-disc list-inside space-y-1">
                                            <li>Minimal 8 karakter</li>
                                            <li>Kombinasi huruf besar, kecil, angka, dan simbol</li>
                                            <li>Jangan gunakan informasi personal</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors font-medium">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Danger Zone Section -->
                <div class="bg-white rounded-lg shadow-sm border border-red-200">
                    <div class="px-6 py-4 border-b border-red-200">
                        <h2 class="text-lg font-semibold text-red-900">Zona Bahaya</h2>
                        <p class="text-sm text-red-600">Tindakan berikut tidak dapat dibatalkan</p>
                    </div>
                    <div class="px-6 py-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div>
                                    <h3 class="text-sm font-medium text-red-900">Nonaktifkan Akun</h3>
                                    <p class="text-sm text-red-600">Akun Anda akan dinonaktifkan tetapi data dapat
                                        dipulihkan</p>
                                </div>
                                <button type="button" onclick="showDeleteModal('deactivate')"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors text-sm font-medium">
                                    Nonaktifkan Akun
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div>
                                    <h3 class="text-sm font-medium text-red-900">Hapus Akun</h3>
                                    <p class="text-sm text-red-600">Akun Anda dan Data akan dihapus</p>
                                </div>
                                <button type="button" onclick="showDeleteModal('delete')"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors text-sm font-medium">
                                    Hapus Akun
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal"
                    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-50">
                    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
                        <div class="p-6">
                            <h3 id="modalTitle" class="text-lg font-semibold text-red-900 mb-2"></h3>
                            <p id="modalDescription" class="text-sm text-gray-600 mb-4"></p>

                            <form id="deleteAccountForm" method="POST">
                                @csrf
                                @method('DELETE')

                                <div id="usernameGroup" class="mb-4">
                                    <label for="username"
                                        class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" id="username" name="username" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                                    @error('username')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" id="password" name="password" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button type="button" onclick="hideDeleteModal()"
                                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Batal
                                    </button>
                                    <button id="submitButton" type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // profile form
                document.addEventListener('DOMContentLoaded', function() {
                    const input = document.getElementById('profile_path');
                    const previewImg = document.getElementById('imagePreview');
                    const previewWrapper = document.getElementById('imagePreviewWrapper');
                    const labelText = document.getElementById('labelText');

                    input.addEventListener('change', function() {
                        const file = this.files[0];
                        if (file) {
                            labelText.textContent = file.name;

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // If there's already an image preview, update its src
                                if (previewImg) {
                                    previewImg.src = e.target.result;
                                }
                                // If there's only the initial wrapper, replace it with an image
                                else if (previewWrapper) {
                                    const newImg = document.createElement('img');
                                    newImg.id = 'imagePreview';
                                    newImg.src = e.target.result;
                                    newImg.alt = 'Profile Preview';
                                    newImg.className =
                                        'w-20 h-20 rounded-full object-cover border-4 border-gray-200 transition duration-300 ease-in-out';

                                    previewWrapper.parentNode.replaceChild(newImg, previewWrapper);
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                });


                // danger zone
                function showDeleteModal(actionType) {
                    const modal = document.getElementById('deleteModal');
                    const title = document.getElementById('modalTitle');
                    const description = document.getElementById('modalDescription');
                    const form = document.getElementById('deleteAccountForm');
                    const submitButton = document.getElementById('submitButton');
                    const usernameGroup = document.getElementById('usernameGroup');

                    if (actionType === 'deactivate') {
                        title.textContent = 'Konfirmasi Nonaktifkan Akun';
                        description.textContent = 'Masukkan password Anda untuk mengonfirmasi penonaktifan akun.';
                        form.action = '{{ route('profile.deactivate') }}';
                        submitButton.textContent = 'Nonaktifkan Akun';
                        usernameGroup.classList.add('hidden');
                        document.getElementById('username').removeAttribute('required');
                    } else if (actionType === 'delete') {
                        title.textContent = 'Konfirmasi Hapus Akun';
                        description.textContent = 'Masukkan username dan password Anda untuk menghapus akun dan seluruh data Anda.';
                        form.action = '{{ route('profile.delete') }}';
                        submitButton.textContent = 'Hapus Akun';
                        usernameGroup.classList.remove('hidden');
                        document.getElementById('username').setAttribute('required', 'required');
                    }

                    modal.classList.remove('hidden');
                }


                function hideDeleteModal() {
                    document.getElementById('deleteModal').classList.add('hidden');
                }

                document.getElementById('deleteAccountForm').addEventListener('submit', function(e) {
                    const title = document.getElementById('modalTitle').textContent;
                    if (!confirm('Apakah Anda yakin ingin ' + title.toLowerCase() + '?')) {
                        e.preventDefault();
                    }
                });
            </script>
</body>

</html>
