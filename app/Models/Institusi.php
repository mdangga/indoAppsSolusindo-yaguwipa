<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institusi extends Model
{
    protected $table = 'institusi_terlibat';
    protected $primaryKey = 'id_institusi';

    protected $fillable = [
        'nama',
        'alamat',
        'website',
        'status',
    ];

    public function program()
    {
        return $this->belongsToMany(Program::class, 'program_institusi', 'id_institusi', 'id_program')
            ->withPivot('tanggal')
            ->withTimestamps();
    }
}
