<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Donasi - Berbagi Kebaikan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600&family=space-grotesk:300,400,500,600"
        rel="stylesheet" />
    <style>
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #4a4a4a;
            --accent-color: #6366f1;
            --success-color: #10b981;
            --border-light: #e5e7eb;
            --bg-subtle: #f8fafc;
            --text-muted: #64748b;
            --shadow-elegant: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 20px 25px -5px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #fafafa 0%, #f4f4f5 100%);
            min-height: 100vh;
            padding: 2rem 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--primary-color);
        }

        .container {
            max-width: 420px;
            width: 100%;
            padding: 0 24px;
        }

        .receipt-paper {
            position: relative;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-elegant);
            border: 1px solid var(--border-light);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .receipt-paper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--border-light);
            border-radius: 0 0 8px 8px;
            z-index: 3;
        }

        .receipt-paper::after {
            content: '';
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23e5e7eb" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>') no-repeat center;
            background-size: contain;
            opacity: 0.08;
            z-index: 1;
            pointer-events: none;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, var(--bg-subtle) 100%);
            padding: 2rem 2rem 1.5rem;
            text-align: center;
            position: relative;
            z-index: 2;
            border-bottom: 1px solid var(--border-light);
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 1px;
            background: var(--accent-color);
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .logo-icon {
            color: var(--accent-color);
            font-size: 24px;
            z-index: 1;
        }

        .title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 8px;
            color: var(--primary-color);
            letter-spacing: -0.025em;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 400;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .content {
            padding: 2rem;
            position: relative;
            z-index: 2;
        }

        .section {
            position: relative;
        }

        .separator {
            margin-bottom: 2rem;
            margin-top: 1.5rem;
            border-bottom: 1px dashed var(--border-light);
        }

        .section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            gap: 16px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .label {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 400;
            flex-shrink: 0;
        }

        .value {
            /* font-weight: 500; */
            color: var(--primary-color);
            font-size: 0.875rem;
            text-align: right;
            word-break: break-word;
        }

        .value.highlight {
            color: var(--accent-color);
            font-weight: 600;
        }

        .value.success {
            color: var(--success-color);
        }

        .status-badge {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            color: #166534;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid #bbf7d0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .total-section {
            background: linear-gradient(135deg, #fafafa, #f4f4f5);
            margin: 0 -2rem -2rem;
            padding: 2rem;
            border-top: 2px solid var(--border-light);
            position: relative;
        }

        .total-section::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: var(--accent-color);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.125rem;
        }

        .total-amount {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .actions {
            margin-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            padding: 14px 20px;
            border: none;
            border-radius: 16px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-secondary {
            background: white;
            color: var(--secondary-color);
            border: 2px solid var(--border-light);
            flex: 1;
        }

        .btn-secondary:hover {
            background: var(--bg-subtle);
            border-color: var(--text-muted);
            transform: translateY(-1px);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
            flex: 1;
        }

        .btn-success:hover {
            transform: translateY(-1px);
        }

        .button-row {
            display: flex;
            gap: 12px;
        }

        .footer-info {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .footer-info p {
            margin: 0 0 6px;
        }

        /* Animations */
        .receipt-paper {
            opacity: 0;
            transform: translateY(20px) scale(0.98);
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .content>* {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .content>*:nth-child(1) {
            animation-delay: 0.1s;
        }

        .content>*:nth-child(2) {
            animation-delay: 0.15s;
        }

        .content>*:nth-child(3) {
            animation-delay: 0.2s;
        }

        .content>*:nth-child(4) {
            animation-delay: 0.25s;
        }

        .content>*:nth-child(5) {
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white !important;
                padding: 0;
            }

            .container {
                max-width: 100%;
                padding: 0;
            }

            .receipt-paper {
                box-shadow: none !important;
                border: 1px solid #ddd;
                border-radius: 0;
            }

            .print\\:hidden {
                display: none !important;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem 0;
            }

            .container {
                padding: 0 16px;
            }

            .content {
                padding: 1.5rem;
            }

            .header {
                padding: 1.5rem 1.5rem 1rem;
            }

            .total-section {
                margin: 0 -1.5rem -1.5rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Receipt Card -->
        <div class="receipt-paper">
            <!-- Header -->
            <div class="header">
                {{-- <img src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" class="w-5 h-5" alt=""> --}}
                <h1 class="title">{{ $site['yayasanProfile']->nama_yayasan }}</h1>
                <p class="subtitle" style="font-size: 12px; color: var(--success-color); font-weight: 600">
                    <i class="fas fa-check-circle"></i>
                    Transaksi Berhasil
                </p>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Transaction Info -->
                <div class="section" style="margin-bottom: 1rem;">
                    <div class="info-row">
                        <span class="label">Tanggal</span>
                        <span class="value" id="createdAt" data-utc="{{ $donasi->DonasiDana->created_at }}">
                        </span>
                    </div>
                </div>

                <!-- Donor Details -->
                <div class="section">
                    <div class="info-row">
                        <span class="label">Nama Donatur</span>
                        <span class="value">{{ $donasi->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Email</span>
                        <span class="value">{{ $donasi->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Campaign</span>
                        <span class="value">{{ $donasi->Campaign->nama }}</span>
                    </div>
                </div>

                <div class="separator"></div>
                <!-- Payment Details -->
                <div class="section">
                    <div class="info-row">
                        <span class="label">Metode Bayar</span>
                        <span class="value">{{ $donasi->DonasiDana->payment_method }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Nominal Donasi</span>
                        <span class="value">Rp. {{ $donasi->DonasiDana->nominal }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Biaya Admin</span>
                        <span class="value success">Rp {{ $donasi->DonasiDana->admin_fee }}</span>
                    </div>
                </div>
                <div class="separator"></div>
                <!-- Status -->
                <div class="section" style="margin-bottom: 2rem;">
                    <div class="info-row" style="display: flex; align-items: center;">
                        <span class="label">Status</span>
                        <span class="status-badge">
                            <i class="fas fa-check"></i>
                            BERHASIL
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="label">Tanggal Dibayar</span>
                        <span class="value success" id="paidAt" data-utc="{{ $donasi->DonasiDana->paid_at }}">
                        </span>
                    </div>
                </div>

                <!-- Total -->
                <div class="total-section">
                    <div class="total-row" style="display: flex; align-items: center;">
                        <span class="total-label">Total Donasi</span>
                        <span class="total-amount">
                            Rp
                            {{ number_format($donasi->DonasiDana->nominal + $donasi->DonasiDana->admin_fee, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="actions print:hidden">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i>
                Cetak Struk
            </button>

            <button class="btn btn-secondary" id="backButton">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </button>
        </div>

        <!-- Footer Info -->
        <div class="footer-info print:hidden">
            <p>Struk ini digenerate otomatis oleh sistem</p>
            <p>Simpan struk ini sebagai bukti donasi yang sah</p>
        </div>
    </div>

    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });

        // Enhanced button hover effects
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                // Ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.4);
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // CSS animation for ripple
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // convert Time
        function convertUTCToLocal(utcTimeString) {
            const utcDate = new Date(utcTimeString + (utcTimeString.includes('UTC') ? '' : ' UTC'));
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            const formatter = new Intl.DateTimeFormat('us-US', options);
            const formattedDate = formatter.format(utcDate);
            const timezoneName = Intl.DateTimeFormat().resolvedOptions().timeZone;

            return `${formattedDate} (${timezoneName})`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Konversi created_at
            const createdAtElement = document.getElementById('createdAt');
            const createdAtUTC = createdAtElement.getAttribute('data-utc');
            if (createdAtUTC) {
                createdAtElement.textContent = convertUTCToLocal(createdAtUTC);
            }

            // Konversi paid_at
            const paidAtElement = document.getElementById('paidAt');
            const paidAtUTC = paidAtElement.getAttribute('data-utc');
            if (paidAtUTC) {
                paidAtElement.textContent = convertUTCToLocal(paidAtUTC);
            }
        });
    </script>
</body>

</html>
