<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Kelas::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Kategori::factory(3)->create();
        \App\Models\Materi::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Setting::create([
            'group' => 'env',
            'setname' => 'nama_aplikasi',
            'value' => 'Wolio App'
        ]);

        Setting::create([
            'group' => 'env',
            'setname' => 'deskripsi_app',
            'value' => 'Kursus & Belajar Bahasa Wolio'
        ]);

        Setting::create([
            'group' => 'env',
            'setname' => 'icon',
            'value' => 'blabla'
        ]);

        Setting::create([
            'group' => 'env',
            'setname' => 'tahun',
            'value' => 2024
        ]);

        Setting::create([
            'group' => 'env',
            'setname' => 'contact',
            'value' => '081354000500'
        ]);

        Setting::create([
            'group' => 'env',
            'setname' => 'jumlah_soal_default',
            'value' => '10'
        ]);

        // $kategoriseed =
        //     [
        //     'uuid' => 'y8x34t982734nyt2734tx9n',
        //     'nama' => 'Kata Benda'
        //     ]
        // ;

        // Kategori::factory()->create($kategoriseed);
    }
}
