<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKerjaSama extends Model
{
    protected $table = 'kategori_kerja_sama';
    protected $primaryKey = 'id_kategori_kerja_sama';

    protected $fillable = [
        'nama',
    ];
}
