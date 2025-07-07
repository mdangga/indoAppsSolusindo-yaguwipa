<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id_menus';

    protected $fillable = [
        'title',
        'url',
        'parent_menu',
        'urutan'
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
