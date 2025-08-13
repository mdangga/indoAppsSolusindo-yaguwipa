<?php

namespace App\Http\Controllers;

use App\Models\FilePenunjang;
use Illuminate\Support\Facades\Log;
use STS\ZipStream\Facades\Zip;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{

    public function downloadZipStream($id)
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
                    $zipFiles[$absolutePath] = basename($file->file_path); // [path => filename]
                } else {
                    Log::warning("File not found: {$file->file_path}");
                }
            }

            if (empty($zipFiles)) {
                return back()->with('error', 'Semua file pendukung tidak ditemukan di penyimpanan.');
            }

            return Zip::create("laporan_kerjasama_{$id}.zip", $zipFiles);
        } catch (\Exception $e) {
            Log::error("Failed to create zip for kerja_sama {$id}: " . $e->getMessage());
            return back()->with('error', 'Gagal membuat arsip ZIP: ' . $e->getMessage());
        }
    }
}
