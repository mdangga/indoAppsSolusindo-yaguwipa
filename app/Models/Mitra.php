<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
     protected $table = 'mitra';
    protected $primaryKey = 'id_donatur';

    protected $fillable = [
        'id_user',
        'nama',
        'alamat',
        'no_tlp',
        'email',
        'website',
        'profile_path',
        'penanggung_jawab',
        'jabatan_penanggung_jawab',
        'status',
    ];

    public function MitraToUser()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
