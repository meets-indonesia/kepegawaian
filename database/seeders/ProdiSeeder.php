<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define prodi
        $prodi = [
            [
                'name' => 'Temu Kembali Informasi',
                'jurusan_id' => 1,
            ],
            [
                'name' => 'Perancangan Sistem Informasi',
                'jurusan_id' => 1,
            ],
            [
                'name' => 'Elektronika',
                'jurusan_id' => 2,
            ],
            [
                'name' => 'Kimiawi Industri',
                'jurusan_id' => 5,
            ]

        ];

        // Insert the prodi into the database
        foreach ($prodi as $prodi) {
            Prodi::create($prodi);
        }
    }
}
