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
use Illuminate\Support\Facades\Redis;
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
    Route::post('/create-pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::put('/update-pegawai', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    Route::get('/unit-kerja', [UnitKerjaController::class, 'index'])->name('unit-kerja.index');
    Route::post('/create-unit-kerja', [UnitKerjaController::class, 'store'])->name('unit-kerja.store');
    Route::put('/update-unit-kerja/{id}', [UnitKerjaController::class, 'update'])->name('unit-kerja.update');
    Route::delete('/delete-unit-kerja/{id}', [UnitKerjaController::class, 'destroy'])->name('unit-kerja.destroy');

    Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::post('/create-fakultas', [FakultasController::class, 'store'])->name('fakultas.store');
    Route::put('/update-fakultas/{id}', [FakultasController::class, 'update'])->name('fakultas.update');
    Route::delete('/delete-fakultas/{id}', [FakultasController::class, 'destroy'])->name('fakultas.destroy');

    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::post('/create-jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::put('/update-jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/delete-jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    Route::get('/program-studi', [ProgramStudiController::class, 'index'])->name('program-studi.index');
    Route::post('/create-program-studi', [ProgramStudiController::class, 'store'])->name('program-studi.store');
    Route::put('/update-program-studi/{id}', [ProgramStudiController::class, 'update'])->name('program-studi.update');
    Route::delete('/delete-program-studi/{id}', [ProgramStudiController::class, 'destroy'])->name('program-studi.destroy');

    Route::get('/kelompok-pegawai', [KelompokPegawaiController::class, 'index'])->name('kelompok-pegawai.index');
    Route::post('/create-kelompok-pegawai', [KelompokPegawaiController::class, 'store'])->name('kelompok-pegawai.store');
    Route::put('/update-kelompok-pegawai/{id}', [KelompokPegawaiController::class, 'update'])->name('kelompok-pegawai.update');
    Route::delete('/delete-kelompok-pegawai/{id}', [KelompokPegawaiController::class, 'destroy'])->name('kelompok-pegawai.destroy');

    Route::get('/jenis-pegawai', [JenisPegawaiController::class, 'index'])->name('jenis-pegawai.index');
    Route::post('/create-jenis-pegawai', [JenisPegawaiController::class, 'store'])->name('jenis-pegawai.store');
    Route::put('/update-jenis-pegawai/{id}', [JenisPegawaiController::class, 'update'])->name('jenis-pegawai.update');
    Route::delete('/delete-jenis-pegawai/{id}', [JenisPegawaiController::class, 'destroy'])->name('jenis-pegawai.destroy');

    Route::get('/group-user', [GroupUserController::class, 'index'])->name('group-user.index');
    Route::post('/create-group-user', [GroupUserController::class, 'store'])->name('group-user.store');
    Route::put('/update-group-user/{id}', [GroupUserController::class, 'update'])->name('group-user.update');
    Route::delete('/delete-group-user/{id}', [GroupUserController::class, 'destroy'])->name('group-user.destroy');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/create-user', [UserController::class, 'store'])->name('user.store');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/golongan', [GolonganController::class, 'index'])->name('golongan.index');
    Route::post('/create-golongan', [GolonganController::class, 'store'])->name('golongan.store');
    Route::put('/update-golongan/{id}', [GolonganController::class, 'update'])->name('golongan.update');
    Route::delete('/delete-golongan/{id}', [GolonganController::class, 'destroy'])->name('golongan.destroy');

    Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur.index');
    Route::post('/create-struktur', [StrukturController::class, 'store'])->name('struktur.store');
    Route::put('/update-struktur/{id}', [StrukturController::class, 'update'])->name('struktur.update');
    Route::delete('/delete-struktur/{id}', [StrukturController::class, 'destroy'])->name('struktur.destroy');

    Route::get('/gaji-pokok', [GajiPokokController::class, 'index'])->name('gaji-pokok.index');
    Route::post('/create-gaji-pokok', [GajiPokokController::class, 'store'])->name('gaji-pokok.store');
    Route::put('/update-gaji-pokok/{id}', [GajiPokokController::class, 'update'])->name('gaji-pokok.update');
    Route::delete('/delete-gaji-pokok/{id}', [GajiPokokController::class, 'destroy'])->name('gaji-pokok.destroy');

    Route::get('/jabatan-struktural', [JabatanStrukturalController::class, 'index'])->name('jabatan-struktural.index');
    Route::post('/create-jabatan-struktural', [JabatanStrukturalController::class, 'store'])->name('jabatan-struktural.store');
    Route::put('/update-jabatan-struktural/{id}', [JabatanStrukturalController::class, 'update'])->name('jabatan-struktural.update');
    Route::delete('/delete-jabatan-struktural/{id}', [JabatanStrukturalController::class, 'destroy'])->name('jabatan-struktural.destroy');

    Route::get('/jabatan-fungsional', [JabatanFungsionalController::class, 'index'])->name('jabatan-fungsional.index');
    Route::post('/create-jabatan-fungsional', [JabatanFungsionalController::class, 'store'])->name('jabatan-fungsional.store');
    Route::put('/update-jabatan-fungsional/{id}', [JabatanFungsionalController::class, 'update'])->name('jabatan-fungsional.update');
    Route::delete('/delete-jabatan-fungsional/{id}', [JabatanFungsionalController::class, 'destroy'])->name('jabatan-fungsional.destroy');

    Route::get('/grade', [GradeController::class, 'index'])->name('grade.index');
    Route::post('/create-grade', [GradeController::class, 'store'])->name('grade.store');
    Route::put('/update-grade/{id}', [GradeController::class, 'update'])->name('grade.update');
    Route::delete('/delete-grade/{id}', [GradeController::class, 'destroy'])->name('grade.destroy');

    Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan.index');
    Route::post('/create-pendidikan', [PendidikanController::class, 'store'])->name('pendidikan.store');
    Route::put('/update-pendidikan/{id}', [PendidikanController::class, 'update'])->name('pendidikan.update');
    Route::delete('/delete-pendidikan/{id}', [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');

    Route::get('/hukuman-disiplin', [HukumanDisiplinController::class, 'index'])->name('hukuman-disiplin.index');
    Route::post('/create-hukuman-disiplin', [HukumanDisiplinController::class, 'store'])->name('hukuman-disiplin.store');
    Route::put('/update-hukuman-disiplin/{id}', [HukumanDisiplinController::class, 'update'])->name('hukuman-disiplin.update');
    Route::delete('/delete-hukuman-disiplin/{id}', [HukumanDisiplinController::class, 'destroy'])->name('hukuman-disiplin.destroy');

    Route::get('/lokasi-kerja', [LokasiKerjaController::class, 'index'])->name('lokasi-kerja.index');
    Route::post('/create-lokasi-kerja', [LokasiKerjaController::class, 'store'])->name('lokasi-kerja.store');
    Route::put('/update-lokasi-kerja/{id}', [LokasiKerjaController::class, 'update'])->name('lokasi-kerja.update');
    Route::delete('/delete-lokasi-kerja/{id}', [LokasiKerjaController::class, 'destroy'])->name('lokasi-kerja.destroy');

    Route::get('/eselon', [EselonController::class, 'index'])->name('eselon.index');
    Route::post('/create-eselon', [EselonController::class, 'store'])->name('eselon.store');
    Route::put('/update-eselon/{id}', [EselonController::class, 'update'])->name('eselon.update');
    Route::delete('/delete-eselon/{id}', [EselonController::class, 'destroy'])->name('eselon.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
