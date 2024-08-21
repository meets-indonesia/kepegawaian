<?php

namespace Database\Seeders;

use App\Models\LokasiKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define lokasi kerja
        $lokasi_kerja = [
            [
                'name' => 'Kantor Pusat',
            ],
            [
                'name' => 'Kantor Cabang',
            ],
            [
                'name' => 'Kantor Wilayah',
            ],
            [
                'name' => 'Kantor Perwakilan',
            ],
            [
                'name' => 'Kantor Daerah',
            ],
            [
                'name' => 'Kantor Unit',
            ],
        ];

        // Insert the lokasi kerja into the database
        foreach ($lokasi_kerja as $lokasi_kerja) {
            LokasiKerja::create($lokasi_kerja);
        }
    }
}
