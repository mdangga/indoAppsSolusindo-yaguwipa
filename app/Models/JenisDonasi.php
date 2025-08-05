<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDonasi extends Model
{
    protected $table = 'jenis_donasi';
    protected $primaryKey = 'id_jenis_donasi';

    protected $fillable = [
        'nama',
    ];

    public function Donasi(){
        return $this->hasMany(Donasi::class, 'id_jenis_donasi', 'id_jenis_donasi');
    }
}
