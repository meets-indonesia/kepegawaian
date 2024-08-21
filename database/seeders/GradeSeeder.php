<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define grade
        $grade = [
            [
                'name' => 'Grade 1',
                'value' => '1',
                'jabatan_fungsional_id' => 1,
                'jabatan_struktural_id' => 1,
                'pendidikan_id' => 1,
                'kelompok_pegawai_id' => 1,
                'unit_kerja_id' => 1,
            ],
            [
                'name' => 'Grade 2',
                'value' => '2',
                'jabatan_fungsional_id' => 2,
                'jabatan_struktural_id' => 2,
                'pendidikan_id' => 2,
                'kelompok_pegawai_id' => 2,
                'unit_kerja_id' => 2,
            ],
            [
                'name' => 'Grade 3',
                'value' => '3',
                'jabatan_fungsional_id' => 3,
                'jabatan_struktural_id' => 3,
                'pendidikan_id' => 3,
                'kelompok_pegawai_id' => 3,
                'unit_kerja_id' => 3,
            ],
            [
                'name' => 'Grade 4',
                'value' => '4',
                'jabatan_fungsional_id' => 4,
                'jabatan_struktural_id' => 4,
                'pendidikan_id' => 4,
                'kelompok_pegawai_id' => 4,
                'unit_kerja_id' => 4,
            ],
        ];

        // Insert the grade into the database
        foreach ($grade as $grade) {
            Grade::create($grade);
        }
    }
}
