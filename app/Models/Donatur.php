<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table = 'Donatur';
    protected $primaryKey = 'id_donatur';

    protected $fillable = [
        'nama',
        'no_tlp',
        'email',
        'alamat',
        'id_user',
        'status',
    ];

    public function donatur()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
