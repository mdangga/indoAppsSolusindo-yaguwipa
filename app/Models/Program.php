<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id_program';

    protected $fillable = [
        'nama',
        'image_path',
        'deskripsi',
        'status',
        'id_kategori_program'
    ];

    public function KategoriProgram()
    {
        return $this->belongsTo(KategoriProgram::class, 'id_kategori_program', 'id_kategori_program');
    }

    public function institusiTerlibat()
    {
        return $this->belongsToMany(Institusi::class, 'program_institusi', 'id_program', 'id_institusi')
            ->withPivot('tanggal')
            ->withTimestamps();
    }
}
