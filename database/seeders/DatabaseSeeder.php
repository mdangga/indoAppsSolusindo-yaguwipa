<?php

namespace Database\Seeders;

use App\Models\Institusi;
use App\Models\JenisDonasi;
use App\Models\Profiles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'nama' => 'admin',
            'no_tlp' => '123',
            'alamat' => 'Ganetri',
            'role' => 'admin',
        ]);

        // profil yayasan
        Profiles::create([
            'logo' => 'img-placeholder.webp',
            'favicon' => 'img-placeholder.webp',
            'background' => 'img-placeholder.webp',
            'nama_yayasan' => 'Yayasan Contoh',
            'website' => 'https://yayasan.test',
            'telephone' => '08123456789',
            'fax' => '021123456',
            'email' => 'info@yayasan.test',
            'address' => 'Jl. Contoh No. 123',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13564.653230849299!2d115.36532485295947!3d-8.439398063216458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd219284bcc1c03%3A0x9348f038f0ba8c9d!2sUniversitas%20Hindu%20Negeri%20I%20Gusti%20Bagus%20Sugriwa%20Denpasar%20(Kampus%20Bangli)!5e1!3m2!1sid!2sid!4v1751511635639!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'intro' => 'Selamat datang di Yayasan',
            'popup' => null,
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


        // jenis donasi
        $jenisDonasi = ['Dana', 'Barang', 'Jasa'];

        foreach ($jenisDonasi as $jenis) {
            JenisDonasi::create([
                'nama' => $jenis
            ]);
        };

        // menu web
        $berandaId = DB::table('menus')->insertGetId([
            'title' => 'Beranda',
            'url' => url(route('beranda'), [], false),
            'status' => 'show',
            'parent_menu' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $profilId = DB::table('menus')->insertGetId([
            'title' => 'Profil',
            'url' => '#',
            'status' => 'show',
            'parent_menu' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $galleryId = DB::table('menus')->insertGetId([
            'title' => 'Gallery',
            'url' => url(route('beranda.gallery'), [], false),
            'status' => 'show',
            'parent_menu' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $newsId = DB::table('menus')->insertGetId([
            'title' => 'News&Event',
            'url' => url(route('beranda.berita'), [], false),
            'status' => 'show',
            'parent_menu' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $programId = DB::table('menus')->insertGetId([
            'title' => 'Program',
            'url' => url(route('beranda.program'), [], false),
            'status' => 'show',
            'parent_menu' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $publikasiId = DB::table('menus')->insertGetId([
            'title' => 'Publikasi',
            'url' => url(route('beranda.publikasi'), [], false),
            'status' => 'show',
            'parent_menu' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menus')->insert([
            [
                'title' => 'Tentang Kami',
                'url' => url(route('beranda.tentang'), [], false),
                'parent_menu' => $profilId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Partners',
                'url' => url(route('beranda.partners'), [], false),
                'parent_menu' => $profilId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // institusi terlibat
        $institusis = [
            ['title' => 'PT Indo Apps Solusindo', 'link' => 'https://indoapps.id'],
            ['title' => 'Denpasar Institute', 'link' => 'https://denpasarinstitute.ac.id'],
            ['title' => 'GCOM', 'link' => '#'],
            ['title' => 'Indo Berkah Konstruksi', 'link' => '#'],
            ['title' => 'Indo Consulting', 'link' => '#'],
            ['title' => 'Latifaba', 'link' => 'https://www.latifaba.com/'],
            ['title' => 'Nyaman Care', 'link' => '#'],
            ['title' => 'Penerbit Yaguwipa', 'link' => 'https://www.penerbityaguwipa.id/'],
            ['title' => 'Teknika Solusinda', 'link' => '#']
        ];

        foreach ($institusis as $institusi) {
            Institusi::create([
                'nama' => $institusi['title'],
                'alamat' => 'Jln. Ganetri IV No. 4 DPS 80237 Bali',
                'website' => $institusi['link'],
                'status' => 'show',
            ]);
        };

        // kata kotor
        // $data = [
        //     // Kata kasar umum
        //     ['kata' => 'anjing'],
        //     ['kata' => 'bangsat'],
        //     ['kata' => 'brengsek'],
        //     ['kata' => 'kampret'],
        //     ['kata' => 'sialan'],
        //     ['kata' => 'setan'],
        //     ['kata' => 'iblis'],

        //     // Binatang (sering dipakai sebagai umpatan)
        //     ['kata' => 'babi'],
        //     ['kata' => 'monyet'],
        //     ['kata' => 'anjing'],
        //     ['kata' => 'keledai'],
        //     ['kata' => 'cacing'],

        //     // Menghina intelektual
        //     ['kata' => 'tolol'],
        //     ['kata' => 'goblok'],
        //     ['kata' => 'idiot'],
        //     ['kata' => 'dungu'],
        //     ['kata' => 'bego'],
        //     ['kata' => 'otak udang'],
        //     ['kata' => 'otak kosong'],

        //     // Seksual vulgar
        //     ['kata' => 'kontol'],
        //     ['kata' => 'memek'],
        //     ['kata' => 'ngentot'],
        //     ['kata' => 'jembut'],
        //     ['kata' => 'tetek'],
        //     ['kata' => 'toket'],
        //     ['kata' => 'pepek'],
        //     ['kata' => 'peler'],
        //     ['kata' => 'ewe'],
        //     ['kata' => 'coli'],

        //     // Umpatan lain
        //     ['kata' => 'tai'],
        //     ['kata' => 'kacung'],
        //     ['kata' => 'kampungan'],
        //     ['kata' => 'katrok'],
        //     ['kata' => 'sundal'],
        //     ['kata' => 'lonte'],
        //     ['kata' => 'jablay'],
        //     ['kata' => 'pelacur'],
        //     ['kata' => 'psk'],
        //     ['kata' => 'bencong'],
        //     ['kata' => 'banci'],
        //     ['kata' => 'homo'],
        //     ['kata' => 'lesbi'],
        // ];

        // $now = Carbon::now();
        // foreach ($data as &$row) {
        //     $row['created_at'] = $now;
        //     $row['updated_at'] = $now;
        // }

        // DB::table('kata_kotor')->insert($data);
    }
}
