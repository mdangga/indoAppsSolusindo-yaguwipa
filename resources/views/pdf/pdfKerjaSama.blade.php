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
        @if ($site['logoData'])
            <img src="data:{{ $site['logoMime'] }};base64,{{ $site['logoData'] }}" alt="Watermark" class="watermark-logo">
        @endif
    </div>
    <!-- KOP SURAT -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td width="90" style="text-align: center;">
                    {{-- logo yayasan --}}
                    @if ($site['logoData'])
                        <img src="data:{{ $site['logoMime'] }};base64,{{ $site['logoData'] }}" alt="Logo Yayasan"
                            class="kop-logo" width="80">
                    @else
                        <div style="width:80px;height:80px;background:#eee;text-align:center;">
                            No Logo
                        </div>
                    @endif
                </td>
                <td>
                    <p class="kop-title">{{ strtoupper($site['yayasanProfile']->nama_yayasan) }}</p>
                    <p class="kop-subtitle">"{{ $site['yayasanProfile']->visi }}"</p>
                    <p class="kop-address">
                        {{ $site['yayasanProfile']->address }}<br>
                        Telp: {{ $site['yayasanProfile']->telephone }} | Email: {{ $site['yayasanProfile']->email }}<br>
                        Website: <a href="{{ $site['yayasanProfile']->website }}"
                            target="_blank">{{ $site['yayasanProfile']->website }}</a>
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
                <!-- Label Nomor -->
                <td style="width: 15%;">Nomor</td>
                <td style="width: 2%;">:</td>
                <td style="width: 53%;">
                    {{ sprintf('%03d', $kerjaSama->id_kerja_sama) }}/LAPORAN-KERJA-SAMA/{{ ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][
                        date('n', strtotime($kerjaSama->created_at))
                    ] }}/{{ date('Y', strtotime($kerjaSama->created_at)) }}
                </td>

                <!-- Tanggal di kanan -->
                <td style="width: 30%; text-align: right; white-space: nowrap;">
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <!-- Label Lampiran -->
                <td>Lampiran</td>
                <td>:</td>
                <td>-</td>
                <td></td>
            </tr>
        </table>


        <p class="document-title">LAPORAN KERJA SAMA</p>

        <table class="document-meta" style="width: 90%; margin: 0px auto 15px;">
            <tr>
            </tr>
            <tr>
                <td>Pengaju</td>
                <td>:</td>
                <td>{{ $kerjaSama->Mitra->User->nama }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td>:</td>
                <td>{{ $kerjaSama->Mitra->penanggung_jawab }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $kerjaSama->Mitra->jabatan_penanggung_jawab }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>{{ $kerjaSama->keterangan }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($kerjaSama->tanggal_mulai)->translatedFormat('j F Y') }} s.d.
                    {{ \Carbon\Carbon::parse($kerjaSama->tanggal_selesai)->translatedFormat('j F Y') }}</td>
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
                Dengan hormat, bersama surat ini kami sampaikan laporan mengenai kerja sama yang telah dilaksanakan
                antara {{ $site['yayasanProfile']->nama_yayasan }} dengan berbagai pihak terkait.
            </p>

            <p style="text-indent: 30px;">
                Kerja sama ini dilaksanakan pada periode
                {{ \Carbon\Carbon::parse($kerjaSama->tanggal_mulai)->translatedFormat('j F Y') }} sampai dengan
                {{ \Carbon\Carbon::parse($kerjaSama->tanggal_selesai)->translatedFormat('j F Y') }}.
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
