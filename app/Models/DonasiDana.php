<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiDana extends Model
{
    protected $table = 'donasi_dana';
    protected $primaryKey = 'id_donasi_dana';

    protected $fillable = [
        'nominal',
        'payment_id',
        'payment_method',
        'payment_token',
        'payment_url',
        'status_verifikasi',
        'expired_at',
        'id_donasi'
    ];

    public function Donasi() {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }
}
