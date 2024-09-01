<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define pendidikan
        $pendidikan = [
            [
                'name' => 'SD',
            ],
            [
                'name' => 'SMP',
            ],
            [
                'name' => 'SMA',
            ],
            [
                'name' => 'D3',
            ],
            [
                'name' => 'S1',
            ],
            [
                'name' => 'S2',
            ],
            [
                'name' => 'S3',
            ],
        ];

        // Insert the pendidikan into the database
        foreach ($pendidikan as $pendidikan) {
            Pendidikan::create($pendidikan);
        }
    }
}
