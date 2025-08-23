<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Institusi extends Model
{
    protected $table = 'institusi_terlibat';
    protected $primaryKey = 'id_institusi';

    protected $fillable = [
        'nama',
        'alamat',
        'website',
        'profile_path',
        'status',
    ];

    public static function createFromRequest(array $data): self
    {
        $institusiData = [
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'website' => $data['website'],

        ];

        if (!empty($data['status'])) {
            $institusiData['status'] = $data['status'];
        }

        if (!empty($data['logo']) && $data['logo'] instanceof \Illuminate\Http\UploadedFile) {
            $logo = $data['logo'];
            $namaFileLogo = 'img/institusi/' . uniqid() . '.webp';
            $logoWebp = Image::read($logo)->toWebp(80);
            Storage::disk('public')->put($namaFileLogo, $logoWebp);
            $institusiData['profile_path'] = $namaFileLogo;
        }

        return self::create($institusiData);
    }

    public function program()
    {
        return $this->belongsToMany(Program::class, 'program_institusi', 'id_institusi', 'id_program')
            ->withPivot('tanggal')
            ->withTimestamps();
    }
}
