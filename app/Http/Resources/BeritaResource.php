<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeritaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_berita' => $this->id_berita,
            'judul' => $this->judul,
            'slug' => $this->slug,
            'isi_berita' => $this->isi_berita,
            'thumbnail' => $this->thumbnail,
            'tanggal_publish' => $this->tanggal_publish,
            'is_dipublish' => $this->is_dipublish,
            'dibaca' => $this->dibaca,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
