<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define jurusan
        $jurusan = [
            [
                'name' => 'Teknik Informatika',
                'fakultas_id' => 2,
            ],
            [
                'name' => 'Teknik Elektro',
                'fakultas_id' => 2,
            ],
            [
                'name' => 'Teknik Mesin',
                'fakultas_id' => 2,
            ],
            [
                'name' => 'Teknik Sipil',
                'fakultas_id' => 2,
            ],
            [
                'name' => 'Teknik Kimia',
                'fakultas_id' => 2,
            ],
            [
                'name' => 'Akuntansi',
                'fakultas_id' => 1,
            ],
            [
                'name' => 'Manajemen',
                'fakultas_id' => 1,
            ]

        ];

        // Insert the jurusan into the database
        foreach ($jurusan as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
