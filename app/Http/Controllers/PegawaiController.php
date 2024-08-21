<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\KelompokPegawai;
use App\Models\JenisPegawai;
use App\Models\UnitKerja;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Grade;
use App\Models\Pendidikan;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all necessary data for the form
        $data = Pegawai::all();
        $golongan = Golongan::all();
        $kelompok_pegawai = KelompokPegawai::all();
        $jenis_pegawai = JenisPegawai::all();
        $unit_kerja = UnitKerja::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $grade = Grade::all();
        $pendidikan = Pendidikan::all();
        $jabatan_fungsional = JabatanFungsional::all();
        $jabatan_struktural = JabatanStruktural::all();
    
        return view('pages.pegawai', [
            'pagename' => "pegawai",
            'data' => $data,
            'golongan' => $golongan,
            'kelompok_pegawai' => $kelompok_pegawai,
            'jenis_pegawai' => $jenis_pegawai,
            'unit_kerja' => $unit_kerja,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'grade' => $grade,
            'pendidikan' => $pendidikan,
            'jabatan_fungsional' => $jabatan_fungsional,
            'jabatan_struktural' => $jabatan_struktural
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nip' => 'required|unique:pegawai,nip',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
            'golongan_id' => 'required|exists:golongan,id',
            'kelompok_pegawai_id' => 'required|exists:kelompok_pegawai,id',
            'jenis_pegawai_id' => 'required|exists:jenis_pegawai,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'grade_id' => 'required|exists:grade,id',
            'tamat_cpns' => 'nullable|date',
            'tamat_pns' => 'nullable|date',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'jabatan_fungsional_id' => 'nullable|exists:jabatan_fungsional,id',
            'jabatan_struktural_id' => 'nullable|exists:jabatan_struktural,id',
        ]);

        // Create a new Pegawai instance
        Pegawai::create($validated);

        // Redirect to a page or return a response
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pages.edit-pegawai', [
            'pagename' => "edit-pegawai",
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nip' => 'required|unique:pegawai,nip,' . $pegawai->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email,' . $pegawai->id,
            'golongan_id' => 'required|exists:golongan,id',
            'kelompok_pegawai_id' => 'required|exists:kelompok_pegawai,id',
            'jenis_pegawai_id' => 'required|exists:jenis_pegawai,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'grade_id' => 'required|exists:grade,id',
            'tamat_cpns' => 'nullable|date',
            'tamat_pns' => 'nullable|date',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'jabatan_fungsional_id' => 'nullable|exists:jabatan_fungsional,id',
            'jabatan_struktural_id' => 'nullable|exists:jabatan_struktural,id',
        ]);

        // Update the Pegawai instance
        $pegawai->update($validated);

        // Redirect to a page or return a response
        return redirect()->route('pegawai.index')->with('success', 'Pegawai updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        // Delete the Pegawai instance
        $pegawai->delete();

        // Redirect to a page or return a response
        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}

