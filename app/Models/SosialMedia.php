<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SosialMedia extends Model
{
    protected $table = 'sosial_media';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'link',
        'icon',
        'status',
        'id_profil_yayasan'
    ];

    public function SosialMediaToProfiles(){
        return $this->belongsTo(Profiles::class, 'id_profil_yayasan', 'id_profil_yayasan');
    }
}