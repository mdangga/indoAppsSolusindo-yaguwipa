<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
    Carbon::setLocale('id');

    // Helper bulan romawi
    function bulanRomawi($bulan)
    {
        $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $romawi[$bulan] ?? '';
    }
@endphp

<head>
    <meta charset="utf-8">
    <title>Kop Surat Resmi</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
            line-height: 1.5;
            color: #000;
        }

        .watermark-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            opacity: 0.03;
            pointer-events: none;
        }

        .watermark-logo {
            max-width: 100%;
            height: auto;
        }

        /* KOP SURAT */
        .kop-container {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-left: 25px;
            margin-right: 25px;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-table td {
            vertical-align: middle;
        }

        .kop-logo {
            width: 80px;
            height: auto;
        }

        .kop-title {
            font-size: 16pt;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

        .kop-subtitle {
            font-size: 11pt;
            text-align: center;
            font-style: italic;
            margin: 2px 0;
        }

        .kop-address {
            font-size: 10pt;
            text-align: center;
            margin: 5px 0 0;
            line-height: 1.4;
        }

        /* KONTEN SURAT */
        .document-content {
            padding: 0 25px;
        }

        .document-title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        .document-meta td {
            padding: 2px 5px;
            /* border: 2px solid black; */
            vertical-align: top;
            text-align: left;
        }

        .document-meta td:nth-child(1) {
            white-space: nowrap;
        }

        .document-body p {
            text-align: justify;
            margin-bottom: 10px;
        }

        .ttd {
            width: 100%;
            margin-top: 40px;
        }

        .ttd td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="watermark-container">
        @if (!empty($site['logoData']))
            <img src="data:{{ $site['logoMime'] }};base64,{{ $site['logoData'] }}" alt="Watermark" style="max-width:100%;">
        @endif
    </div>

    <!-- KOP SURAT -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td width="90" style="text-align: center;">
                    @if (!empty($site['logoData']))
                        <img src="data:{{ $site['logoMime'] }};base64,{{ $site['logoData'] }}" alt="Logo Yayasan"
                            class="kop-logo">
                    @else
                        <div style="width:80px;height:80px;background:#eee;text-align:center;line-height:80px;">No Logo
                        </div>
                    @endif
                </td>
                <td>
                    <p class="kop-title">{{ strtoupper($site['yayasanProfile']->nama_yayasan) }}</p>
                    <p class="kop-subtitle">"{{ $site['yayasanProfile']->visi }}"</p>
                    <p class="kop-address">
                        {{ $site['yayasanProfile']->address }}<br>
                        Telp: {{ $site['yayasanProfile']->telephone }} | Email: {{ $site['yayasanProfile']->email }}<br>
                        Website: {{ $site['yayasanProfile']->website }}
                    </p>
                </td>
                <td width="90"></td>
            </tr>
        </table>
    </div>

    <!-- ISI SURAT -->
    <div class="document-content">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 15%;">Nomor</td>
                <td style="width: 2%;">:</td>
                <td style="width: 53%;">
                    {{ sprintf('%03d', $donasi->id_donasi) }}/LAPORAN-DONASI/{{ bulanRomawi($donasi->created_at->month) }}/{{ $donasi->created_at->year }}
                </td>
                <td style="width: 30%; text-align: right; white-space: nowrap;">
                    {{ $donasi->approved_at ? \Carbon\Carbon::parse($donasi->approved_at)->setTimezone('Asia/Makassar')->translatedFormat('j F Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>
                    @if (strtolower($donasi->JenisDonasi->nama ?? '') === 'barang' && $donasi->DonasiBarang->isNotEmpty())
                        1 (satu)
                    @else
                        -
                    @endif
                </td>
                <td></td>
            </tr>
        </table>

        <p class="document-title">LAPORAN DONASI</p>

        <table class="document-meta" style="width: 80%; margin-bottom: 15px; margin-left: 30px">
            <tr>
                <td>Nama Donatur</td>
                <td>:</td>
                <td class="capitalized">{{ $donasi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Donasi</td>
                <td>:</td>
                <td>
                    {{ $donasi->created_at ? \Carbon\Carbon::parse($donasi->created_at)->setTimezone('Asia/Makassar')->translatedFormat('j F Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td>Jenis Donasi</td>
                <td>:</td>
                <td class="capitalized">{{ $donasi->JenisDonasi->nama ?? '-' }}</td>
            </tr>
            @if (strtolower($donasi->JenisDonasi->nama) === 'jasa')
                <tr>
                    <td>Jasa</td>
                    <td>:</td>
                    <td class="capitalized">{{ $donasi->DonasiJasa->jenis_jasa ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Durasi</td>
                    <td>:</td>
                    <td class="capitalized">{{ $donasi->DonasiJasa->durasi_jasa ?? '-' }}</td>
                </tr>
            @endif
            <tr>
                <td>Campaign</td>
                <td>:</td>
                <td class="capitalized">{{ $donasi->Campaign->nama ?? '-' }}</td>
            </tr>
        </table>

        <p style="text-indent: 30px;">
            Dengan hormat, bersama surat ini kami sampaikan laporan mengenai donasi yang telah diterima
            oleh {{ $site['yayasanProfile']->nama_yayasan }} dari para donatur yang telah berpartisipasi.
        </p>

        <p style="text-indent: 30px;">
            Status donasi saat ini adalah <strong>{{ ucfirst($donasi->status) }}</strong>
            @if ($donasi->status !== 'approved' && !empty($donasi->alasan))
                dengan catatan: "{{ $donasi->alasan }}"
            @endif.
        </p>

        <p style="text-indent: 30px;">
            Seluruh donasi telah disalurkan sesuai dengan peruntukan yang direncanakan, guna mendukung kegiatan sosial
            dan kemanusiaan yang dilaksanakan oleh {{ $site['yayasanProfile']->nama_yayasan }}.
        </p>

        <p style="text-indent: 30px;">
            Demikian laporan ini kami sampaikan. Atas perhatian, kepedulian, dan dukungan yang diberikan,
            kami ucapkan terima kasih yang sebesar-besarnya.
        </p>
        <p style="text-indent: 30px;">
            Semoga kerja sama ini dapat terus berlanjut dan memberikan manfaat yang lebih besar bagi masyarakat.
        </p>

        <!-- TANDA TANGAN -->
        <table class="ttd">
            <tr>
                <td width="60%"></td>
                <td style="text-align: left;">
                    <p>{{ $site['yayasanProfile']->kota ?? 'Denpasar' }},
                        {{ $donasi->approved_at
                            ? \Carbon\Carbon::parse($donasi->approved_at)->setTimezone('Asia/Makassar')->translatedFormat('j F Y')
                            : '-' }}
                        WITA
                    </p>
                    <p>Hormat kami,</p>
                    <br><br><br>
                    <p><strong>Pimpinan {{ $site['yayasanProfile']->nama_yayasan }}</strong></p>
                </td>
            </tr>
        </table>

        {{-- Lampiran Barang --}}
        @if (strtolower($donasi->JenisDonasi->nama ?? '') === 'barang' && !empty($donasi->DonasiBarang))
            <br><br>
            <p><strong>Lampiran:</strong></p>
            <table border="1" cellspacing="0" cellpadding="5"
                style="width: 100%; border-collapse: collapse; font-size: 11pt; text-align: center;">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 40%;">Nama Barang</th>
                        <th style="width: 20%;">Jumlah</th>
                        <th style="width: 30%;">Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donasi->DonasiBarang as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="capitalized">{{ $barang->nama_barang ?? '-' }}</td>
                            <td>{{ $barang->jumlah_barang ?? '-' }}</td>
                            <td class="capitalized">{{ $barang->kondisi ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
