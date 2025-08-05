<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'id_campaign';

    protected $fillable = [
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
}
