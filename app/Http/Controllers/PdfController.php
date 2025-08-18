<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\FilePenunjang;
use App\Models\KerjaSama;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use STS\ZipStream\Facades\Zip;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function testing($id)
    {
        $donasi = Donasi::with('Campaign', 'JenisDonasi', 'DonasiBarang','DonasiJasa')->findOrFail($id);
        $tanggal = Carbon::now()->format('Ymd');

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

        $pdf = Pdf::loadView('pdf.pdfLapDonasi', [
            'donasi' => $donasi,

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

        return $pdf->stream("test.pdf");
    }

    public function downloadZipStream($id, $nama = '')
    {
        try {
            $files = FilePenunjang::where('id_kerja_sama', $id)->get();

            // dd($files);
            if ($files->isEmpty()) {
                return back()->with('error', 'Tidak ada file pendukung yang ditemukan untuk kerja sama ini.');
            }

            $zipFiles = [];

            foreach ($files as $file) {
                $absolutePath = Storage::disk('public')->path($file->file_path);

                if (file_exists($absolutePath)) {
                    $zipFiles[$absolutePath] = basename($file->file_path);
                } else {
                    Log::warning("File not found: {$file->file_path}");
                }
            }

            if (empty($zipFiles)) {
                return back()->with('error', 'Semua file pendukung tidak ditemukan di penyimpanan.');
            }

            return Zip::create("Kumpulan_Lampiran_File_Kerjasama_{$nama}.zip", $zipFiles);
        } catch (\Exception $e) {
            Log::error("Failed to create zip for kerja_sama {$nama}: " . $e->getMessage());
            return back()->with('error', 'Gagal membuat arsip ZIP: ' . $e->getMessage());
        }
    }
}
