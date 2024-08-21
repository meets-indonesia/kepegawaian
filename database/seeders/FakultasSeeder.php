<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define fakultas
        $fakultas = [
            [
                'name' => 'Fakultas Ekonomi',
            ],
            [
                'name' => 'Fakultas Teknik',
            ],
            [
                'name' => 'Fakultas Ilmu Sosial dan Ilmu Politik',
            ],
            [
                'name' => 'Fakultas Hukum',
            ],
            [
                'name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
            ],
            [
                'name' => 'Fakultas Kedokteran',
            ],
        ];

        // Insert the fakultas into the database
        foreach ($fakultas as $fakultas) {
            Fakultas::create($fakultas);
        }
    }
}
