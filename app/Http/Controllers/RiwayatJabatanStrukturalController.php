<?php

namespace App\Http\Controllers;

use App\Models\RiwayatJabatanStruktural;
use App\Models\Pegawai; // Add this line to import the Pegawai model
use App\Models\JabatanStruktural; // Add this line to import the JabatanStruktural model
use Illuminate\Http\Request;

class RiwayatJabatanStrukturalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RiwayatJabatanStruktural::with(['pegawai', 'jabatanStruktural'])->get();
        $pegawais = Pegawai::all();
        $jabatanStrukturals = JabatanStruktural::all();
        return view('pages.riwayat-jabatan-struktural', [
            'data' => $data,
            'pegawais' => $pegawais,
            'jabatanStrukturals' => $jabatanStrukturals,
            'pagename' => 'riwayat-jabatan-struktural',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
            'tahun_mulai' => 'required',
            'tahun_selesai' => 'nullable|after_or_equal:tahun_mulai',
        ]);

        RiwayatJabatanStruktural::create($request->all());

        return redirect()->route('riwayat-jabatan-struktural.index')
                         ->with('success', 'Riwayat Jabatan Struktural created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'tahun_mulai' => 'required|',
            'tahun_selesai' => 'nullable|after_or_equal:tahun_mulai',
        ]);

        $riwayatJabatanStruktural = RiwayatJabatanStruktural::whereId($request->id)->firstOrFail();
        $riwayatJabatanStruktural->update($request->all());

        return redirect()->route('riwayat-jabatan-struktural.index')
                         ->with('success', 'Riwayat Jabatan Struktural updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $riwayatJabatanStruktural = RiwayatJabatanStruktural::whereId($request->id)->firstOrFail();
        $riwayatJabatanStruktural->delete();

        return redirect()->route('riwayat-jabatan-struktural.index')
                         ->with('success', 'Riwayat Jabatan Struktural deleted successfully.');
    }
}
