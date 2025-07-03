<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'id_menus';

    public function MenuToSubMenu()
    {
        return $this->hasMany(SubMenu::class, 'id_menus', 'id_menus');
    }
}