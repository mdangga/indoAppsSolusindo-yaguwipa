<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiJasa extends Model
{
    protected $table = 'donasi_jasa';
    protected $primaryKey = 'id_donasi_jasa';

    protected $fillable = [
        'jenis_jasa',
        'durasi_jasa',
        'status_verifikasi',
        'id_donasi'
    ];

    public function Donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }
}
