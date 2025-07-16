<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id_menus';

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('yayasan_menus'));
        static::deleted(fn() => Cache::forget('yayasan_menus'));
    }
    protected $fillable = [
        'title',
        'url',
        'parent_menu',
        'status'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_menu');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_menu');
    }
}
