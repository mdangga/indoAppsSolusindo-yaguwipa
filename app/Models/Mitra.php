<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mitra extends Model
{
    use SoftDeletes;
    
    protected $table = 'mitra';
    protected $primaryKey = 'id_mitra';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_user',
        'website',
        'penanggung_jawab',
        'jabatan_penanggung_jawab',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function KerjaSama()
    {
        return $this->hasMany(KerjaSama::class, 'id_kerja_sama', 'id_kerja_sama');
    }

}
