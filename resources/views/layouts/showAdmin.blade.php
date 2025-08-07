<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/datatables-admin.css'])

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
        {{-- Alert --}}
        @if (session('success'))
            <div
                class="alert-success bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        <div class="py-4 border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Header -->
                <h2 class="text-3xl font-semibold text-gray-800">
                    @yield('header', 'Admin Header')
                </h2>

                @hasSection('button')
                    @yield('button')
                @endif
            </div>
        </div>
        <div class="bg-white border rounded-md border-gray-200 overflow-hidden">
            <!-- Table Container -->
            <div class="p-5 rounded-lg">
                <div class="table-container overflow-x-auto">
                    {{-- Content dari child --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    {{-- Script bawaan layout --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    {{-- Script tambahan halaman --}}
    @stack('scripts')
</body>

</html>
