<?php

namespace App\Http\Controllers;

use App\Imports\FakultasImport;
use App\Imports\GolonganImport;
use App\Imports\JabatanFungsionalImport;
use App\Imports\JenisPegawaiImport;
use App\Imports\JurusanImport;
use App\Imports\PegawaiImport;
use App\Imports\PendidikanImport;
use App\Imports\ProdiImport;
use App\Imports\UnitKerjaImport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
        // Excel::import(new FakultasImport, public_path('fakultas_seeder.xlsx'));
        // Excel::import(new JurusanImport, public_path('jurusan_seeder.xlsx'));
        // Excel::import(new ProdiImport, public_path('prodi_seeder.xlsx'));
        // Excel::import(new PendidikanImport, public_path('pendidikan_seeder.xlsx'));
        // Excel::import(new UnitKerjaImport, public_path('unit_kerja_seeder.xlsx'));
        // Excel::import(new PegawaiImport, public_path('pegawai_seeder.xlsx'));
        // Excel::import(new JenisPegawaiImport, public_path('jenis_pegawai_seeder.xlsx'));
        // Excel::import((new JabatanFungsionalImport), public_path('jabatan_fungsional_seeder.xlsx'));
        // Excel::import(new GolonganImport, public_path('golongan_seeder.xlsx'));
        Excel::import(new UserImport, public_path('user_seeder.xlsx'));

        return redirect('/')->with('success', 'All good!');
    }
}
