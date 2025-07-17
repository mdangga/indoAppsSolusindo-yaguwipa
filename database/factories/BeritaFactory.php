<?php

namespace Database\Factories;

use App\Models\KategoriNewsEvent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = $this->faker->sentence(6);
        $slug = Str::slug($judul);

        return [
            'judul' => $judul,
            'meta_title' => $this->faker->sentence(6),
            'meta_description' => $this->faker->paragraph,
            'slug' => $slug,
            'isi_berita' => $this->faker->paragraphs(4, true),
            'thumbnail' => null, // bisa diisi dengan path default kalau perlu
            'caption' => $this->faker->optional()->sentence,
            'keyword' => $this->faker->optional()->words(3, true),
            'tanggal_publish' => now()->subDays(rand(0, 30)),
            'status' => $this->faker->randomElement(['show', 'hide']),
            'hit' => rand(0, 500),
            'id_kategori_news_event' => KategoriNewsEvent::factory(), // pastikan factory kategori ada
        ];
    }
}
