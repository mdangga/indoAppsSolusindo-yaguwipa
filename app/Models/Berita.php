<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    public function KategoriNewsEvent()
    {
        return $this->belongsTo(KategoriNewsEvent::class, 'id_kategori_news_event', 'id_kategori_news_event');
    }

    public function clearCache()
    {
        Cache::forget("berita_detail_{$this->slug}");
        Cache::forget("berita_terkait_{$this->id_berita}");
        Cache::forget('berita_populer');
        Cache::forget('berita_per_kategori');

        foreach (range(1, 5) as $page) {
            Cache::forget("berita_page_{$page}");
        }
    }
}
