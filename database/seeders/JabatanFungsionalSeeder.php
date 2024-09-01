<?php

namespace Database\Seeders;

use App\Models\JabatanFungsional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanFungsionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define jabatan fungsional
        $jabatan_fungsional = [
            [
                'name' => 'Asisten Ahli',
                'masa' => 2,
            ],
            [
                'name' => 'Lektor',
                'masa' => 3,
            ],
            [
                'name' => 'Lektor Kepala',
                'masa' => 4,
            ],
            [
                'name' => 'Guru Besar',
                'masa' => 5,
            ],
        ];

        // Insert the jabatan fungsional into the database
        foreach ($jabatan_fungsional as $jabatan) {
            JabatanFungsional::create($jabatan);
        }
    }
}
