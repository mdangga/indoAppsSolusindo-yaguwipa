<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class KategoriProgram extends Model
{
    protected $table = 'kategori_program';
    protected $primaryKey = 'id_kategori_program';

    protected $fillable = [
        'nama'
    ];

    //buat slug saat kategori ditambhkan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->nama);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->nama);
        });
    }

    public function Program()
    {
        return $this->hasMany(Program::class, 'id_kategori_program', 'id_kategori_program');
    }

    public function KategoriNewsEvent()
    {
        return $this->hasMany(KategoriNewsEvent::class, 'id_kategori_program', 'id_kategori_program');
    }

    public function Berita()
    {
        return $this->hasManyThrough(
            Berita::class,
            KategoriNewsEvent::class,
            'id_kategori_program',
            'id_kategori_news_event',
            'id_kategori_program',
            'id_kategori_news_event'
        );
    }
}
