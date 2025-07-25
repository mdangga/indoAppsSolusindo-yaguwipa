@props(['program'])

<div class="program-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
    <!-- Gambar -->
    <div class="h-40 w-full overflow-hidden">
        <img src="{{ asset('storage/' . $program->image_path) }}" alt="..." class="w-full h-full object-cover" />
    </div>

    <!-- Konten Program -->
    <div class="flex flex-col justify-between flex-1 p-6">
        <div>
            <a href="{{ route('beranda.showProgram', ['id' => $program->id_program]) }}"
                class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-blue-600 transition-colors"
                title="{{ $program->nama }}">
                {{ $program->nama }}
            </a>

            <p class="text-gray-600 mb-4 text-[14px] line-clamp-4">
                {{ Str::limit(strip_tags($program->deskripsi), 100) }}
            </p>

            <div class="space-y-2 mb-4 text-sm text-gray-500">
                <!-- Institusi -->
                @if ($program->institusiTerlibat->isNotEmpty())
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M2 19h20v3H2zM12 2L2 6v2h20V6zm5 8h3v7h-3zm-6.5 0h3v7h-3zM4 10h3v7H4z" />
                        </svg>
                        <span>{{ $program->institusiTerlibat->pluck('nama')->implode(', ') }}</span>
                    </div>
                @endif

                <!-- Tanggal -->
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 15H5V8h14z" />
                    </svg>
                    <span>{{ $program->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Kategori dan Status -->
        <div class="flex items-center justify-between pt-4 mt-auto">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $program->KategoriProgram->nama ?? 'Tanpa Kategori' }}
            </span>
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                {{ $program->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ucfirst($program->status) }}
            </span>
        </div>
    </div>
</div>
