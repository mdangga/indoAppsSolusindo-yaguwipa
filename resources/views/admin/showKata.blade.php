@extends('layouts.showAdmin')

@section('title', 'Admin - Manajemen Kata Kotor')
{{-- @section('header', 'Manajemen Kata Kotor') --}}

@section('content')
    <div class="bg-white shadow-xl rounded-xl p-8">
        {{-- Header + Search --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div class="flex items-center mb-4 lg:mb-0">
                <div class="bg-red-100 p-3 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" viewBox="0 0 48 48">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4"
                            d="M4.18 26.834A2 2 0 0 0 6.175 29H10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H7.84a2 2 0 0 0-1.993 1.834zM18 26.626c0 .835.52 1.583 1.275 1.94c1.649.777 4.458 2.34 5.725 4.454c1.633 2.723 1.941 7.644 1.991 8.771c.007.158.003.316.024.472c.271 1.953 4.04-.328 5.485-2.74c.785-1.308.885-3.027.803-4.37c-.089-1.435-.51-2.823-.923-4.201l-.88-2.937h10.857a2 2 0 0 0 1.925-2.543l-5.37-19.016A2 2 0 0 0 36.986 5H20a2 2 0 0 0-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Daftar Kata Kotor</h2>
                    <p class="text-gray-600 text-sm">Kelola kata-kata yang difilter dalam sistem</p>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.kataKotor') }}" class="flex">
                <div class="relative">
                    <input type="text" name="search"
                        class="border border-gray-300 rounded-l-xl px-4 py-3 pl-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-80 transition-all duration-200"
                        placeholder="Cari kata..." value="{{ request('search') }}">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                </div>
                <button
                    class="bg-blue-600 text-white px-6 py-3 rounded-r-xl hover:bg-blue-700 transition-colors duration-200 shadow-lg"
                    type="submit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>

        {{-- Form Tambah Kata --}}
        <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                <h3 class="text-lg font-semibold text-green-800">Tambah Kata Baru</h3>
            </div>

            <form method="POST" action="{{ route('kataKotor.store') }}" class="flex flex-col lg:flex-row gap-3">
                @csrf
                <div class="flex-1">
                    <input type="text" id="kata" name="kata"
                        class="border border-gray-300 px-4 py-3 rounded-xl w-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 @error('kata') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Masukkan kata kotor yang akan difilter" required>
                    @error('kata')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-green-600 text-white px-8 py-3 rounded-xl hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Tambah Kata
                </button>
            </form>
        </div>

        {{-- Stats --}}
        <div class="mb-6 bg-gray-50 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center text-gray-600">
                    Total: {{ $kataKotor->total() }} kata
                </div>
                @if (request('search'))
                    <div class="flex items-center text-blue-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                            </path>
                        </svg>
                        Pencarian: "{{ request('search') }}"
                    </div>
                @endif
            </div>
        </div>

        {{-- List Kata --}}
        <div id="tagsContainer" class="flex flex-wrap gap-3">
            @forelse($kataKotor as $kata)
                <div
                    class="group flex items-center bg-gray-200 text-gray-900 px-4 py-2 rounded-md shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                    <span class="font-medium">{{ $kata->kata }}</span>
                    <button onclick="openEditModal({{ $kata->id_kata }}, '{{ $kata->kata }}')"
                        class="ml-3 p-1 hover:bg-gray-900 hover:text-white rounded-full transition-colors duration-200"
                        title="Edit kata">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </button>
                    <form method="POST" action="{{ route('kataKotor.destroy', $kata->id_kata) }}"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kata \'{{ $kata->kata }}\'?')"
                        class="ml-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="p-1 hover:bg-gray-900 hover:text-white rounded-full transition-colors duration-200"
                            title="Hapus kata">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            @empty
                <div
                    class="w-full bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 text-blue-800 px-6 py-8 rounded-xl text-center">
                    <svg class="w-16 h-16 text-blue-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-3-9a9 9 0 019 9 9 9 0 01-9 9 9 9 0 01-9-9 9 9 0 019-9z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold mb-2">Tidak ada kata kotor yang ditemukan</h3>
                    <p class="text-sm opacity-75">
                        @if (request('search'))
                            Coba gunakan kata kunci yang berbeda
                        @else
                            Belum ada kata kotor yang ditambahkan ke sistem
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($kataKotor->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-white border border-gray-200 rounded-xl p-2">
                    {{ $kataKotor->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
    </div>

    {{-- Modal Edit --}}
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-200/20 backdrop-blur-sm bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-semibold">Edit Kata Kotor</h3>
                    </div>
                    <button onclick="closeEditModal()" class="p-2 hover:bg-blue-700 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="editKata" class="block text-sm font-medium text-gray-700 mb-2">Kata Kotor</label>
                    <input type="text" id="editKata" name="kata"
                        class="border border-gray-300 px-4 py-3 rounded-xl w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        required>
                    <div id="editError" class="text-red-500 text-sm mt-2 hidden flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span></span>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors duration-200 font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        function openEditModal(id, kata) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editKata').value = kata;
            document.getElementById('editForm').action = `/admin/kata-kotor/${id}`;
            document.getElementById('editError').classList.add('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('editModal').classList.contains('hidden')) {
                closeEditModal();
            }
        });
    </script>
@endpush
