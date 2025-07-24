<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Berita dan Kegiatan</title>
    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom DataTables Tailwind Styling -->
    <style>
        /* Remove default DataTables styling */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: inherit;
        }

        /* Custom styling */
        .dataTables_wrapper {
            padding: 0;
        }

        .dataTables_length select {
            padding: 0.5rem 2rem 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background-color: white;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .dataTables_filter input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            margin-left: 0.5rem;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Improved pagination styles - prevent cut off */
        .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.25rem;
            padding: 1rem 0;
            flex-wrap: wrap;
        }

        .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #374151;
            text-decoration: none;
            background: white;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            font-size: 0.875rem;
            line-height: 1;
            cursor: pointer;
        }

        .dataTables_paginate .paginate_button:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }

        .dataTables_paginate .paginate_button.current:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .dataTables_paginate .paginate_button.disabled {
            color: #9ca3af;
            background-color: #f9fafb;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        .dataTables_paginate .paginate_button.disabled:hover {
            color: #9ca3af;
            background-color: #f9fafb;
            border-color: #e5e7eb;
        }

        /* Info and pagination container */
        .dataTables_info {
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Responsive pagination */
        @media (max-width: 640px) {
            .dataTables_paginate {
                justify-content: center;
                gap: 0.125rem;
            }

            .dataTables_paginate .paginate_button {
                padding: 0.375rem 0.5rem;
                min-width: 2rem;
                height: 2rem;
                font-size: 0.75rem;
            }
        }

        /* Table styles */
        table.dataTable {
            border-collapse: separate;
            border-spacing: 0;
        }

        table.dataTable thead th {
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            background-color: #f9fafb;
        }

        table.dataTable tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }

        table.dataTable tbody tr:hover {
            background-color: #f8fafc;
        }

        table.dataTable tbody td {
            border-top: none;
            padding: 1rem 1.5rem;
        }

        table.dataTable thead th {
            padding: 0.75rem 1.5rem;
        }


        /* Prevent table overflow issues */
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Ensure pagination doesn't get cut off */
        .dataTables_wrapper .dataTables_paginate {
            overflow: visible;
            white-space: nowrap;
        }

        /* Success alert animation */
        .alert-success {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="p-6 md:ml-64 pt-20">
        <!-- Header -->
        {{-- <div class="mb-2">
            <h1 class="text-3xl font-bold text-gray-900">Berita dan Kegiatan</h1>
            <p class="text-gray-600 mt-2">Kelola konten berita dan kegiatan website</p>
        </div> --}}

        <!-- Success Alert -->
        @if (session('success'))
            <div
                class="alert-success bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class=" py-4 border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('berita.formStore') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-plus w-4 h-4 mr-2"></i>
                    Tambah Berita
                </a>
            </div>
        </div>


        <!-- Main Content Card -->
        <div class="bg-white border rounded-md border-gray-200 overflow-hidden">

            <!-- Table Container -->
            <div class="p-5 rounded-lg">
                <div class="table-container overflow-x-auto">
                    <table id="beritaTable" class="w-full border border-gray-300 ">
                        <thead>
                            <tr class="text-left">
                                <th>No</th>
                                <th>Judul</th>
                                <th>Thumbnail</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#beritaTable').DataTable({
                processing: false,
                serverSide: true,
                autoWidth: false,
                ajax: '{{ route('berita.table') }}',
                dom: '<"flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6"<"flex items-center gap-2"l><"flex items-center gap-2"f>>rt<"flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6"ip>',
                language: {

                    search: "",
                    searchPlaceholder: "Cari...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: '<div class="text-center py-8"><i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Belum ada data berita</p></div>',
                    zeroRecords: '<div class="text-center py-8"><i class="fas fa-search text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Tidak ada data yang sesuai dengan pencarian</p></div>'
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: null,
                        name: 'no',
                        render: function(data, type, row, meta) {
                            return `<span class="inline-flex items-center justify-center w-8 h-8 text-gray-700 text-sm font-medium">${meta.row + meta.settings._iDisplayStart + 1}</span>`;
                        },
                        orderable: false,
                        searchable: false,
                        width: '80px'
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                        render: function(data, type, row) {
                            return `
                                <div class="">
                                    <h3 class="font-semibold text-gray-900 leading-tight">${data}</h3>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                let imageUrl = '';

                                // Ambil URL dari <img src="...">
                                if (typeof data === 'string' && data.includes('<img')) {
                                    const match = data.match(/src=["']([^"']+)["']/);
                                    imageUrl = match ? match[1] : '';
                                } else {
                                    imageUrl = data;
                                }

                                if (imageUrl) {
                                    return `
                                    <div class="flex justify-center">
                                        <img src="${imageUrl}" alt="Thumbnail"
                                            class="w-32 h-20 object-cover  border border-gray-200 shadow-sm"
                                            onerror="this.onerror=null; this.src='/img/no-image.png'; this.classList.add('opacity-50');">
                                    </div>
                                `;
                                } else {
                                    return `
                                    <div class="flex justify-center">
                                        <div class="w-32 h-20 bg-gray-100 border border-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    </div>
                                `;
                                }
                            }

                            return data;
                        },
                        orderable: false,
                        searchable: false,
                        width: '150px'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            // Handle different status formats
                            let isPublished = false;

                            if (typeof data === 'string') {
                                isPublished = data.toLowerCase().includes('published') ||
                                    data.toLowerCase().includes('aktif') ||
                                    data.toLowerCase().includes('show');
                            } else if (typeof data === 'number') {
                                isPublished = data == 1;
                            } else if (typeof data === 'boolean') {
                                isPublished = data;
                            }

                            return isPublished ?
                                '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200"><i class="fas fa-eye w-3 h-3 mr-1.5"></i>Show</span>' :
                                '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200"><i class="fas fa-eye-slash w-3 h-3 mr-1.5"></i>Hidden</span>';
                        },
                        width: '100px'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        render: function(data, type, row) {
                            if (typeof data === 'string' && (data.includes('<button') || data
                                    .includes('<a'))) {
                                return data;
                            }

                            return `
                            <div class="flex items-center justify-center space-x-2 whitespace-nowrap">
                                <button 
                                    class="editBtn inline-flex items-center gap-1 px-1 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded" 
                                    data-id="${row.id}" 
                                    title="Edit">
                                    Edit
                                </button>
                                <button 
                                    class="deleteBtn inline-flex items-center gap-1 px-1 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded" 
                                    data-id="${row.id}" 
                                    title="Hapus">
                                    Hapus
                                </button>
                            </div>
                        `;
                        },
                        orderable: false,
                        searchable: false,
                        width: '160px'
                    }

                ],
                responsive: false,
                scrollX: true,
                initComplete: function() {
                    // Style the search input
                    $('.dataTables_filter input').attr('placeholder', 'Cari...')
                        .addClass('pl-10 pr-4')
                        .wrap('<div class="relative"></div>')
                    // .before(
                    //     '<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>'
                    // );

                    // Style the length select
                    $('.dataTables_length label').addClass(
                        'flex items-center gap-2 text-sm text-gray-700');
                    $('.dataTables_length select').addClass('text-sm');
                }
            });

            // Delete handler
            $('#beritaTable').on('click', '.deleteBtn', function() {
                const id = $(this).data('id');
                const button = $(this);

                if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                    // Show loading state
                    button.prop('disabled', true)
                        .removeClass('bg-red-500 hover:bg-red-600')
                        .addClass('bg-gray-400 cursor-not-allowed')
                        .html('<i class="fas fa-spinner fa-spin w-3 h-3 mr-1"></i>');

                    fetch(`/admin/berita/destroy/${id}`, {
                            method: 'delete', // ubah ke POST
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Accept': 'text/html'
                            }
                        })
                        .then(response => {
                            if (response.redirected || response.ok) {
                                table.ajax.reload();
                                showNotification('Berita berhasil dihapus!', 'success');
                            } else {
                                throw new Error('Gagal menghapus berita');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            showNotification('Terjadi kesalahan: ' + error.message, 'error');

                            button.prop('disabled', false)
                                .removeClass('bg-gray-400 cursor-not-allowed')
                                .addClass('bg-red-500 hover:bg-red-600')
                                .html('<i class="fas fa-trash w-3 h-3 mr-1"></i>Hapus');
                        });
                }
            });

            // Edit handler
            $('#beritaTable').on('click', '.editBtn', function() {
                const id = $(this).data('id');
                window.location.href = `/admin/berita/edit/${id}`;
            });

            // Notification system
            function showNotification(message, type) {
                const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

                const notification = $(`
                    <div class="notification fixed top-6 right-6 ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg z-50 transform translate-x-full transition-all duration-300 max-w-sm">
                        <div class="flex items-center">
                            <i class="fas ${icon} mr-3 text-lg"></i>
                            <span class="font-medium">${message}</span>
                        </div>
                    </div>
                `);

                $('body').append(notification);

                // Animate in
                setTimeout(() => {
                    notification.removeClass('translate-x-full').addClass('translate-x-0');
                }, 100);

                // Auto remove
                setTimeout(() => {
                    notification.removeClass('translate-x-0').addClass('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 4000);
            }
        });
    </script>

</body>

</html>
