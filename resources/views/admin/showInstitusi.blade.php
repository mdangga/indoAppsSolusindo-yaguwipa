@extends('layouts.showAdmin')

@section('title', 'Admin - Institusi')

@section('header', 'Institusi')

@section('button')
    <a href="{{ route('institusi.formStore') }}"
        class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
        <i class="fas fa-plus w-4 h-4 mr-2"></i>
        Tambah Institusi
    </a>
@endsection

@section('content')
    <table id="institusiTable" class="w-full border border-gray-300 ">
        <thead>
            <tr class="text-left">
                <th>No</th>
                <th>Nama</th>
                <th>Logo</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#institusiTable').DataTable({
                processing: false,
                serverSide: true,
                autoWidth: false,
                ajax: '{{ route('institusi.table') }}',
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
                    emptyTable: '<div class="text-center py-8"><i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i><p class="text-gray-500">Belum ada data</p></div>',
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
                        data: 'nama',
                        name: 'nama',
                        render: function(data, type, row) {
                            return `
                                <div class="">
                                    <h3 class="font-semibold text-gray-900 leading-tight">${data}</h3>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'profile_path',
                        name: 'profile_path',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                if (data && typeof data === 'string') {
                                    return `
                                        <div class="flex justify-center">
                                            <img loading="lazy" src="${data}" alt="Thumbnail"
                                                class="w-32 h-20 object-cover border border-gray-200 shadow-sm rounded"
                                                onerror="this.parentElement.innerHTML = \`<div class='w-32 h-20 bg-gray-100 text-gray-500 text-sm flex items-center justify-center border border-gray-300 rounded text-[12px]'>Tidak ada gambar</div>\`;">
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
                    $('.dataTables_filter input').attr('placeholder', 'Cari...')
                        .addClass('pl-10 pr-4')
                        .wrap('<div class="relative"></div>')

                    // Style the length select
                    $('.dataTables_length label').addClass(
                        'flex items-center gap-2 text-sm text-gray-700');
                    $('.dataTables_length select').addClass('text-sm');
                }
            });

            // Delete handler
            $('#institusiTable').on('click', '.deleteBtn', function() {
                const id = $(this).data('id');
                const button = $(this);

                if (confirm('Apakah Anda yakin ingin menghapus institusi ini?')) {
                    // Show loading state
                    button.prop('disabled', true)
                        .removeClass('bg-red-500 hover:bg-red-600')
                        .addClass('bg-gray-400 cursor-not-allowed')
                        .html('<i class="fas fa-spinner fa-spin w-3 h-3 mr-1"></i>');

                    fetch(`/admin/institusi-terlibat/destroy/${id}`, {
                            method: 'delete',
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
                                showNotification('Institusi berhasil dihapus!', 'success');
                            } else {
                                throw new Error('Gagal menghapus institusi');
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
            $('#institusiTable').on('click', '.editBtn', function() {
                const id = $(this).data('id');
                window.location.href = `/admin/institusi-terlibat/edit/${id}`;
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
@endpush
