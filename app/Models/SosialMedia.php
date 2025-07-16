<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SosialMedia extends Model
{
    protected $table = 'sosial_media';
    protected $primaryKey = 'id';

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('yayasan_sosmed'));
        static::deleted(fn() => Cache::forget('yayasan_sosmed'));
    }

    protected $fillable = [
        'nama',
        'link',
        'status'
    ];
}
