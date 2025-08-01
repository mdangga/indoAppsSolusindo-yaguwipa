<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilePenunjang extends Model
{
    protected $table = 'file_penunjang';
    protected $primaryKey = 'id_file_penunjang';

    protected $fillable = [
        'file_path',
        'nama_file',
        'file_size',
        'id_kerja_sama',
    ];

    public function KerjaSama(){
        return $this->belongsTo(KerjaSama::class, 'id_kerja_sama', 'id_kerja_sama');
    }
}
