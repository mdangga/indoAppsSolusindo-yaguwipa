<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SosialMedia extends Model
{
    protected $table = 'sosial_media';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'link',
        'status'
    ];

}