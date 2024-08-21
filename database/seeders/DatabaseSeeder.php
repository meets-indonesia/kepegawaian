<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FakultasSeeder::class,
            JurusanSeeder::class,
            ProdiSeeder::class,
            KelompokPegawaiSeeder::class,
            UnitKerjaSeeder::class,
            JenisPegawaiSeeder::class,
            GolonganSeeder::class,
            GajiPokokSeeder::class,
            EselonSeeder::class,
            JabatanStrukturalSeeder::class,
            JabatanFungsionalSeeder::class,
            PendidikanSeeder::class,
            HukumanDisiplinSeeder::class,
            LokasiKerjaSeeder::class,
            GradeSeeder::class,
            StrukturSeeder::class,
            PegawaiSeeder::class,
        ]);
    }
}
