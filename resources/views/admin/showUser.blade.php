@extends('layouts.showAdmin')

@section('title', 'Admin - User')

@section('header', 'User')

@section('content')
    <table id="userTable" class="w-full border border-gray-300 ">
        <thead>
            <tr class="text-left">
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
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
            let table = $('#userTable').DataTable({
                processing: false,
                serverSide: true,
                autoWidth: false,
                ajax: '{{ route('user.table') }}',
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
                        data: 'username',
                        name: 'username',
                        render: function(data, type, row) {
                            return `<div class="font-semibold text-gray-900">${data}</div>`;
                        }
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render: function(data, type, row) {
                            return data || '-';
                        }
                    },
                    {
                        data: 'role',
                        name: 'role',
                        render: function(data) {
                            return data.charAt(0).toUpperCase() + data.slice(1);
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            const isActive = !row.deleted_at;
                            return isActive ?
                                '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200"><i class="fas fa-check-circle w-3 h-3 mr-1.5"></i>Aktif</span>' :
                                '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200"><i class="fas fa-times-circle w-3 h-3 mr-1.5"></i>Nonaktif</span>';
                        },
                        width: '100px'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        render: function(data, type, row) {
                            if (row.deleted_at) {
                                // Tombol untuk user nonaktif
                                return `
                        <div class="flex items-center justify-center space-x-2 whitespace-nowrap">
                            <button class="restoreBtn inline-flex items-center gap-1 px-2 py-1 bg-green-500 hover:bg-green-600 text-white text-xs font-semibold rounded" 
                                    data-id="${row.id_user}" 
                                    title="Aktifkan">
                                <i class="fas fa-undo w-3 h-3"></i>
                            </button>
                            <button class="forceDeleteBtn inline-flex items-center gap-1 px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded" 
                                    data-id="${row.id_user}" 
                                    title="Hapus Permanen">
                                <i class="fas fa-trash-alt w-3 h-3"></i>
                            </button>
                        </div>`;
                            } else {
                                // Tombol untuk user aktif
                                return `
                        <div class="flex items-center justify-center space-x-2 whitespace-nowrap">
                            <button class="deactivateBtn inline-flex items-center gap-1 px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded" 
                                    data-id="${row.id_user}" 
                                    title="Nonaktifkan">
                                <i class="fas fa-ban w-3 h-3"></i>
                            </button>
                        </div>`;
                            }
                        },
                        orderable: false,
                        searchable: false,
                        width: '160px'
                    }
                ],
                responsive: false,
                scrollX: true,
                initComplete: function() {
                    $('.dataTables_filter input')
                        .attr('placeholder', 'Cari...')
                        .addClass('pl-10 pr-4')
                        .wrap('<div class="relative"></div>');

                    $('.dataTables_length label').addClass(
                        'flex items-center gap-2 text-sm text-gray-700');
                    $('.dataTables_length select').addClass('text-sm');
                }
            });

            // Deactivate handler
            $('#userTable').on('click', '.deactivateBtn', function() {
                const id = $(this).data('id');
                const button = $(this);

                if (confirm('Apakah Anda yakin ingin menonaktifkan akun ini?')) {
                    // Show loading state
                    button.prop('disabled', true)
                        .removeClass('bg-red-500 hover:bg-red-600')
                        .addClass('bg-gray-400 cursor-not-allowed')
                        .html('<i class="fas fa-spinner fa-spin w-3 h-3 mr-1"></i>');

                    fetch(`/admin/deactivate-user/${id}`, {
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
                                showNotification('Akun berhasil dinonaktifkan!', 'success');
                            } else {
                                throw new Error('Gagal menonaktifkan user');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            showNotification('Terjadi kesalahan: ' + error.message, 'error');

                            button.prop('disabled', false)
                                .html('<i class="fas fa-ban w-3 h-3"></i>');
                        });
                }
            });

            // Restore handler
            $('#userTable').on('click', '.restoreBtn', function() {
                const id = $(this).data('id');
                const button = $(this);

                if (confirm('Apakah Anda yakin ingin mengaktifkan kembali user ini?')) {
                    button.prop('disabled', true)
                        .html('<i class="fas fa-spinner fa-spin w-3 h-3"></i>');

                    fetch(`/admin/restore-user/${id}`, {
                            method: 'post',
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
                                showNotification('User berhasil diaktifkan kembali!', 'success');
                            } else {
                                throw new Error('Gagal mengaktifkan user');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            showNotification('Terjadi kesalahan: ' + error.message, 'error');

                            button.prop('disabled', false)
                                .html('<i class="fas fa-undo w-3 h-3"></i>');
                        });
                }
            });

            // Force delete handler
            // $('#userTable').on('click', '.forceDeleteBtn', function() {
            //     const id = $(this).data('id');
            //     const button = $(this);

            //     if (confirm('Apakah Anda yakin ingin menghapus user ini secara permanen?')) {
            //         button.prop('disabled', true)
            //             .html('<i class="fas fa-spinner fa-spin w-3 h-3"></i>');

            //         $.ajax({
            //             url: `/admin/users/${id}/force-delete`,
            //             method: 'DELETE',
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             success: function(response) {
            //                 table.ajax.reload();
            //                 showNotification('User berhasil dihapus permanen', 'success');
            //             },
            //             error: function(xhr) {
            //                 showNotification('Gagal menghapus user: ' + xhr.responseJSON
            //                     .message, 'error');
            //                 button.prop('disabled', false).html(
            //                     '<i class="fas fa-trash-alt w-3 h-3"></i>');
            //             }
            //         });
            //     }
            // });

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

                setTimeout(() => {
                    notification.removeClass('translate-x-full').addClass('translate-x-0');
                }, 100);

                setTimeout(() => {
                    notification.removeClass('translate-x-0').addClass('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 4000);
            }
        });
    </script>
@endpush
