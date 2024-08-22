<?php

namespace App\Http\Controllers;

use App\Models\JabatanStruktural;
use App\Models\JabatanFungsional;
use App\Models\Grade;
use App\Models\Pendidikan;
use App\Models\KelompokPegawai;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Grade::with([
            'jabatanFungsional',
            'jabatanStruktural',
            'pendidikan',
            'kelompokPegawai',
            'unitKerja'
        ])->get();
        $jabatanFungsional = JabatanFungsional::all();
        $jabatanStruktural = JabatanStruktural::all();
        $pendidikan = Pendidikan::all();
        $kelompokPegawai = KelompokPegawai::all();
        $unitKerja = UnitKerja::all();
        return view('pages.grade', [
            'pagename' => "grade",
            'data' => $data,
            'jabatanFungsional' => $jabatanFungsional,
            'jabatanStruktural' => $jabatanStruktural,
            'pendidikan' => $pendidikan,
            'kelompokPegawai' => $kelompokPegawai,
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string',
            'jabatan_fungsional_id' => 'required|exists:jabatan_fungsional,id',
            'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'kelompok_pegawai_id' => 'required|exists:kelompok_pegawai,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
        ]);

        Grade::create($validatedData);

        return redirect()->route('grade.index')->with('success', 'Grade created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string',
            'jabatan_fungsional_id' => 'required|exists:jabatan_fungsional,id',
            'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'kelompok_pegawai_id' => 'required|exists:kelompok_pegawai,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
        ]);

        $grade = Grade::whereId($request->id)->first();
        $grade->update($validatedData);

        return redirect()->route('grade.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $grade = Grade::whereId($request->id)->first();
        $grade->delete();

        return redirect()->route('grade.index')->with('success', 'Grade deleted successfully.');
    }
}
