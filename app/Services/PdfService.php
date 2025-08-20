<?php

namespace App\Services;

use App\Models\FilePenunjang;
use App\Models\KerjaSama;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfService
{
    // PdfService.php
    public function generateKerjaSama(int $id)
    {
        $kerjaSama = KerjaSama::with('Mitra.User')->findOrFail($id);
        $tanggal = now()->format('dmY');

        $yayasanProfile = view()->shared('site')['yayasanProfile'];

        $logoPath = storage_path('app/public/' . $yayasanProfile->logo);
        $logoData = null;
        $logoMime = null;

        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoMime = mime_content_type($logoPath);
        }

        // Generate PDF
        $pdf = Pdf::loadView('pdf.pdfKerjaSama', [
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
        $namaUser = Str::slug($kerjaSama->Mitra->User->nama, '_');
        $filename = "laporan_{$namaUser}_{$tanggal}.pdf";
        $oldFile = FilePenunjang::where('id_kerja_sama', $kerjaSama->id_kerja_sama)
            ->where('nama_file', 'LIKE', "laporan_%")
            ->first();

        if ($oldFile) {
            Storage::disk('local')->delete($oldFile->file_path);
        }

        $path = "file_kerja_sama/{$filename}";
        Storage::disk('local')->put($path, $pdfContent);

        if ($oldFile) {
            $oldFile->update([
                'file_path' => $path,
                'nama_file' => $filename,
                'file_size' => strlen($pdfContent),
            ]);
        } else {
            FilePenunjang::create([
                'id_kerja_sama' => $kerjaSama->id_kerja_sama,
                'file_path' => $path,
                'nama_file' => $filename,
                'file_size' => strlen($pdfContent),
            ]);
        }

        return redirect()->back()->with('success', 'PDF berhasil dibuat dan disimpan.');
    }
}
