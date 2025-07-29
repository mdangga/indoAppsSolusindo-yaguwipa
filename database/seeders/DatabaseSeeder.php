<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriNewsEvent;
use App\Models\KategoriProgram;
use App\Models\Profiles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
           User::create([
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]);

            Profiles::create([
                'logo' => 'img-placeholder.webp',
                'favicon' => 'img-placeholder.webp',
                'background' => 'img-placeholder.webp',
                'company' => 'Yayasan Contoh',
                'website' => 'https://yayasan.test',
                'telephone' => '08123456789',
                'fax' => '021123456',
                'email' => 'info@yayasan.test',
                'address' => 'Jl. Contoh No. 123',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13564.653230849299!2d115.36532485295947!3d-8.439398063216458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd219284bcc1c03%3A0x9348f038f0ba8c9d!2sUniversitas%20Hindu%20Negeri%20I%20Gusti%20Bagus%20Sugriwa%20Denpasar%20(Kampus%20Bangli)!5e1!3m2!1sid!2sid!4v1751511635639!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'intro' => 'Selamat datang di Yayasan',
                'popup' => 'NULL',
                'meta_title' => 'Yayasan Meta Title',
                'meta_description' => 'Meta description yayasan',
                'meta_keyword' => 'yayasan, pendidikan, sosial',
                'copyright' => '2025 AnggaYudaRelia',
                'tentang' => 'Tentang kami',
                'visi' => 'Visi yayasan',
                'misi' => 'Misi yayasan',
                'tujuan' => 'Tujuan yayasan',
                'makna_logo' => 'Makna dari logo yayasan',
            ]);


            KategoriProgram::create([
                'nama' => 'Sosial',
                'slug' => Str::slug('Sosial'),
            ]);
            KategoriNewsEvent::create([
                'nama' => 'Sosial',
                'id_kategori_program' => null,
            ]);

        $kategori = KategoriNewsEvent::first();

        Berita::factory()->count(10)->create([
            'id_kategori_news_event' => $kategori->id_kategori_news_event,
        ]);
    }
}
