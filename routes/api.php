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
use App\Http\Controllers\APIPegawaiController;
use App\Http\Controllers\APIPendidikanController;
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
});
