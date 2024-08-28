<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pegawai([
            'nip' => $row['nip'],
            'name' => $row['name'],
            'email' => $row['email'],
            'golongan_id' => $row['golongan_id'],
            'kelompok_pegawai_id' => $row['kelompok_pegawai_id'],
            'jenis_pegawai_id' => $row['jenis_pegawai_id'],
            'unit_kerja_id' => $row['unit_kerja_id'],
            'prodi_id' => $row['prodi_id'],
            'grade_id' => $row['grade_id'],
            'jurusan_id' => $row['jurusan_id'],
            'pendidikan_id' => $row['pendidikan_id'],
            'jabatan_fungsional_id' => $row['jabatan_fungsional_id'],
            'jabatan_struktural_id' => $row['jabatan_struktural_id'],
        ]);
    }

    private function transformDate($value)
    {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }
        return $value;
    }
}
