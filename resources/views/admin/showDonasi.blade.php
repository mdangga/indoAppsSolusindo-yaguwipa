@extends('layouts.showAdmin')

@section('title', 'Donasi')

@section('header', 'Donasi')

@section('content')
    <table id="donasiTable" class="w-full border border-gray-300 ">
        <thead>
            <tr class="text-left">
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Donasi</th>
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
            let table = $('#donasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('donasi.table') }}',
                dom: '<"flex justify-between items-center mb-4"<"flex items-center"l><"flex items-center"f>>rt<"flex justify-between items-center mt-4"ip>',
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
                            return `<span class="text-gray-700">${meta.row + meta.settings._iDisplayStart + 1}</span>`;
                        },
                        orderable: false,
                        searchable: false,
                        width: '50px'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render: function(data) {
                            return `<div class="font-medium">${data || '-'}</div>`;
                        },
                        searchable: true,
                    },
                    {
                        data: 'jenis_donasi',
                        name: 'jenis_donasi',
                        render: function(data) {
                            return data || '-';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            const statusClasses = {
                                'pending': 'bg-yellow-100 text-yellow-800',
                                'verified': 'bg-green-100 text-green-800',
                                'rejected': 'bg-red-100 text-red-800',
                                'expired': 'bg-gray-100 text-gray-800'
                            };


                            const key = (data || '').toString().trim().toLowerCase();

                            return `<span class="px-2 py-1 rounded-full text-xs ${statusClasses[key] || 'bg-gray-100'}">
        ${data || 'Tidak Diketahui'}
    </span>`;
                        },
                        width: '120px'
                    },
                    {
                        data: 'id_donasi',
                        name: 'aksi',
                        render: function(data) {
                            const url = new URL(`{{ route('donasi.detail', ':id') }}`.replace(
                                ':id', data));
                            return `
        <div class="flex justify-center">
            <a href="${url}" 
               class="detailBtn inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg">
                <i class="fas fa-info-circle mr-2"></i> Detail
            </a>
        </div>`;
                        },
                        orderable: false,
                        width: '120px'
                    }
                ],
                responsive: true,
                initComplete: function() {
                    $('.dataTables_filter input')
                        .attr('placeholder', 'Cari...')
                        .addClass('pl-10 pr-4')
                        .wrap('<div class="relative"></div>')

                    $('.dataTables_length label').addClass(
                        'flex items-center gap-2 text-sm text-gray-700');
                    $('.dataTables_length select').addClass('text-sm');
                }
            });

            // Notification function
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
                setTimeout(() => notification.removeClass('translate-x-full'), 100);
                setTimeout(() => {
                    notification.addClass('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 4000);
            }
        });
    </script>
@endpush
