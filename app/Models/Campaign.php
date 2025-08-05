<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'id_campaign';

    protected $fillable = [
        'slug',
        'nama',
        'deskripsi',
        'image_path',
        'target_dana',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'lokasi',
        'id_program'
    ];

    public function Program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }

    public function Donasi()
    {
        return $this->hasMany(Donasi::class, 'id_campaign', 'id_campaign');
    }
}
