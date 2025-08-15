<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KataKotor extends Model
{

    protected $table = 'kata_kotor';
    protected $primaryKey = 'id_kata';

    protected $fillable = [
        'kata'
    ];

}
