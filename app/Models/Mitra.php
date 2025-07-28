<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use SoftDeletes;
    
    protected $table = 'mitra';
    protected $primaryKey = 'id_mitra';

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
