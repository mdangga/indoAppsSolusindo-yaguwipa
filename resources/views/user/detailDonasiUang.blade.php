<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Donasi - Berbagi Kebaikan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 1rem 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 384px;
            width: 100%;
            padding: 0 16px;
        }

        /* Efek gerigi yang lebih halus menggunakan clip-path dengan kurva smooth */
        .receipt-paper {
            position: relative;
            background: white;
            overflow: visible;
            clip-path: 
                polygon(
                    0% 1.5%, 2% 0%, 4% 1%, 6% 0%, 8% 1%, 10% 0%, 12% 1%, 14% 0%, 16% 1%, 18% 0%, 20% 1%, 22% 0%, 24% 1%, 26% 0%, 28% 1%, 30% 0%, 32% 1%, 34% 0%, 36% 1%, 38% 0%, 40% 1%, 42% 0%, 44% 1%, 46% 0%, 48% 1%, 50% 0%, 52% 1%, 54% 0%, 56% 1%, 58% 0%, 60% 1%, 62% 0%, 64% 1%, 66% 0%, 68% 1%, 70% 0%, 72% 1%, 74% 0%, 76% 1%, 78% 0%, 80% 1%, 82% 0%, 84% 1%, 86% 0%, 88% 1%, 90% 0%, 92% 1%, 94% 0%, 96% 1%, 98% 0%, 100% 1.5%,
                    100% 98.5%, 98% 100%, 96% 99%, 94% 100%, 92% 99%, 90% 100%, 88% 99%, 86% 100%, 84% 99%, 82% 100%, 80% 99%, 78% 100%, 76% 99%, 74% 100%, 72% 99%, 70% 100%, 68% 99%, 66% 100%, 64% 99%, 62% 100%, 60% 99%, 58% 100%, 56% 99%, 54% 100%, 52% 99%, 50% 100%, 48% 99%, 46% 100%, 44% 99%, 42% 100%, 40% 99%, 38% 100%, 36% 99%, 34% 100%, 32% 99%, 30% 100%, 28% 99%, 26% 100%, 24% 99%, 22% 100%, 20% 99%, 18% 100%, 16% 99%, 14% 100%, 12% 99%, 10% 100%, 8% 99%, 6% 100%, 4% 99%, 2% 100%, 0% 98.5%
                );
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            opacity: 0.04;
            z-index: 1;
            pointer-events: none;
            font-size: 48px;
            text-align: center;
        }

        .gradient-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #0ea5e9 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Efek bayangan yang lebih halus */
        .soft-shadow {
            box-shadow: 
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 10px 15px -3px rgba(0, 0, 0, 0.08),
                0 20px 25px -5px rgba(0, 0, 0, 0.06);
        }

        /* Hover effects */
        button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.2) !important;
        }

        button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        @media print {
            body {
                font-size: 12px;
                background: white !important;
                display: block;
                padding: 0;
            }
            
            .container {
                max-width: 100%;
                padding: 0;
            }

            .print\:hidden {
                display: none !important;
            }

            .soft-shadow {
                box-shadow: none !important;
            }

            .watermark {
                opacity: 0.08 !important;
            }
            
            .receipt-paper {
                clip-path: none;
                border: 1px solid #ddd !important;
            }
        }
        
        @media (max-width: 420px) {
            body {
                padding: 8px 0;
            }
            
            .container {
                padding: 0 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Receipt Card dengan Efek Gerigi Halus -->
        <div class="receipt-paper soft-shadow"
            style="border: 1px solid #e5e7eb; border-radius: 0; position: relative; margin: 20px 0; padding: 15px 0; overflow: visible; background: white;">

            <!-- Watermark -->
            <div class="watermark">
                <i class="fas fa-heart" style="color: #e5e7eb;"></i>
                <div
                    style="font-size: 24px; font-weight: bold; color: #e5e7eb; margin-top: 8px; font-family: 'Instrument Sans', sans-serif;">
                    YAYASAN
                </div>
                <div
                    style="font-size: 18px; font-weight: 500; color: #e5e7eb; margin-top: 4px; font-family: 'Instrument Sans', sans-serif;">
                    BERBAGI KASIH
                </div>
            </div>

            <!-- Header -->
            <div class="gradient-header"
                style="padding: 1.5rem; text-align: center; color: white; position: relative; z-index: 2;">
                <div
                    style="width: 48px; height: 48px; margin: 0 auto 12px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-heart" style="color: #ef4444; font-size: 20px;"></i>
                </div>
                <h1 style="font-size: 1.125rem; font-weight: 600; margin: 0 0 4px;">Yayasan Berbagi Kasih</h1>
                <p style="color: #e0e7ff; font-size: 0.875rem; margin: 0;">Transaksi Berhasil</p>
            </div>

            <!-- Content -->
            <div style="padding: 1.5rem; font-size: 0.875rem; position: relative; z-index: 2;">

                <!-- Transaction Info -->
                <div style="border-bottom: 1px dashed #d1d5db; padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span style="color: #6b7280;">Tanggal</span>
                        <span style="font-weight: 500; color: #374151;">{{ $transaction_date ?? '2024-01-15 14:30:25 WIB' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #6b7280;">Nomor Referensi</span>
                        <span style="font-weight: 600; color: #7c3aed;">#{{ $reference_number ?? 'DON2024-001234' }}</span>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div style="margin-bottom: 1rem; border-bottom: 1px dashed #d1d5db; padding-bottom: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: #6b7280;">Nama Donatur</span>
                        <span style="font-weight: 500; color: #374151;">{{ $donor_name ?? 'Ahmad Hidayat' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: #6b7280;">Jenis Transaksi</span>
                        <span style="font-weight: 500; color: #374151;">{{ $transaction_type ?? 'Donasi Online' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: #6b7280;">Metode Bayar</span>
                        <span style="font-weight: 500; color: #374151;">{{ $payment_method ?? 'TRANSFER BANK' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: #6b7280;">Email</span>
                        <span style="font-weight: 500; color: #374151;">{{ $email ?? 'ahmad@email.com' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #6b7280;">Program</span>
                        <span style="font-weight: 500; color: #374151;">{{ $program ?? 'Pendidikan Anak' }}</span>
                    </div>
                </div>

                <!-- Amount Details -->
                <div style="margin-bottom: 1rem; border-bottom: 1px dashed #d1d5db; padding-bottom: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: #6b7280;">Nominal Donasi</span>
                        <span style="font-weight: 500; color: #374151;">Rp {{ number_format($donation_amount ?? 500000, 0, ',', '.') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #6b7280;">Biaya Admin</span>
                        <span style="font-weight: 500; color: #10b981;">Rp {{ number_format($admin_fee ?? 0, 0, ',', '.') }} (Gratis)</span>
                    </div>
                </div>

                <!-- Status -->
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px dashed #d1d5db; padding-bottom: 1rem;">
                    <span style="color: #6b7280;">Status</span>
                    <span
                        style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #065f46; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; border: 1px solid #10b981;">
                        ✓ {{ $status ?? 'BERHASIL' }}
                    </span>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6b7280;">Tanggal Dibayar</span>
                    <span style="font-weight: 500; color: #10b981;">{{ $payment_date ?? '2024-01-15 14:31:10 WIB' }}</span>
                </div>

                <!-- Total -->
                <div
                    style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); margin: 0 -1.5rem; padding: 1rem 1.5rem; border-top: 2px solid #e5e7eb;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: #374151; font-size: 1rem;">Total Donasi</span>
                        <span class="gradient-text" style="font-weight: 700; font-size: 1.25rem;">Rp {{ number_format($total_amount ?? 500000, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="margin-top: 1rem;" class="print:hidden">
            <button onclick="window.print()"
                style="width: 100%; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; padding: 12px; border: none; border-radius: 12px; font-weight: 500; font-size: 0.95rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-bottom: 8px;">
                <i class="fas fa-print"></i> Cetak Struk
            </button>

            <div style="display: flex; gap: 8px;">
                <button id="saveButton"
                    style="flex: 1; background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 10px; border: none; border-radius: 8px; font-weight: 500; font-size: 0.875rem; cursor: pointer;">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button id="backButton"
                    style="flex: 1; background: #f8fafc; color: #475569; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; font-weight: 500; font-size: 0.875rem; cursor: pointer;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
            </div>
        </div>

        <!-- Footer Info -->
        <div style="text-align: center; margin-top: 1rem; font-size: 0.75rem; color: #94a3b8;" class="print:hidden">
            <p style="margin: 0 0 4px;">Struk ini digenerate otomatis oleh sistem</p>
            <p style="margin: 0;">Simpan struk ini sebagai bukti donasi yang sah</p>
        </div>
    </div>

    <script>
        // Fungsi untuk mengatur animasi masuk
        function setupEntranceAnimation() {
            const receiptCard = document.querySelector('.receipt-paper');
            receiptCard.style.opacity = '0';
            receiptCard.style.transform = 'translateY(30px) scale(0.95)';
            
            setTimeout(() => {
                receiptCard.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                receiptCard.style.opacity = '1';
                receiptCard.style.transform = 'translateY(0) scale(1)';
            }, 150);
        }

        // Fungsi untuk mengatur efek hover pada tombol
        function setupButtonHoverEffects() {
            document.querySelectorAll('button').forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                    this.style.boxShadow = '0 8px 15px -3px rgba(0, 0, 0, 0.2)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
                });
            });
        }

        // Fungsi untuk mengatur efek ripple pada tombol
        function setupRippleEffects() {
            document.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.pointerEvents = 'none';
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        }

        // Fungsi untuk mengatur tombol kembali
        function setupBackButton() {
            document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });
        }

        // Fungsi untuk mengatur tombol simpan
        function setupSaveButton() {
            document.getElementById('saveButton').addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check"></i> Tersimpan';
                this.style.background = 'linear-gradient(135deg, #059669, #047857)';
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-save"></i> Simpan';
                    this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                }, 2000);
            });
        }

        // Inisialisasi ketika halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            setupEntranceAnimation();
            setupButtonHoverEffects();
            setupRippleEffects();
            setupBackButton();
            setupSaveButton();
        });

        // CSS untuk animasi ripple
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
    </script>
</body>

</html>