<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    use SoftDeletes;
    
    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';

    protected $fillable = [
        'id_user',
        'nama',
        'no_tlp',
        'email',
        'profile_path',
        'alamat',
        'status',
    ];

    public function DonaturToUser()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
