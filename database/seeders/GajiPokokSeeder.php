<?php

namespace Database\Seeders;

use App\Models\GajiPokok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GajiPokokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define gaji pokok
        $gaji_pokok = [
            [
                'golongan_id' => 1,
                'masa_kerja' => "0",
                'gaji_pokok' => 2928750,
            ],
            [
                'golongan_id' => 1,
                'masa_kerja' => "1",
                'gaji_pokok' => 3015000,
            ],
            [
                'golongan_id' => 1,
                'masa_kerja' => "2",
                'gaji_pokok' => 3101250,
            ],
            [
                'golongan_id' => 3,
                'masa_kerja' => "0",
                'gaji_pokok' => 3187500,
            ],
            [
                'golongan_id' => 4,
                'masa_kerja' => "5",
                'gaji_pokok' => 3273750,
            ]
        ];

        // Insert the gaji pokok into the database
        foreach ($gaji_pokok as $gaji) {
            GajiPokok::create($gaji);
        }
    }
}
