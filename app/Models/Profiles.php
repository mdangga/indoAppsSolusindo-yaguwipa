<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = 'profil_yayasan';
    protected $primaryKey = 'id_profil_yayasan';

    protected $fillable = [
        'logo',
        'favicon',
        'background',
        'company',
        'website',
        'telephone',
        'fax',
        'email',
        'address',
        'map',
        'intro',
        'popup',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'copyright',
        'tentang',
        'visi',
        'misi',
        'tujuan',
        'makna_logo'
    ];

    public function ProfilesToSosialMedia(){
        return $this->hasMany(SosialMedia::class, 'id_profil_yayasan', 'id_profil_yayasan');
    }
} 