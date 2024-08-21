<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define golongan
        $golongan = [
            [
                'name' => 'IA',
                'golongan' => 1,
            ],
            [
                'name' => 'IB',
                'golongan' => 1,
            ],
            [
                'name' => 'IC',
                'golongan' => 1,
            ],
            [
                'name' => 'ID',
                'golongan' => 1,
            ],
            [
                'name' => 'IIA',
                'golongan' => 2,
            ],
            [
                'name' => 'IIB',
                'golongan' => 2,
            ],
            [
                'name' => 'IIC',
                'golongan' => 2,
            ],
            [
                'name' => 'IID',
                'golongan' => 2,
            ],
            [
                'name' => 'IIIA',
                'golongan' => 3,
            ],
            [
                'name' => 'IIIB',
                'golongan' => 3,
            ],
            [
                'name' => 'IIIC',
                'golongan' => 3,
            ],
            [
                'name' => 'IIID',
                'golongan' => 3,
            ],
            [
                'name' => 'IVA',
                'golongan' => 4,
            ],
            [
                'name' => 'IVB',
                'golongan' => 4,
            ],
            [
                'name' => 'IVC',
                'golongan' => 4,
            ],
            [
                'name' => 'IVD',
                'golongan' => 4,
            ],
        ];

        // Insert the golongan into the database
        foreach ($golongan as $golongan) {
            Golongan::create($golongan);
        }
    }
}
