<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPublikasi extends Model
{
    protected $table = 'jenis_publikasi';
    protected $primaryKey = 'id_jenis_publikasi';

    protected $fillable = [
        'nama'
    ];

    public function Publikasi()
    {
        return $this->hasMany(Publikasi::class, 'id_publikasi', 'id_publikasi');
    }
}
