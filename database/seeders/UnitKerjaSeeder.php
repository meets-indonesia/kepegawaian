<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define unit kerja
        $unit_kerja = [
            [
                'name' => 'FE',
            ],
            [
                'name' => 'FEB',
            ],
            [
                'name' => 'FISIP',
            ],
            [
                'name' => 'FT',
            ],
            [
                'name' => 'FMIPA',
            ],
            [
                'name' => 'FH'
            ],
        ];

        // Insert the unit kerja into the database
        foreach ($unit_kerja as $unit) {
            UnitKerja::create($unit);
        }
    }
}
