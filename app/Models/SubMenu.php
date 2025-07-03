<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $primaryKey = 'id_sub_menus';

    public function SubMenuToMenu()
    {
        return $this->belongsTo(Menu::class, 'id_menus', 'id_menus');
    }
}