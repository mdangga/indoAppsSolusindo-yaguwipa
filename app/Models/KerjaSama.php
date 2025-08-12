<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerjaSama extends Model
{
    protected $table = 'kerja_sama';
    protected $primaryKey = 'id_kerja_sama';

    protected $fillable = [
        'keterangan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'alasan',
        'id_mitra',
        'id_kategori_kerja_sama',
        'id_program'
    ];

    public function FilePenunjang(){
        return $this->hasMany(FilePenunjang::class, 'id_kerja_sama', 'id_kerja_sama');
    }

    public function Mitra(){
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }

    public function KategoriKerjaSama(){
        return $this->belongsTo(KategoriKerjaSama::class, 'id_kategori_kerja_sama', 'id_kategori_kerja_sama');
    }

    public function Program(){
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }
}
