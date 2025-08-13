<?php

namespace App\Http\Controllers;

use App\Models\KerjaSama;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $kerjaSama = KerjaSama::find(1);
        $pdf = Pdf::loadView('pdf.testing', ['kerjaSama' => $kerjaSama]);
        return $pdf->stream('testing.pdf');
    }
}
