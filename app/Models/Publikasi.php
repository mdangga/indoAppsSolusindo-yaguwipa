<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $table = 'publikasi';
    protected $primaryKey = 'id_publikasi';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'file',
        'tanggal_terbit',
        'meta_title',
        'meta_description',
        'status',
        'halaman',
        'download',
        'id_jenis_publikasi'
    ];

    public function JenisPublikasi()
    {
        return $this->belongsTo(JenisPublikasi::class, 'id_jenis_publikasi', 'id_jenis_publikasi');
    }
}
