<!DOCTYPE html>
<html lang="id">
@php
    \Carbon\Carbon::setLocale('id');
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

        .capitalized {
            text-transform: capitalize;
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

        .kop-container {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin: 0 25px;
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
            vertical-align: top;
        }

        .document-body p {
            text-align: justify;
            margin-bottom: 10px;
        }

        .ttd {
            width: 100%;
            margin-top: 32px;
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
                    {{ sprintf('%03d', $donasi->id_donasi) }}/LAPORAN-DONASI/{{ ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][date('n', strtotime($donasi->created_at))] }}/{{ date('Y', strtotime($donasi->created_at)) }}
                </td>
                <td style="width: 30%; text-align: right; white-space: nowrap;">
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>-</td>
                <td></td>
            </tr>
        </table>

        <p class="document-title">LAPORAN DONASI</p>

        <table class="document-meta" style="width: 80%; margin-bottom: 15px; text-indent: 30px">
            <tr>
                <td>Nama Donatur</td>
                <td>:</td>
                <td class="capitalized">{{ $donasi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Donasi</td>
                <td>:</td>
                <td>
                    {{ \Carbon\Carbon::parse($donasi->created_at)->translatedFormat('j F Y') }}
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

        {{-- <p style="text-indent: 30px;">
            Donasi ini dilaksanakan pada periode
            {{ \Carbon\Carbon::parse($donasi->tanggal_mulai)->translatedFormat('j F Y') }} sampai dengan
            {{ \Carbon\Carbon::parse($donasi->tanggal_selesai)->translatedFormat('j F Y') }}.
        </p> --}}

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
                <td>
                    <p>Hormat kami,</p>
                    <br><br><br>
                    <p><strong>Pimpinan {{ $site['yayasanProfile']->nama_yayasan }}</strong></p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
