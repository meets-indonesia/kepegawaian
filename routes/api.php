<?php

use App\Http\Controllers\APIAnakController;
use App\Http\Controllers\APIDiklatController;
use App\Http\Controllers\APIEselonController;
use App\Http\Controllers\APIFakultasController;
use App\Http\Controllers\APIGajiPokokController;
use App\Http\Controllers\APIGolonganController;
use App\Http\Controllers\APIHukumanDisiplinController;
use App\Http\Controllers\APIIdentitasController;
use App\Http\Controllers\APIIstriSuamiController;
use App\Http\Controllers\APIJabatanFungsionalController;
use App\Http\Controllers\APIJabatanStrukturalController;
use App\Http\Controllers\APIJenisPegawaiController;
use App\Http\Controllers\APIJurusanController;
use App\Http\Controllers\APIKelompokPegawaiController;
use App\Http\Controllers\APILatihanJabatanController;
use App\Http\Controllers\APILokasiKerjaController;
use App\Http\Controllers\APIPegawaiController;
use App\Http\Controllers\APIPendidikanController;
use App\Http\Controllers\APIPenugasanController;
use App\Http\Controllers\APIProdiController;
use App\Http\Controllers\APIRiwayatHukumanDisiplinController;
use App\Http\Controllers\APIRiwayatJabatanController;
use App\Http\Controllers\APIRiwayatMutasiController;
use App\Http\Controllers\APIRiwayatPangkatController;
use App\Http\Controllers\APIRiwayatPangkatGolonganController;
use App\Http\Controllers\APIRiwayatPendidikanController;
use App\Http\Controllers\APIRiwayatPenghargaanController;
use App\Http\Controllers\APIStrukturController;
use App\Http\Controllers\APIUnitKerjaController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('apikey')->group(function () {

    // Unit Kerja API
    Route::get('/unit_kerja', [APIUnitKerjaController::class, 'getall']);
    Route::get('/unit_kerja/{id}', [APIUnitKerjaController::class, 'get']);
    Route::post('/unit_kerja', [APIUnitKerjaController::class, 'create']);
    Route::put('/unit_kerja/{id}', [APIUnitKerjaController::class, 'update']);
    Route::delete('/unit_kerja/{id}', [APIUnitKerjaController::class, 'delete']);

    // Pegawai API
    Route::get('/pegawai', [APIPegawaiController::class, 'getall']);
    Route::get('/pegawai/{id}', [APIPegawaiController::class, 'get']);
    Route::post('/pegawai', [APIPegawaiController::class, 'create']);
    Route::put('/pegawai/{id}', [APIPegawaiController::class, 'update']);
    Route::delete('/pegawai/{id}', [APIPegawaiController::class, 'delete']);

    // Anak API
    Route::get('/anak', [APIAnakController::class, 'getall']);
    Route::get('/anak/{id}', [APIAnakController::class, 'get']);
    Route::post('/anak', [APIAnakController::class, 'create']);
    Route::put('/anak/{id}', [APIAnakController::class, 'update']);
    Route::delete('/anak/{id}', [APIAnakController::class, 'delete']);

    // Pendidikan API
    Route::get('/pendidikan', [APIPendidikanController::class, 'getall']);
    Route::get('/pendidikan/{id}', [APIPendidikanController::class, 'get']);
    Route::post('/pendidikan', [APIPendidikanController::class, 'create']);
    Route::put('/pendidikan/{id}', [APIPendidikanController::class, 'update']);
    Route::delete('/pendidikan/{id}', [APIPendidikanController::class, 'delete']);

    // Diklat API
    Route::get('/diklat', [APIDiklatController::class, 'getall']);
    Route::get('/diklat/{id}', [APIDiklatController::class, 'get']);
    Route::post('/diklat', [APIDiklatController::class, 'create']);
    Route::put('/diklat/{id}', [APIDiklatController::class, 'update']);
    Route::delete('/diklat/{id}', [APIDiklatController::class, 'delete']);

    // Eselon API
    Route::get('/eselon', [APIEselonController::class, 'getall']);
    Route::get('/eselon/{id}', [APIEselonController::class, 'get']);
    Route::post('/eselon', [APIEselonController::class, 'create']);
    Route::put('/eselon/{id}', [APIEselonController::class, 'update']);
    Route::delete('/eselon/{id}', [APIEselonController::class, 'delete']);

    // Fakultas API
    Route::get('/fakultas', [APIFakultasController::class, 'getall']);
    Route::get('/fakultas/{id}', [APIFakultasController::class, 'get']);
    Route::post('/fakultas', [APIFakultasController::class, 'create']);
    Route::put('/fakultas/{id}', [APIFakultasController::class, 'update']);
    Route::delete('/fakultas/{id}', [APIFakultasController::class, 'delete']);

    // Golongan API
    Route::get('/golongan', [APIGolonganController::class, 'getall']);
    Route::get('/golongan/{id}', [APIGolonganController::class, 'get']);
    Route::post('/golongan', [APIGolonganController::class, 'create']);
    Route::put('/golongan/{id}', [APIGolonganController::class, 'update']);
    Route::delete('/golongan/{id}', [APIGolonganController::class, 'delete']);

    // GajiPokok API
    Route::get('/gaji_pokok', [APIGajiPokokController::class, 'getall']);
    Route::get('/gaji_pokok/{id}', [APIGajiPokokController::class, 'get']);
    Route::post('/gaji_pokok', [APIGajiPokokController::class, 'create']);
    Route::put('/gaji_pokok/{id}', [APIGajiPokokController::class, 'update']);
    Route::delete('/gaji_pokok/{id}', [APIGajiPokokController::class, 'delete']);

    // Hukuman Disiplin API
    Route::get('/hukuman_disiplin', [APIHukumanDisiplinController::class, 'getall']);
    Route::get('/hukuman_disiplin/{id}', [APIHukumanDisiplinController::class, 'get']);
    Route::post('/hukuman_disiplin', [APIHukumanDisiplinController::class, 'create']);
    Route::put('/hukuman_disiplin/{id}', [APIHukumanDisiplinController::class, 'update']);
    Route::delete('/hukuman_disiplin/{id}', [APIHukumanDisiplinController::class, 'delete']);

    // Identitas API
    Route::get('/identitas', [APIIdentitasController::class, 'getall']);
    Route::get('/identitas/{id}', [APIIdentitasController::class, 'get']);
    Route::post('/identitas', [APIIdentitasController::class, 'create']);
    Route::put('/identitas/{id}', [APIIdentitasController::class, 'update']);
    Route::delete('/identitas/{id}', [APIIdentitasController::class, 'delete']);

    // IstriSuami API
    Route::get('/istri_suami', [APIIstriSuamiController::class, 'getall']);
    Route::get('/istri_suami/{id}', [APIIstriSuamiController::class, 'get']);
    Route::post('/istri_suami', [APIIstriSuamiController::class, 'create']);
    Route::put('/istri_suami/{id}', [APIIstriSuamiController::class, 'update']);
    Route::delete('/istri_suami/{id}', [APIIstriSuamiController::class, 'delete']);

    // JabatanFungsional API
    Route::get('/jabatan_fungsional', [APIJabatanFungsionalController::class, 'getall']);
    Route::get('/jabatan_fungsional/{id}', [APIJabatanFungsionalController::class, 'get']);
    Route::post('/jabatan_fungsional', [APIJabatanFungsionalController::class, 'create']);
    Route::put('/jabatan_fungsional/{id}', [APIJabatanFungsionalController::class, 'update']);
    Route::delete('/jabatan_fungsional/{id}', [APIJabatanFungsionalController::class, 'delete']);

    // JabatanStruktural API
    Route::get('/jabatan_struktural', [APIJabatanStrukturalController::class, 'getall']);
    Route::get('/jabatan_struktural/{id}', [APIJabatanStrukturalController::class, 'get']);
    Route::post('/jabatan_struktural', [APIJabatanStrukturalController::class, 'create']);
    Route::put('/jabatan_struktural/{id}', [APIJabatanStrukturalController::class, 'update']);
    Route::delete('/jabatan_struktural/{id}', [APIJabatanStrukturalController::class, 'delete']);

    // JenisPegawai API
    Route::get('/jenis_pegawai', [APIJenisPegawaiController::class, 'getall']);
    Route::get('/jenis_pegawai/{id}', [APIJenisPegawaiController::class, 'get']);
    Route::post('/jenis_pegawai', [APIJenisPegawaiController::class, 'create']);
    Route::put('/jenis_pegawai/{id}', [APIJenisPegawaiController::class, 'update']);
    Route::delete('/jenis_pegawai/{id}', [APIJenisPegawaiController::class, 'delete']);

    // Jurusan API
    Route::get('/jurusan', [APIJurusanController::class, 'getall']);
    Route::get('/jurusan/{id}', [APIJurusanController::class, 'get']);
    Route::post('/jurusan', [APIJurusanController::class, 'create']);
    Route::put('/jurusan/{id}', [APIJurusanController::class, 'update']);
    Route::delete('/jurusan/{id}', [APIJurusanController::class, 'delete']);

    // KelompokPegawai API
    Route::get('/kelompok_pegawai', [APIKelompokPegawaiController::class, 'getall']);
    Route::get('/kelompok_pegawai/{id}', [APIKelompokPegawaiController::class, 'get']);
    Route::post('/kelompok_pegawai', [APIKelompokPegawaiController::class, 'create']);
    Route::put('/kelompok_pegawai/{id}', [APIKelompokPegawaiController::class, 'update']);
    Route::delete('/kelompok_pegawai/{id}', [APIKelompokPegawaiController::class, 'delete']);

    // LatihanJabatan API
    Route::get('/latihan_jabatan', [APILatihanJabatanController::class, 'getall']);
    Route::get('/latihan_jabatan/{id}', [APILatihanJabatanController::class, 'get']);
    Route::post('/latihan_jabatan', [APILatihanJabatanController::class, 'create']);
    Route::put('/latihan_jabatan/{id}', [APILatihanJabatanController::class, 'update']);
    Route::delete('/latihan_jabatan/{id}', [APILatihanJabatanController::class, 'delete']);

    // LokasiKerja API
    Route::get('/lokasi_kerja', [APILokasiKerjaController::class, 'getall']);
    Route::get('/lokasi_kerja/{id}', [APILokasiKerjaController::class, 'get']);
    Route::post('/lokasi_kerja', [APILokasiKerjaController::class, 'create']);
    Route::put('/lokasi_kerja/{id}', [APILokasiKerjaController::class, 'update']);
    Route::delete('/lokasi_kerja/{id}', [APILokasiKerjaController::class, 'delete']);

    // Penugasan API
    Route::get('/penugasan', [APIPenugasanController::class, 'getall']);
    Route::get('/penugasan/{id}', [APIPenugasanController::class, 'get']);
    Route::post('/penugasan', [APIPenugasanController::class, 'create']);
    Route::put('/penugasan/{id}', [APIPenugasanController::class, 'update']);
    Route::delete('/penugasan/{id}', [APIPenugasanController::class, 'delete']);

    // Prodi API
    Route::get('/prodi', [APIProdiController::class, 'getall']);
    Route::get('/prodi/{id}', [APIProdiController::class, 'get']);
    Route::post('/prodi', [APIProdiController::class, 'create']);
    Route::put('/prodi/{id}', [APIProdiController::class, 'update']);
    Route::delete('/prodi/{id}', [APIProdiController::class, 'delete']);

    // RiwayatHukumanDisiplin API
    Route::get('/riwayat_hukuman_disiplin', [APIRiwayatHukumanDisiplinController::class, 'getall']);
    Route::get('/riwayat_hukuman_disiplin/{id}', [APIRiwayatHukumanDisiplinController::class, 'get']);
    Route::post('/riwayat_hukuman_disiplin', [APIRiwayatHukumanDisiplinController::class, 'create']);
    Route::put('/riwayat_hukuman_disiplin/{id}', [APIRiwayatHukumanDisiplinController::class, 'update']);
    Route::delete('/riwayat_hukuman_disiplin/{id}', [APIRiwayatHukumanDisiplinController::class, 'delete']);

    // RiwayatJabatan API
    Route::get('/riwayat_jabatan', [APIRiwayatJabatanController::class, 'getall']);
    Route::get('/riwayat_jabatan/{id}', [APIRiwayatJabatanController::class, 'get']);
    Route::post('/riwayat_jabatan', [APIRiwayatJabatanController::class, 'create']);
    Route::put('/riwayat_jabatan/{id}', [APIRiwayatJabatanController::class, 'update']);
    Route::delete('/riwayat_jabatan/{id}', [APIRiwayatJabatanController::class, 'delete']);

    // RiwayatMutasi API
    Route::get('/riwayat_mutasi', [APIRiwayatMutasiController::class, 'getall']);
    Route::get('/riwayat_mutasi/{id}', [APIRiwayatMutasiController::class, 'get']);
    Route::post('/riwayat_mutasi', [APIRiwayatMutasiController::class, 'create']);
    Route::put('/riwayat_mutasi/{id}', [APIRiwayatMutasiController::class, 'update']);
    Route::delete('/riwayat_mutasi/{id}', [APIRiwayatMutasiController::class, 'delete']);

    // RiwayatPangkatGolongan API
    Route::get('/riwayat_pangkat_golongan', [APIRiwayatPangkatGolonganController::class, 'getall']);
    Route::get('/riwayat_pangkat_golongan/{id}', [APIRiwayatPangkatGolonganController::class, 'get']);
    Route::post('/riwayat_pangkat_golongan', [APIRiwayatPangkatGolonganController::class, 'create']);
    Route::put('/riwayat_pangkat_golongan/{id}', [APIRiwayatPangkatGolonganController::class, 'update']);
    Route::delete('/riwayat_pangkat_golongan/{id}', [APIRiwayatPangkatGolonganController::class, 'delete']);

    // RiwayatPendidikan API
    Route::get('/riwayat_pendidikan', [APIRiwayatPendidikanController::class, 'getall']);
    Route::get('/riwayat_pendidikan/{id}', [APIRiwayatPendidikanController::class, 'get']);
    Route::post('/riwayat_pendidikan', [APIRiwayatPendidikanController::class, 'create']);
    Route::put('/riwayat_pendidikan/{id}', [APIRiwayatPendidikanController::class, 'update']);
    Route::delete('/riwayat_pendidikan/{id}', [APIRiwayatPendidikanController::class, 'delete']);

    // RiwayatPenghargaan API
    Route::get('/riwayat_penghargaan', [APIRiwayatPenghargaanController::class, 'getall']);
    Route::get('/riwayat_penghargaan/{id}', [APIRiwayatPenghargaanController::class, 'get']);
    Route::post('/riwayat_penghargaan', [APIRiwayatPenghargaanController::class, 'create']);
    Route::put('/riwayat_penghargaan/{id}', [APIRiwayatPenghargaanController::class, 'update']);
    Route::delete('/riwayat_penghargaan/{id}', [APIRiwayatPenghargaanController::class, 'delete']);

    // RiwayatPangkat API
    Route::get('/riwayat_pangkat', [APIRiwayatPangkatController::class, 'getall']);
    Route::get('/riwayat_pangkat/{id}', [APIRiwayatPangkatController::class, 'get']);
    Route::post('/riwayat_pangkat', [APIRiwayatPangkatController::class, 'create']);
    Route::put('/riwayat_pangkat/{id}', [APIRiwayatPangkatController::class, 'update']);
    Route::delete('/riwayat_pangkat/{id}', [APIRiwayatPangkatController::class, 'delete']);

    // Struktur API
    Route::get('/struktur', [APIStrukturController::class, 'getall']);
    Route::get('/struktur/{id}', [APIStrukturController::class, 'get']);
    Route::post('/struktur', [APIStrukturController::class, 'create']);
    Route::put('/struktur/{id}', [APIStrukturController::class, 'update']);
    Route::delete('/struktur/{id}', [APIStrukturController::class, 'delete']);
    Route::get('/struktur/eselon/{id}', [APIStrukturController::class, 'getallbyeselon']);
    Route::get('/struktur/grade/{id}', [APIStrukturController::class, 'getallbygrade']);
    Route::get('/struktur/jabatan_fungsional/{id}', [APIStrukturController::class, 'getallbyjabatanfungsional']);
    Route::get('/struktur/jabatan_struktural/{id}', [APIStrukturController::class, 'getallbyjabatanstruktural']);
    Route::get('/struktur/parent/{id}', [APIStrukturController::class, 'getallbyparent']);
});
