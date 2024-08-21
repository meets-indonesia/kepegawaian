<?php

namespace Database\Seeders;

use App\Models\Struktur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define struktur
        $struktur = [
            [
                'jabatan_struktural_id' => 1,
                'jabatan_fungsional_id' => 1,
                'grade_id' => 1,
                'eselon_id' => 1,
                'parent_id' => 1,
                'jv' => 1,
            ],
            [
                'jabatan_struktural_id' => 2,
                'jabatan_fungsional_id' => 2,
                'grade_id' => 2,
                'eselon_id' => 2,
                'parent_id' => 1,
                'jv' => 2,
            ],
            [
                'jabatan_struktural_id' => 3,
                'jabatan_fungsional_id' => 3,
                'grade_id' => 3,
                'eselon_id' => 3,
                'parent_id' => 2,
                'jv' => 3,
            ],
            [
                'jabatan_struktural_id' => 4,
                'jabatan_fungsional_id' => 4,
                'grade_id' => 4,
                'eselon_id' => 4,
                'parent_id' => 3,
                'jv' => 4,
            ],
        ];

        // Insert the struktur into the database
        foreach ($struktur as $struktur) {
            Struktur::create($struktur);
        }
    }
}
