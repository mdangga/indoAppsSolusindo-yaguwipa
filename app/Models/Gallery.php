<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id_gallery';

    protected $fillable = 
    [
        'judul',
        'link',
        'kategori'
    ];

}
