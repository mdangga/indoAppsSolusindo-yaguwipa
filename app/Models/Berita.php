<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'slug',
        'isi_berita',
        'thumbnail',
        'tanggal_publish',
        'is_dipublish',
        'dibaca',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'is_dipublish' => 'boolean',
        'dibaca' => 'integer',
    ];
}
