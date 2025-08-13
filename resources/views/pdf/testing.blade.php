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

        /* KOP SURAT */
        .kop-container {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
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
            vertical-align: top;
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
    <!-- KOP SURAT -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td width="90" style="text-align: center;">
                    <img src="file://{{ public_path('storage/' . $site['yayasanProfile']->logo) }}"
                         alt="Logo Yayasan" class="kop-logo">
                </td>
                <td>
                    <p class="kop-title">{{ strtoupper($site['yayasanProfile']->nama_yayasan) }}</p>
                    <p class="kop-subtitle">"{{ $site['yayasanProfile']->visi }}"</p>
                    <p class="kop-address">
                        {{ $site['yayasanProfile']->address }}<br>
                        Telp: {{ $site['yayasanProfile']->telephone }} | Email: {{ $site['yayasanProfile']->email }}<br>
                        Website: <a href="{{ $site['yayasanProfile']->website }}" target="_blank">{{ $site['yayasanProfile']->website }}</a>
                    </p>
                </td>
                <td width="90"></td>
            </tr>
        </table>
    </div>

    <!-- ISI SURAT -->
    <div class="document-content">
        <p class="document-title">LAPORAN KERJA SAMA</p>

        <table class="document-meta" style="width: 100%; margin-bottom: 15px;">
            <tr>
                <td width="20%">Nomor</td>
                <td width="1%">:</td>
                <td>{{ sprintf('%03d', $kerjaSama->id_kerja_sama) }}/LAPORAN-KERJA-SAMA/{{ date('Y', strtotime($kerjaSama->created_at)) }}</td>
            </tr>
            <tr>
                <td>Pengaju</td>
                <td>:</td>
                <td>{{ $kerjaSama->Mitra->User->nama }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>{{ $kerjaSama->keterangan }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($kerjaSama->tanggal_mulai)->translatedFormat('j F Y') }} s.d. {{ \Carbon\Carbon::parse($kerjaSama->tanggal_selesai)->translatedFormat('j F Y') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>{{ ucfirst($kerjaSama->status) }}</td>
            </tr>
            @if ($kerjaSama->alasan)
            <tr>
                <td>Alasan</td>
                <td>:</td>
                <td>{{ $kerjaSama->alasan }}</td>
            </tr>
            @endif
        </table>

        <div class="document-body">
            <p style="text-indent: 30px;">
                Dengan hormat, bersama surat ini kami sampaikan laporan mengenai kerja sama yang telah dilaksanakan antara {{ $site['yayasanProfile']->nama_yayasan }} dengan berbagai pihak terkait.
            </p>

            <p style="text-indent: 30px;">
                Kerja sama ini dilaksanakan pada periode {{ \Carbon\Carbon::parse($kerjaSama->tanggal_mulai)->translatedFormat('j F Y') }} sampai dengan {{ \Carbon\Carbon::parse($kerjaSama->tanggal_selesai)->translatedFormat('j F Y') }}.
            </p>

            <p style="text-indent: 30px;">
                Status kerja sama saat ini adalah <strong>{{ ucfirst($kerjaSama->status) }}</strong>
                @if ($kerjaSama->status !== 'approved' && $kerjaSama->alasan)
                    dengan alasan: "{{ $kerjaSama->alasan }}"
                @endif.
            </p>

            <p style="text-indent: 30px;">
                Demikian laporan ini kami sampaikan. Atas perhatian dan kerja sama yang baik, kami ucapkan terima kasih.
            </p>
        </div>

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
