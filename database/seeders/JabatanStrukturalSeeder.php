<?php

namespace Database\Seeders;

use App\Models\JabatanStruktural;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanStrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define jabatan struktural
        $jabatan_struktural = [
            [
                'name' => 'Ketua Jurusan',
                'masa' => 4,
                'eselon_id' => 2,
            ],
            [
                'name' => 'Sekretaris Jurusan',
                'masa' => 4,
                'eselon_id' => 2,
            ],
            [
                'name' => 'Ketua Program Studi',
                'masa' => 3,
                'eselon_id' => 3,
            ],
            [
                'name' => 'Sekretaris Program Studi',
                'masa' => 3,
                'eselon_id' => 3,
            ],
            [
                'name' => 'Ketua Kelompok',
                'masa' => 2,
                'eselon_id' => 4,
            ],
            [
                'name' => 'Sekretaris Kelompok',
                'masa' => 2,
                'eselon_id' => 4,
            ],
            [
                'name' => 'Ketua Unit Kerja',
                'masa' => 1,
                'eselon_id' => 4,
            ],
            [
                'name' => 'Sekretaris Unit Kerja',
                'masa' => 1,
                'eselon_id' => 4,
            ],
        ];

        // Insert the jabatan struktural into the database
        foreach ($jabatan_struktural as $jabatan) {
            JabatanStruktural::create($jabatan);
        }
    }
}
