<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Donasi - Berbagi Kebaikan</title>
    @vite(['resources/css/app.css', 'resources/js/AOS.js', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'mono': ['Monaco', 'Menlo', 'Ubuntu Mono', 'monospace'],
                        'receipt': ['Courier New', 'monospace'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen py-8 font-mono">
    <div class="max-w-sm mx-auto px-4 print-container">
        <div class="h-4 relative overflow-hidden -mb-1">
            <svg class="absolute top-0 left-0 w-full h-6" viewBox="0 0 400 24" xmlns="http://www.w3.org/2000/svg"
                version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" transform="matrix(1,0,0,-1,0,0)">
                <path d="
    M0 0
    L0 24
    L20 24
    C 15 14, 5 14, 0 24
    L20 24
    C 25 14, 35 14, 40 24
    L60 24
    C 65 14, 75 14, 80 24
    L100 24
    C 105 14, 115 14, 120 24
    L140 24
    C 145 14, 155 14, 160 24
    L180 24
    C 185 14, 195 14, 200 24
    L220 24
    C 225 14, 235 14, 240 24
    L260 24
    C 265 14, 275 14, 280 24
    L300 24
    C 305 14, 315 14, 320 24
    L340 24
    C 345 14, 355 14, 360 24
    L380 24
    C 385 14, 395 14, 400 24
    L400 0
    Z" fill="white"></path>
            </svg>
        </div>
        <div class="bg-white relative">
            <div class="px-6 pt-4 pb-2 text-center border-b border-dashed border-gray-400">
                <h1 class="font-bold text-lg text-black mb-1 font-receipt">
                    {{ $site['yayasanProfile']->nama_yayasan }}
                </h1>
                <p class="text-xs text-gray-600 mb-2">{{ $site['yayasanProfile']->address }}</p>
                <div class="mt-3 mb-1">
                    <span class="text-black px-2 py-1 text-xs font-bold">STRUK DONASI</span>
                </div>
            </div>
            <div class="px-6 py-4 text-xs leading-relaxed">
                <div class="mb-4">
                    <div class="flex justify-between py-1">
                        <span class="text-gray-700">Tanggal:</span>
                        <span class="font-mono" id="paidAt" data-utc="{{ $donasi->DonasiDana->paid_at }}"></span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-gray-700">No. Transaksi:</span>
                        <span class="font-semibold">{{ "****" . substr($donasi->DonasiDana->payment_id, -10) }}</span>
                    </div>
                </div>
                <div class="border-b border-dashed border-gray-400 my-4"></div>
                <div class="mb-4">
                    <div class="flex justify-between py-1">
                        <span class="text-gray-700">Nama:</span>
                        <span class="font-semibold max-w-40 text-right">{{ $donasi->nama }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-gray-700">Campaign:</span>
                        <span class="max-w-40 text-right">{{ $donasi->Campaign->nama }}</span>
                    </div>
                </div>
                <div class="border-b border-dashed border-gray-400 my-4"></div>
                <div class="mb-4">
                    <div class="flex justify-between py-1">
                        <span>Donasi</span>
                        <span class="font-mono">Rp {{ number_format($donasi->DonasiDana->nominal ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span>Biaya Admin</span>
                        <span class="font-mono">Rp {{ number_format($donasi->DonasiDana->admin_fee ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="border-b border-solid border-black my-4"></div>
                <div class="mb-4">
                    <div class="flex justify-between items-center py-1">
                        <span class="font-bold text-lg text-black">TOTAL:</span>
                        <span class="font-bold text-lg font-mono">Rp {{ number_format($donasi->DonasiDana->nominal + $donasi->DonasiDana->admin_fee ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="border-b border-dashed border-gray-400 my-4"></div>
                <div class="mb-4">
                    <div class="flex justify-between py-1">
                        <span class="text-gray-700">Metode Bayar:</span>
                        <span class="font-semibold">{{ $donasi->DonasiDana->payment_method ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-gray-700">Status:</span>
                        @php
                            $status = $donasi->DonasiDana->status_verifikasi ?? 'UNKNOWN';
                            $statusDisplay = '';
                            $statusClass = '';
                            
                            switch(strtoupper($status)) {
                                case 'PAID':
                                    $statusDisplay = 'BERHASIL';
                                    $statusClass = 'font-bold text-green-600';
                                    break;
                                case 'VOIDED':
                                    $statusDisplay = 'DIBATALKAN';
                                    $statusClass = 'font-bold text-red-600';
                                    break;
                                default:
                                    $statusDisplay = strtoupper($status);
                                    $statusClass = 'font-bold text-yellow-600';
                                    break;
                            }
                        @endphp
                        <span class="{{ $statusClass }}">{{ $statusDisplay }}</span>
                    </div>
                </div>
                
                @if(strtoupper($donasi->DonasiDana->status_verifikasi ?? '') === 'PAID')
                <div class="text-center mt-4">
                    <p class="font-bold text-sm mb-2">TERIMA KASIH!</p>
                    <p class="text-xs text-gray-600">Donasi Anda sangat berarti</p>
                </div>
                @elseif(strtoupper($donasi->DonasiDana->status_verifikasi ?? '') === 'VOIDED')
                <div class="text-center mt-4">
                    <p class="font-bold text-sm mb-2 text-red-600">TRANSAKSI DIBATALKAN</p>
                    <p class="text-xs text-gray-600">Silakan lakukan donasi kembali</p>
                </div>
                @endif
            </div>

        </div>
        <div class="h-4 relative overflow-hidden">
            <svg class="absolute bottom-0 left-0 w-full h-6" viewBox="0 0 400 24" xmlns="http://www.w3.org/2000/svg"
                fill="none" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                transform="matrix(-1,0,0,-1,0,0)">
                <path d="
    M0 0
    L0 16
    C 5 6, 15 6, 20 16
    L40 16
    C 45 6, 55 6, 60 16
    L80 16
    C 85 6, 95 6, 100 16
    L120 16
    C 125 6, 135 6, 140 16
    L160 16
    C 165 6, 175 6, 180 16
    L200 16
    C 205 6, 215 6, 220 16
    L240 16
    C 245 6, 255 6, 260 16
    L280 16
    C 285 6, 295 6, 300 16
    L320 16
    C 325 6, 335 6, 340 16
    L360 16
    C 365 6, 375 6, 380 16
    L400 16
    L400 24
    L0 24
    Z" fill="white"></path>
            </svg>
        </div>

        <div class="mt-6 flex flex-col gap-3 print:hidden">
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition-colors shadow-md"
                onclick="window.print()">
                <i class="fas fa-print"></i>
                Cetak Struk
            </button>

            <button
                class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-6 py-3 rounded-lg font-medium text-sm flex items-center justify-center gap-2 transition-colors shadow-md"
                onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </button>
        </div>

        <div class="text-center mt-6 text-xs text-gray-500 leading-relaxed print:hidden">
            <p class="mb-1">Struk digital - Generated automatically</p>
            <p>Simpan atau cetak sebagai bukti donasi</p>
        </div>
    </div>

    <script>
        const printStyles = `
            @media print {
                @page {
                    size: 80mm auto;
                    margin: 0;
                }
                
                html, body { 
                    background: white !important; 
                    -webkit-print-color-adjust: exact;
                    margin: 0 !important;
                    padding: 0 !important;
                }
                
                .print\\:hidden { 
                    display: none !important; 
                }
                
                .max-w-sm {
                    max-width: 100% !important;
                    margin: 0 !important;
                }
                
                .print-container {
                    padding: 0 !important;
                }
                
                /* Hide browser elements */
                body::before,
                body::after {
                    display: none !important;
                }
            }
        `;

        const styleElement = document.createElement('style');
        styleElement.textContent = printStyles;
        document.head.appendChild(styleElement);

        // Date formatting function
        function convertUTCToLocal(utcTimeString) {
            const utcDate = new Date(utcTimeString + (utcTimeString.includes('UTC') ? '' : ' UTC'));
            const options = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };
            return new Intl.DateTimeFormat('id-ID', options).format(utcDate);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const paidAtElement = document.getElementById('paidAt');
            const paidAtUTC = paidAtElement.getAttribute('data-utc');
            if (paidAtUTC) paidAtElement.textContent = convertUTCToLocal(paidAtUTC);
        });
    </script>
</body>

</html>