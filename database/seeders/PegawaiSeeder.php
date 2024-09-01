<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define pegawai
        $pegawai = [
            [
                'nip' => '1234567890',
                'name' => 'John Doe',
                'email' => 'john@test.com',
                'golongan_id' => 1,
                'kelompok_pegawai_id' => 1,
                'jenis_pegawai_id' => 1,
                'unit_kerja_id' => 1,
                'jurusan_id' => 1,
                'prodi_id' => 1,
                'grade_id' => 1,
                'tamat_cpns' => Date::now(),
                'tamat_pns' => Date::now(),
                'pendidikan_id' => 1,
                'jabatan_struktural_id' => 1,
                'jabatan_fungsional_id' => 1
            ],
            [
                'nip' => '0987654321',
                'name' => 'Jane Doe',
                'email' => 'jane@test.com',
                'golongan_id' => 2,
                'kelompok_pegawai_id' => 2,
                'jenis_pegawai_id' => 2,
                'unit_kerja_id' => 2,
                'jurusan_id' => 2,
                'prodi_id' => 2,
                'grade_id' => 2,
                'tamat_cpns' => Date::now(),
                'tamat_pns' => Date::now(),
                'pendidikan_id' => 2,
                'jabatan_struktural_id' => 2,
                'jabatan_fungsional_id' => 2
            ],
        ];

        // Insert the pegawai into the database
        foreach ($pegawai as $pegawai) {
            Pegawai::create($pegawai);
        }
    }
}
