<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Profiles extends Model
{
    protected $table = 'profil_yayasan';
    protected $primaryKey = 'id_profil_yayasan';

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('yayasan_profile'));
        static::deleted(fn() => Cache::forget('yayasan_profile'));
    }

    protected $fillable = [
        'logo',
        'favicon',
        'background',
        'nama_yayasan',
        'website',
        'telephone',
        'fax',
        'email',
        'address',
        'map',
        'intro',
        'popup',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'copyright',
        'tentang',
        'visi',
        'misi',
        'tujuan',
        'makna_logo'
    ];
}
