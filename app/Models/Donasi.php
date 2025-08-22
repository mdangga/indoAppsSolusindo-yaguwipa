<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    protected $fillable = [
        'nama',
        'email',
        'status',
        'pesan',
        'anonim',
        'alasan',
        'id_user',
        'id_campaign',
        'id_jenis_donasi',
        'approved_at'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function Campaign()
    {
        return $this->belongsTo(Campaign::class, 'id_campaign', 'id_campaign');
    }
    public function JenisDonasi()
    {
        return $this->belongsTo(JenisDonasi::class, 'id_jenis_donasi', 'id_jenis_donasi');
    }


    public function DonasiDana()
    {
        return $this->hasOne(DonasiDana::class, 'id_donasi', 'id_donasi');
    }
    public function DonasiBarang()
    {
        return $this->hasMany(DonasiBarang::class, 'id_donasi', 'id_donasi');
    }
    public function DonasiJasa()
    {
        return $this->hasOne(DonasiJasa::class, 'id_donasi', 'id_donasi');
    }
}
