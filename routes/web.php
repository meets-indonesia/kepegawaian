<?php

use App\Http\Controllers\EselonController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\GajiPokokController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\HukumanDisiplinController;
use App\Http\Controllers\JabatanFungsionalController;
use App\Http\Controllers\JabatanStrukturalController;
use App\Http\Controllers\JenisPegawaiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelompokPegawaiController;
use App\Http\Controllers\LokasiKerjaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::post('/create-pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');;
    Route::put('/update-pegawai/{id}', [PegawaiController::class, 'update']);
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    
    Route::get('/unit-kerja', [UnitKerjaController::class, 'index'])->name('unit-kerja.index');;
    Route::post('/create-unit-kerja', [UnitKerjaController::class, 'store'])->name('unit-kerja.store');
    Route::put('/update-unit-kerja/{id}', [UnitKerjaController::class, 'update'])->name('unit-kerja.update');
    Route::delete('/delete-unit-kerja/{id}', [UnitKerjaController::class, 'destroy'])->name('unit-kerja.destroy');
    
    Route::get('/fakultas', [FakultasController::class, 'index']);
    Route::post('/create-fakultas', [FakultasController::class, 'store']);
    Route::put('/update-fakultas/{id}', [FakultasController::class, 'update']);
    Route::delete('/delete-fakultas/{id}', [FakultasController::class, 'destroy']);
    
    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::post('/create-jurusan', [JurusanController::class, 'store']);
    Route::put('/update-jurusan/{id}', [JurusanController::class, 'update']);
    Route::delete('/delete-jurusan/{id}', [JurusanController::class, 'destroy']);
    
    Route::get('/program-studi', [ProgramStudiController::class, 'index']);
    Route::post('/create-program-studi', [ProgramStudiController::class, 'store']);
    Route::put('/update-program-studi/{id}', [ProgramStudiController::class, 'update']);
    Route::delete('/delete-program-studi/{id}', [ProgramStudiController::class, 'destroy']);
    
    Route::get('/kelompok-pegawai', [KelompokPegawaiController::class, 'index']);
    Route::post('/create-kelompok-pegawai', [KelompokPegawaiController::class, 'store']);
    Route::put('/update-kelompok-pegawai/{id}', [KelompokPegawaiController::class, 'update']);
    Route::delete('/delete-kelompok-pegawai/{id}', [KelompokPegawaiController::class, 'destroy']);
    
    Route::get('/jenis-pegawai', [JenisPegawaiController::class, 'index']);
    Route::post('/create-jenis-pegawai', [JenisPegawaiController::class, 'store']);
    Route::put('/update-jenis-pegawai/{id}', [JenisPegawaiController::class, 'update']);
    Route::delete('/delete-jenis-pegawai/{id}', [JenisPegawaiController::class, 'destroy']);
    
    Route::get('/group-user', [GroupUserController::class, 'index']);
    Route::post('/create-group-user', [GroupUserController::class, 'store']);
    Route::put('/update-group-user/{id}', [GroupUserController::class, 'update']);
    Route::delete('/delete-group-user/{id}', [GroupUserController::class, 'destroy']);
    
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/create-user', [UserController::class, 'store']);
    Route::put('/update-user/{id}', [UserController::class, 'update']);
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);
    
    Route::get('/golongan', [GolonganController::class, 'index']);
    Route::post('/create-golongan', [GolonganController::class, 'store']);
    Route::put('/update-golongan/{id}', [GolonganController::class, 'update']);
    Route::delete('/delete-golongan/{id}', [GolonganController::class, 'destroy']);
    
    Route::get('/struktur', [StrukturController::class, 'index']);
    Route::post('/create-struktur', [StrukturController::class, 'store']);
    Route::put('/update-struktur/{id}', [StrukturController::class, 'update']);
    Route::delete('/delete-struktur/{id}', [StrukturController::class, 'destroy']);
    
    Route::get('/gaji-pokok', [GajiPokokController::class, 'index']);
    Route::post('/create-gaji-pokok', [GajiPokokController::class, 'store']);
    Route::put('/update-gaji-pokok/{id}', [GajiPokokController::class, 'update']);
    Route::delete('/delete-gaji-pokok/{id}', [GajiPokokController::class, 'destroy']);
    
    Route::get('/jabatan-struktural', [JabatanStrukturalController::class, 'index']);
    Route::post('/create-jabatan-struktural', [JabatanStrukturalController::class, 'store']);
    Route::put('/update-jabatan-struktural/{id}', [JabatanStrukturalController::class, 'update']);
    Route::delete('/delete-jabatan-struktural/{id}', [JabatanStrukturalController::class, 'destroy']);
    
    Route::get('/jabatan-fungsional', [JabatanFungsionalController::class, 'index']);
    Route::post('/create-jabatan-fungsional', [JabatanFungsionalController::class, 'store']);
    Route::put('/update-jabatan-fungsional/{id}', [JabatanFungsionalController::class, 'update']);
    Route::delete('/delete-jabatan-fungsional/{id}', [JabatanFungsionalController::class, 'destroy']);
    
    Route::get('/grade', [GradeController::class, 'index']);
    Route::post('/create-grade', [GradeController::class, 'store']);
    Route::put('/update-grade/{id}', [GradeController::class, 'update']);
    Route::delete('/delete-grade/{id}', [GradeController::class, 'destroy']);
    
    Route::get('/pendidikan', [PendidikanController::class, 'index']);
    Route::post('/create-pendidikan', [PendidikanController::class, 'store']);
    Route::put('/update-pendidikan/{id}', [PendidikanController::class, 'update']);
    Route::delete('/delete-pendidikan/{id}', [PendidikanController::class, 'destroy']);
    
    Route::get('/hukuman-disiplin', [HukumanDisiplinController::class, 'index']);
    Route::post('/create-hukuman-disiplin', [HukumanDisiplinController::class, 'store']);
    Route::put('/update-hukuman-disiplin/{id}', [HukumanDisiplinController::class, 'update']);
    Route::delete('/delete-hukuman-disiplin/{id}', [HukumanDisiplinController::class, 'destroy']);
    
    Route::get('/lokasi-kerja', [LokasiKerjaController::class, 'index']);
    Route::post('/create-lokasi-kerja', [LokasiKerjaController::class, 'store']);
    Route::put('/update-lokasi-kerja/{id}', [LokasiKerjaController::class, 'update']);
    Route::delete('/delete-lokasi-kerja/{id}', [LokasiKerjaController::class, 'destroy']);
    
    Route::get('/eselon', [EselonController::class, 'index']);
    Route::post('/create-eselon', [EselonController::class, 'store']);
    Route::put('/update-eselon/{id}', [EselonController::class, 'update']);
    Route::delete('/delete-eselon/{id}', [EselonController::class, 'destroy']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
