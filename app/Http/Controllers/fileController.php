<?php

namespace App\Http\Controllers;

use App\Models\FilePenunjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class fileController extends Controller
{
    // menampilkan per file
    public function showFileKerjaSama($id)
    {

        $file = FilePenunjang::findOrFail($id);

        if (Auth::user()->role !== 'admin' && Auth::user()->id_user !== $file->KerjaSama->Mitra->User->id_user) {
            abort(403, 'Anda tidak punya akses ke file ini');
        }
        if (!(Storage::disk('local')->exists($file->file_path))) {
            abort(404, 'File Tidak Ditemukan');
        }

        return response()->file(storage_path('app/private/' . $file->file_path), [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }

    // mendownload per file
    // public function downloadFile($filepath){

    //     if(!(Storage::disk('local')->exists($filepath))){
    //         abort(404, 'File Tidak Ditemukan');
    //     }

    //     return Storage::disk('local')->download();
    // }
}
