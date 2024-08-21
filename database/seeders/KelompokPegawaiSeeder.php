<?php

namespace Database\Seeders;

use App\Models\KelompokPegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define kelompok pegawai
        $kelompok_pegawai = [
            [
                'name' => 'Dosen',
            ],
            [
                'name' => 'Tata Usaha',
            ],
            [
                'name' => 'Pustakawan',
            ],
            [
                'name' => 'Peneliti',
            ],
            [
                'name' => 'Teknisi',
            ],
            [
                'name' => 'Pengelola',
            ],
        ];

        // Insert the kelompok pegawai into the database
        foreach ($kelompok_pegawai as $kelompok) {
            KelompokPegawai::create($kelompok);
        }
    }
}
