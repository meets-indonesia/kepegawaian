<?php

namespace Database\Seeders;

use App\Models\HukumanDisiplin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HukumanDisiplinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define hukuman disiplin
        $hukuman_disiplin = [
            [
                'name' => 'Teguran Lisan',
            ],
            [
                'name' => 'Teguran Tertulis',
            ],
            [
                'name' => 'Penundaan Kenaikan Gaji Berkala',
            ],
            [
                'name' => 'Penundaan Kenaikan Pangkat',
            ],
            [
                'name' => 'Penurunan Pangkat',
            ],
            [
                'name' => 'Pemberhentian dengan hormat tidak atas permintaan sendiri',
            ],
            [
                'name' => 'Pemberhentian dengan hormat atas permintaan sendiri'
            ],
        ];

        // Insert the hukuman disiplin into the database
        foreach ($hukuman_disiplin as $hukuman) {
            HukumanDisiplin::create($hukuman);
        }
    }
}
