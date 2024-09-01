<?php

namespace Database\Seeders;

use App\Models\JenisPegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define jenis pegawai
        $jenis_pegawai = [
            [
                'name' => 'PNS',
            ],
            [
                'name' => 'Non-PNS',
            ],
            [
                'name' => 'Honorer',
            ],
            [
                'name' => 'Kontrak',
            ],
            [
                'name' => 'Magang',
            ],
        ];

        // Insert the jenis pegawai into the database
        foreach ($jenis_pegawai as $jenis) {
            JenisPegawai::create($jenis);
        }
    }
}
