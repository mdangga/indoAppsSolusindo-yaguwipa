<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Publikasi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">
    {{-- loader --}}
    <x-loader-component />
    {{-- navbar --}}
    <x-navbar :menus="$menus" />
    {{-- floating button --}}
    <x-contact-btt-floating email="{{ $site['yayasanProfile']->email }}"
        phone="{{ $site['yayasanProfile']->telephone }}" size="default" :auto-hide="true" :auto-hide-delay="3000"
        :show-back-to-top="true" :scroll-threshold="200" />

    <main>
        <div class="px-4 sm:px-6 lg:px-12 py-16">
            <div class="max-w-7xl mx-auto">
                <x-header-page title="PUBLIKASI"
                    description="Galeri ini menyajikan koleksi gambar dari berbagai aktivitas, baik yang diselenggarakan oleh yayasan maupun momen-momen penting lainnya." />
                <!-- Filter Section -->
                <div class="container mx-auto">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8" data-aos="fade-up">
                        <div class="flex flex-col md:flex-row gap-4 items-center">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                                <div class="relative">
                                    <input type="text" id="searchInput" placeholder="Cari publikasi..."
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                            </div>
                            <div class="w-full md:w-64">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select id="categoryFilter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($jenisPublikasi as $jenis)
                                        <option value="{{ $jenis->nama }}">{{ $jenis->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full md:w-48">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                                <select id="sortFilter"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="newest">Terbaru</option>
                                    <option value="oldest">Terlama</option>
                                    <option value="title">Judul A-Z</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publications Grid -->
                <div id="publicationsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($publikasi as $item)
                        <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between h-full"
                            data-aos="fade-up"
                            data-category="{{ strtolower($item->JenisPublikasi->nama ?? 'lainnya') }}"
                            data-title="{{ strtolower($item->judul) }}">

                            {{-- Thumbnail dan Kategori --}}
                            <div class="relative">
                                @php
                                    $filePath = $item->file;

                                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                    $fileExtension = strtoupper($fileExtension);

                                    $fileSize = Storage::disk('public')->exists($filePath)
                                        ? number_format(Storage::disk('public')->size($filePath) / 1048576, 1)
                                        : '0.0';

                                    $fileIconSvg = match (strtolower($fileExtension)) {
                                        'pdf'
                                            => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 16 16">
	<path fill="red" fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173q.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38a.57.57 0 0 1-.238.241a.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181q.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084q0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592a1.1 1.1 0 0 1-.196.422a.8.8 0 0 1-.334.252a1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
</svg>',
                                        'docx'
                                            => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 16 16">
	<path fill="blue" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-6.839 9.688v-.522a1.5 1.5 0 0 0-.117-.641a.86.86 0 0 0-.322-.387a.86.86 0 0 0-.469-.129a.87.87 0 0 0-.471.13a.87.87 0 0 0-.32.386a1.5 1.5 0 0 0-.117.641v.522q0 .384.117.641a.87.87 0 0 0 .32.387a.9.9 0 0 0 .471.126a.9.9 0 0 0 .469-.126a.86.86 0 0 0 .322-.386a1.55 1.55 0 0 0 .117-.642m.803-.516v.513q0 .563-.205.973a1.47 1.47 0 0 1-.589.627q-.381.216-.917.216a1.86 1.86 0 0 1-.92-.216a1.46 1.46 0 0 1-.589-.627a2.15 2.15 0 0 1-.205-.973v-.513q0-.569.205-.975q.205-.411.59-.627q.386-.22.92-.22q.535 0 .916.22q.383.219.59.63q.204.406.204.972M1 15.925v-3.999h1.459q.609 0 1.005.235q.396.233.589.68q.196.445.196 1.074q0 .634-.196 1.084q-.197.451-.595.689q-.396.237-.999.237zm1.354-3.354H1.79v2.707h.563q.277 0 .483-.082a.8.8 0 0 0 .334-.252q.132-.17.196-.422a2.3 2.3 0 0 0 .068-.592q0-.45-.118-.753a.9.9 0 0 0-.354-.454q-.237-.152-.61-.152Zm6.756 1.116q0-.373.103-.633a.87.87 0 0 1 .301-.398a.8.8 0 0 1 .475-.138q.225 0 .398.097a.7.7 0 0 1 .273.26a.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964a1.4 1.4 0 0 0-.49-.272a1.8 1.8 0 0 0-.606-.097q-.534 0-.911.223q-.375.222-.571.633q-.197.41-.197.978v.498q0 .568.194.976q.195.406.571.627q.375.216.914.216q.44 0 .785-.164t.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364a.7.7 0 0 1-.273.248a.9.9 0 0 1-.401.088a.85.85 0 0 1-.478-.131a.83.83 0 0 1-.298-.393a1.7 1.7 0 0 1-.103-.627zm5.092-1.76h.894l-1.275 2.006l1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015l-1.228-1.984h.932l.832 1.439h.035z" />
</svg>',
                                        'doc'
                                            => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 16 16">
	<path fill="blue" fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-7.839 9.166v.522q0 .384-.117.641a.86.86 0 0 1-.322.387a.9.9 0 0 1-.469.126a.9.9 0 0 1-.471-.126a.87.87 0 0 1-.32-.386a1.55 1.55 0 0 1-.117-.642v-.522q0-.386.117-.641a.87.87 0 0 1 .32-.387a.87.87 0 0 1 .471-.129q.264 0 .469.13a.86.86 0 0 1 .322.386q.117.255.117.641m.803.519v-.513q0-.565-.205-.972a1.46 1.46 0 0 0-.589-.63q-.381-.22-.917-.22q-.533 0-.92.22a1.44 1.44 0 0 0-.589.627q-.204.406-.205.975v.513q0 .563.205.973q.205.406.59.627q.386.216.92.216q.535 0 .916-.216q.383-.22.59-.627q.204-.41.204-.973M0 11.926v4h1.459q.603 0 .999-.238a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084q0-.63-.196-1.075a1.43 1.43 0 0 0-.59-.68q-.395-.234-1.004-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592a1.1 1.1 0 0 1-.196.422a.8.8 0 0 1-.334.252a1.3 1.3 0 0 1-.483.082H.79V12.57Zm7.422.483a1.7 1.7 0 0 0-.103.633v.495q0 .369.103.627a.83.83 0 0 0 .298.393a.85.85 0 0 0 .478.131a.9.9 0 0 0 .401-.088a.7.7 0 0 0 .273-.248a.8.8 0 0 0 .117-.364h.765v.076a1.27 1.27 0 0 1-.226.674q-.205.29-.55.454a1.8 1.8 0 0 1-.786.164q-.54 0-.914-.216a1.4 1.4 0 0 1-.571-.627q-.194-.408-.194-.976v-.498q0-.568.197-.978q.195-.411.571-.633q.378-.223.911-.223q.328 0 .607.097q.28.093.489.272a1.33 1.33 0 0 1 .466.964v.073H9.78a.85.85 0 0 0-.12-.38a.7.7 0 0 0-.273-.261a.8.8 0 0 0-.398-.097a.8.8 0 0 0-.475.138a.87.87 0 0 0-.301.398" />
</svg>',
                                    };

                                    // Tambahan
                                    $jumlahHalaman = $item->halaman ?? 'N/A'; // Pastikan field ini ada di database
                                    $jumlahDownload = $item->download ?? 0; // Misalnya kamu menyimpan total unduhan
                                    $jenisPublikasi = $item->JenisPublikasi->nama ?? 'Publikasi';
                                @endphp

                                <div
                                    class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 rounded-t-lg flex items-center justify-center">
                                    {!! $fileIconSvg !!}
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $item->JenisPublikasi->nama ?? 'Publikasi' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Konten --}}
                            <div class="p-6 flex flex-col flex-grow justify-between">
                                <div class="flex-grow">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">
                                        {{ $item->judul }}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 150) }}
                                    </p>
                                </div>

                                {{-- Info & Actions --}}
                                <div class="mt-4">
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-2"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_terbit)->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-file mr-2"></i>
                                            {{ $fileExtension }}, {{ $fileSize }} MB
                                        </span>
                                    </div>

                                    <div class="flex gap-2">
                                        <button
                                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                                            onclick="viewPublicationModal({{ json_encode([
                                                'judul' => $item->judul,
                                                'deskripsi' => strip_tags($item->deskripsi),
                                                'tanggal' => \Carbon\Carbon::parse($item->tanggal_terbit)->translatedFormat('d M Y'),
                                                'file' => asset('storage/' . $item->file),
                                                'fileSize' => $fileSize,
                                                'fileType' => $fileExtension,
                                                'jumlahHalaman' => $jumlahHalaman,
                                                'jumlahDownload' => $jumlahDownload,
                                                'jenisPublikasi' => $jenisPublikasi,
                                            ]) }})">
                                            <i class="fas fa-eye"></i>
                                            <span>Lihat</span>
                                        </button>

                                        @if ($fileExtension === 'PDF')
                                            <a href="{{ route('publikasi.pdf', $filePath) }}" target="_blank"
                                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                                <i class="fa-regular fa-file"></i>
                                            </a>
                                        @endif

                                        <a href="{{ asset('storage/' . $item->file) }}" download
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-gray-600">Belum ada publikasi tersedia.</p>
                    @endforelse
                </div>


            </div>
        </div>
        <!-- Modal -->
        <div id="publicationModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden transition-opacity duration-300">
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-8 overflow-y-auto max-h-[90vh] relative border border-gray-200">

                <!-- Tombol close -->
                <button onclick="closePublicationModal()"
                    class="absolute top-4 right-5 text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>

                <div class="space-y-6">
                    <!-- Judul -->
                    <h2 id="modalJudul" class="text-3xl font-semibold text-gray-800"></h2>

                    <!-- Deskripsi -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Deskripsi</h3>
                        <p id="modalDeskripsi" class="text-gray-600 leading-relaxed text-sm"></p>
                    </div>

                    <!-- Info Grid -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Info File -->
                        <div class="bg-gray-50 rounded-lg p-4 border">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Informasi File</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li><strong>Tipe File:</strong> <span id="modalTipeFile"></span></li>
                                <li><strong>Ukuran File:</strong> <span id="modalUkuranFile"></span> MB</li>
                                <li><strong>Halaman:</strong> <span id="modalJumlahHalaman"></span></li>
                                <li><strong>Tanggal:</strong> <span id="modalTanggal"></span></li>
                            </ul>
                        </div>

                        <!-- Metadata -->
                        <div class="bg-gray-50 rounded-lg p-4 border">
                            <h4 class="font-semibold text-sm text-gray-700 mb-3">Metadata</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li><strong>Kategori:</strong> <span id="modalKategori"></span></li>
                                <li><strong>Download:</strong> <span id="modalJumlahDownload"></span> kali</li>
                            </ul>
                        </div>
                    </div>


                </div><!-- Tombol Download -->
                <div class="text-right pt-5">
                    <a id="modalDownloadLink" href="#" target="_blank"
                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-md text-sm font-medium shadow-md transition">
                        <i class="fas fa-download"></i> Download File
                    </a>
                </div>
            </div>
        </div>




        <!-- Download Toast -->
        <div id="downloadToast"
            class="fixed top-4 right-0 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
            <div class="flex items-center gap-3">
                <i class="fas fa-download"></i>
                <span>Download dimulai...</span>
            </div>
        </div>
    </main>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true,
            offset: 100
        });

        // Search and Filter Functionality
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const sortFilter = document.getElementById('sortFilter');
        const publicationsGrid = document.getElementById('publicationsGrid');
        const noResults = document.getElementById('noResults');

        // Event listeners
        searchInput.addEventListener('input', filterPublications);
        categoryFilter.addEventListener('change', filterPublications);
        sortFilter.addEventListener('change', filterPublications);

        function filterPublications() {
            const searchTerm = searchInput.value.toLowerCase();
            const categoryTerm = categoryFilter.value.toLowerCase();
            const sortBy = sortFilter.value;
            const cards = Array.from(document.querySelectorAll('.publication-card'));

            // Filter cards
            let visibleCards = cards.filter(card => {
                const title = card.dataset.title.toLowerCase();
                const category = card.dataset.category.toLowerCase();

                const matchesSearch = title.includes(searchTerm);
                const matchesCategory = !categoryTerm || category === categoryTerm;

                return matchesSearch && matchesCategory;
            });

            // Sort cards
            visibleCards.sort((a, b) => {
                switch (sortBy) {
                    case 'newest':
                        return new Date(b.dataset.date) - new Date(a.dataset.date);
                    case 'oldest':
                        return new Date(a.dataset.date) - new Date(b.dataset.date);
                    case 'title':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    default:
                        return 0;
                }
            });

            // Hide all cards
            cards.forEach(card => card.style.display = 'none');

            // Show filtered and sorted cards
            if (visibleCards.length > 0) {
                visibleCards.forEach(card => card.style.display = 'block');
                noResults.classList.add('hidden');
                publicationsGrid.classList.remove('hidden');
            } else {
                noResults.classList.remove('hidden');
                publicationsGrid.classList.add('hidden');
            }
        }

        function viewPublicationModal(data) {
            document.getElementById('modalJudul').innerText = data.judul;
            document.getElementById('modalDeskripsi').innerText = data.deskripsi;
            document.getElementById('modalTipeFile').innerText = data.fileType;
            document.getElementById('modalUkuranFile').innerText = data.fileSize;
            document.getElementById('modalJumlahHalaman').innerText = data.jumlahHalaman;
            document.getElementById('modalTanggal').innerText = data.tanggal;
            document.getElementById('modalKategori').innerText = data.jenisPublikasi;
            document.getElementById('modalJumlahDownload').innerText = data.jumlahDownload;
            document.getElementById('modalDownloadLink').href = data.file;

            document.getElementById('publicationModal').classList.remove('hidden');
        }

        function closePublicationModal() {
            document.getElementById('publicationModal').classList.add('hidden');
        }

        function closePublicationModal() {
            const modal = document.getElementById('publicationModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }
        // Download file function
        function downloadFile(filename, title) {
            // Show download toast
            const toast = document.getElementById('downloadToast');
            toast.style.transform = 'translateX(0)';

            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateX(full)';
            }, 3000);

            // Simulate file download
            // In real implementation, this would be a link to the actual file
            const link = document.createElement('a');
            link.href = `/storage/publikasi/${filename}`; // Adjust path as needed
            link.download = filename;
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            console.log(`Download dimulai untuk: ${title}`);
        }

        // Load more functionality (simulasi)
        function loadMorePublications() {
            const loadMoreBtn = document.getElementById('loadMoreSection');
            loadMoreBtn.innerHTML = `
                 <span class="text-gray-500">Semua publikasi telah dimuat.</span>
             `;
            loadMoreBtn.disabled = true;
        }
        a
        // Modal download button handler (optional update)
        document.getElementById('modalDownloadBtn').addEventListener('click', function() {
            const title = document.getElementById('modalTitle').textContent;
            // Simulasi nama file berdasarkan title
            const filename = title.toLowerCase().replace(/\s+/g, '-') + '.pdf';
            downloadFile(filename, title);
        });
    </script>

</body>

</html>
