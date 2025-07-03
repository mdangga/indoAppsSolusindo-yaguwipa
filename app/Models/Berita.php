<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'news_event';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'meta_title',
        'meta_description',
        'slug',
        'isi_berita',
        'caption',
        'thumbnail',
        'keyword',
        'tanggal_publish',
        'status',
        'hit',
        'id_kategori_news_event'
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'dibaca' => 'integer',
    ];

    public function BeritaToKategoriNewsEvent(){
        return $this->belongsTo(KategoriNewsEvent::class, 'id_kategori_news_event', 'id_kategori_news_event');
    }
}
