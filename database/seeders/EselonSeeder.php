<?php

namespace Database\Seeders;

use App\Models\Eselon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EselonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define eselon
        $eselon = [
            [
                'name' => 'Eselon I',
            ],
            [
                'name' => 'Eselon II',
            ],
            [
                'name' => 'Eselon III',
            ],
            [
                'name' => 'Eselon IV',
            ],
        ];

        // Insert the eselon into the database
        foreach ($eselon as $eselon) {
            Eselon::create($eselon);
        }
    }
}
