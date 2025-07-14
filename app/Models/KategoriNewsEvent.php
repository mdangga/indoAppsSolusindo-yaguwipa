<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriNewsEvent extends Model
{
    protected $table = 'kategori_news_event';
    protected $primaryKey = 'id_kategori_news_event';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function Berita(){
        return $this->hasMany(KategoriNewsEvent::class, 'id_kategori_news_event', 'id_kategori_news_event');
    }
}
