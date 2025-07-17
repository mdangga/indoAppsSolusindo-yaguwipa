<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriNewsEvent extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_news_event';
    protected $primaryKey = 'id_kategori_news_event';

    protected $fillable = [
        'nama',
        'deskripsi',
        'id_kategori_program'
    ];

    public function Berita(){
        return $this->hasMany(Berita::class, 'id_kategori_news_event', 'id_kategori_news_event');
    }

    public function KategoriProgram(){
        return $this->belongsTo(KategoriProgram::class, 'id_kategori_program', 'id_kategori_program');
    }
}
