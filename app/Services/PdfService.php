<?php

namespace App\Services;

use App\Models\FilePenunjang;
use App\Models\KerjaSama;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    // PdfService.php
    public function generateKerjaSama(int $id)
    {
        $kerjaSama = KerjaSama::with('Mitra.User')->findOrFail($id);
        $tanggal = Carbon::now()->format('Y-m-d');

        // Ambil data profil yayasan dari variabel global view
        $yayasanProfile = view()->shared('site')['yayasanProfile'];

        // Siapkan logo jika ada
        $logoPath = storage_path('app/public/' . $yayasanProfile->logo);
        $logoData = null;
        $logoMime = null;

        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoMime = mime_content_type($logoPath);
        }

        // Generate PDF
        $pdf = Pdf::loadView('pdf.testing', [
            'kerjaSama' => $kerjaSama,
            'tanggal' => $tanggal,
            'site' => [
                'yayasanProfile' => $yayasanProfile,
                'logoData' => $logoData,
                'logoMime' => $logoMime
            ]
        ])
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif',
            ]);

        // Simpan ke storage
        $pdfContent = $pdf->output();
        $filename = "Laporan_{$kerjaSama->Mitra->User->nama}_{$tanggal}.pdf";
        $path = "file_kerja_sama/{$filename}";

        Storage::disk('public')->put($path, $pdfContent);

        // Simpan ke database
        FilePenunjang::create([
            'id_kerja_sama' => $kerjaSama->id_kerja_sama,
            'file_path' => $path,
            'nama_file' => $filename,
            'file_size' => strlen($pdfContent),
        ]);

        return redirect()->back()->with('success', 'PDF berhasil dibuat dan disimpan.');
    }
}
