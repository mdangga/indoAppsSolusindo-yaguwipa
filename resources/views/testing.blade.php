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
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="container mx-auto px-4 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Publikasi</h1>
            <p class="text-xl opacity-90">Koleksi lengkap publikasi dan dokumen resmi</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="container mx-auto px-4 py-8">
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
                        <option value="laporan">Laporan Tahunan</option>
                        <option value="panduan">Panduan & Manual</option>
                        <option value="penelitian">Hasil Penelitian</option>
                        <option value="kebijakan">Dokumen Kebijakan</option>
                        <option value="newsletter">Newsletter</option>
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
    <div class="container mx-auto px-4 pb-12">
        <div id="publicationsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sample Publications -->
            <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                data-aos="fade-up" data-category="laporan" data-title="laporan tahunan 2023" data-date="2023-12-15">
                <div class="relative">
                    <div
                        class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 rounded-t-lg flex items-center justify-center">
                        <i class="fas fa-file-pdf text-4xl text-red-500"></i>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">Laporan</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">Laporan Tahunan 2023</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                        Laporan komprehensif mengenai kegiatan dan pencapaian organisasi selama tahun 2023,
                        termasuk program-program unggulan dan dampak sosial yang telah dicapai.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            15 Des 2023
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-file mr-2"></i>
                            PDF, 2.5 MB
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            onclick="viewPublication('Laporan Tahunan 2023')">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                            onclick="downloadFile('laporan-tahunan-2023.pdf', 'Laporan Tahunan 2023')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                data-aos="fade-up" data-aos-delay="100" data-category="panduan"
                data-title="panduan implementasi program" data-date="2023-11-20">
                <div class="relative">
                    <div
                        class="h-48 bg-gradient-to-br from-green-100 to-green-200 rounded-t-lg flex items-center justify-center">
                        <i class="fas fa-book text-4xl text-green-600"></i>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Panduan</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">Panduan Implementasi Program</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                        Manual lengkap untuk implementasi program-program unggulan,
                        dilengkapi dengan SOP dan best practices yang telah terbukti efektif.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            20 Nov 2023
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-file mr-2"></i>
                            PDF, 1.8 MB
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            onclick="viewPublication('Panduan Implementasi Program')">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                            onclick="downloadFile('panduan-implementasi-2023.pdf', 'Panduan Implementasi Program')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                data-aos="fade-up" data-aos-delay="200" data-category="penelitian"
                data-title="studi dampak sosial 2023" data-date="2023-10-10">
                <div class="relative">
                    <div
                        class="h-48 bg-gradient-to-br from-purple-100 to-purple-200 rounded-t-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-4xl text-purple-600"></i>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span
                            class="bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-medium">Penelitian</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">Studi Dampak Sosial 2023</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                        Hasil penelitian mendalam tentang dampak sosial program-program yang telah dijalankan,
                        dengan analisis kuantitatif dan kualitatif yang komprehensif.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            10 Okt 2023
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-file mr-2"></i>
                            PDF, 3.2 MB
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            onclick="viewPublication('Studi Dampak Sosial 2023')">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                            onclick="downloadFile('studi-dampak-sosial-2023.pdf', 'Studi Dampak Sosial 2023')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                data-aos="fade-up" data-aos-delay="300" data-category="kebijakan"
                data-title="kebijakan organisasi terbaru" data-date="2023-09-15">
                <div class="relative">
                    <div
                        class="h-48 bg-gradient-to-br from-orange-100 to-orange-200 rounded-t-lg flex items-center justify-center">
                        <i class="fas fa-gavel text-4xl text-orange-600"></i>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span
                            class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">Kebijakan</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">Kebijakan Organisasi Terbaru</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                        Dokumen kebijakan terbaru yang mengatur operasional organisasi,
                        termasuk update prosedur dan standar kerja yang berlaku.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            15 Sep 2023
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-file mr-2"></i>
                            PDF, 1.2 MB
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            onclick="viewPublication('Kebijakan Organisasi Terbaru')">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                            onclick="downloadFile('kebijakan-organisasi-2023.pdf', 'Kebijakan Organisasi Terbaru')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                data-aos="fade-up" data-aos-delay="400" data-category="newsletter"
                data-title="newsletter edisi september 2023" data-date="2023-09-01">
                <div class="relative">
                    <div
                        class="h-48 bg-gradient-to-br from-teal-100 to-teal-200 rounded-t-lg flex items-center justify-center">
                        <i class="fas fa-newspaper text-4xl text-teal-600"></i>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span
                            class="bg-teal-500 text-white px-2 py-1 rounded-full text-xs font-medium">Newsletter</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">Newsletter Edisi September 2023
                    </h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                        Berita dan update terbaru dari organisasi, termasuk pencapaian program,
                        event mendatang, dan highlight kegiatan bulanan.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            1 Sep 2023
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-file mr-2"></i>
                            PDF, 0.8 MB
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            onclick="viewPublication('Newsletter Edisi September 2023')">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                            onclick="downloadFile('newsletter-september-2023.pdf', 'Newsletter Edisi September 2023')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="publication-card bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                data-aos="fade-up" data-aos-delay="500" data-category="laporan"
                data-title="laporan keuangan q2 2023" data-date="2023-07-30">
                <div class="relative">
                    <div
                        class="h-48 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-t-lg flex items-center justify-center">
                        <i class="fas fa-chart-pie text-4xl text-indigo-600"></i>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span
                            class="bg-indigo-500 text-white px-2 py-1 rounded-full text-xs font-medium">Laporan</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">Laporan Keuangan Q2 2023</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                        Laporan keuangan triwulan kedua 2023 yang menampilkan transparansi
                        pengelolaan dana dan pencapaian target keuangan organisasi.
                    </p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            30 Jul 2023
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-file mr-2"></i>
                            PDF, 1.5 MB
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            onclick="viewPublication('Laporan Keuangan Q2 2023')">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </button>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                            onclick="downloadFile('laporan-keuangan-q2-2023.pdf', 'Laporan Keuangan Q2 2023')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-16">
            <div class="text-6xl text-gray-300 mb-4">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Hasil Ditemukan</h3>
            <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter kategori</p>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12" id="loadMoreSection">
            <button
                class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center gap-2"
                onclick="loadMorePublications()">
                <i class="fas fa-plus"></i>
                <span>Muat Lebih Banyak</span>
            </button>
        </div>
    </div>

    <!-- Publication Detail Modal -->
    <div id="publicationModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b">
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-800"></h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div id="modalContent" class="prose max-w-none">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t bg-gray-50">
                <button onclick="closeModal()"
                    class="px-6 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                    Tutup
                </button>
                <button id="modalDownloadBtn"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    Download
                </button>
            </div>
        </div>
    </div>

    <!-- Download Toast -->
    <div id="downloadToast"
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center gap-3">
            <i class="fas fa-download"></i>
            <span>Download dimulai...</span>
        </div>
    </div>

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

        // View publication function
        function viewPublication(title) {
            const modal = document.getElementById('publicationModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');

            modalTitle.textContent = title;
            modalContent.innerHTML = `
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor 
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in 
                        culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold mb-2">Informasi File</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li><strong>Format:</strong> PDF</li>
                            <li><strong>Ukuran:</strong> 2.5 MB</li>
                            <li><strong>Halaman:</strong> 45</li>
                            <li><strong>Tanggal:</strong> 15 Desember 2023</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Metadata</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li><strong>Kategori:</strong> Laporan Tahunan</li>
                            <li><strong>Status:</strong> Publikasi</li>
                            <li><strong>Download:</strong> 245 kali</li>
                            <li><strong>Versi:</strong> 1.0</li>
                        </ul>
                    </div>
                </div>
            `;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close modal function
        function closeModal() {
            const modal = document.getElementById('publicationModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
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
