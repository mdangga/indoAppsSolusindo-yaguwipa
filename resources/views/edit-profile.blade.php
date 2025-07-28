@php
    $user = auth()->user();

    // Generalized user data (mitra/donatur)
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
                        <a href="{{ route('dashboard') }}" 
                           class="text-gray-500 hover:text-gray-700 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
                            <p class="text-gray-600">Kelola informasi akun Anda</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if ($profilePath)
                            <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                class="w-10 h-10 rounded-full object-cover border-2 border-gray-300" />
                        @else
                            <div class="w-10 h-10 {{ $randomBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase text-sm">
                                {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-sm font-medium text-gray-900">{{ $displayUser->nama ?? $user->username }}</span>
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
                        <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center space-x-6">
                                <div class="flex-shrink-0">
                                    @if ($profilePath)
                                        <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                            class="w-20 h-20 rounded-full object-cover border-4 border-gray-200" />
                                    @else
                                        <div class="w-20 h-20 {{ $randomBg }} rounded-full text-white flex items-center justify-center font-bold text-2xl">
                                            {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="profile_photo" accept="image/*" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-2">JPG, PNG atau GIF. Maksimal 2MB.</p>
                                </div>
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                                    Upload
                                </button>
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
                        <form action="{{ route('profile.update.info') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" 
                                           value="{{ old('nama', $displayUser->nama ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                    <input type="text" id="username" name="username" 
                                           value="{{ old('username', $user->username) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email', $user->email) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="no_tlp" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="tel" id="no_tlp" name="no_tlp" 
                                           value="{{ old('no_tlp', $displayUser->no_tlp ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            
                            @if($user->role === 'mitra')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $displayUser->alamat ?? '') }}</textarea>
                                </div>
                                
                                <div>
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $displayUser->deskripsi ?? '') }}</textarea>
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
                        <form action="{{ route('profile.update.password') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <input type="password" id="current_password" name="current_password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" id="new_password" name="new_password" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div>
                                    <h3 class="text-sm font-medium text-red-900">Hapus Akun</h3>
                                    <p class="text-sm text-red-600">Hapus akun Anda secara permanen beserta semua data</p>
                                </div>
                                <button type="button" onclick="confirmDeleteAccount()"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors text-sm font-medium">
                                    Hapus Akun
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Account Confirmation Modal -->
    <div id="deleteAccountModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Konfirmasi Hapus Akun</h3>
            <p class="text-sm text-gray-600 mb-6">
                Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan dan semua data Anda akan hilang permanen.
            </p>
            <div class="flex space-x-4">
                <button onclick="hideDeleteModal()" 
                        class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                    Batal
                </button>
                <form action="{{ route('profile.delete') }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteAccount() {
            document.getElementById('deleteAccountModal').classList.remove('hidden');
            document.getElementById('deleteAccountModal').classList.add('flex');
        }

        function hideDeleteModal() {
            document.getElementById('deleteAccountModal').classList.add('hidden');
            document.getElementById('deleteAccountModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('deleteAccountModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
    </script>
</body>

</html>