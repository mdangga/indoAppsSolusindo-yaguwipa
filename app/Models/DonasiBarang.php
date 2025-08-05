<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiBarang extends Model
{
    protected $table = 'donasi_barang';
    protected $primaryKey = 'id_donasi_barang';

    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'deskripsi',
        'kondisi',
        'status_verifikasi',
        'id_donasi'
    ];

    public function Donasi() {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }
}
