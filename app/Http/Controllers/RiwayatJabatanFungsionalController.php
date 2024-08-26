<?php

namespace App\Http\Controllers;

use App\Models\RiwayatJabatanFungsional;
use App\Models\Pegawai;
use App\Models\JabatanFungsional;
use Illuminate\Http\Request;

class RiwayatJabatanFungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RiwayatJabatanFungsional::with(['pegawai', 'jabatanFungsional'])->get();
        $pegawais = Pegawai::all();
        $jabatanFungsionals = JabatanFungsional::all();
        return view('pages.riwayat-jabatan-fungsional', [
            'data' => $data,
            'pegawais' => $pegawais,
            'jabatanFungsionals' => $jabatanFungsionals,
            'pagename' => 'riwayat-jabatan-fungsional',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'jabatan_fungsional_id' => 'required|exists:jabatan_struktural,id',
            'tahun_mulai' => 'required',
            'tahun_selesai' => 'nullable|after_or_equal:tahun_mulai',
        ]);

        RiwayatJabatanFungsional::create($request->all());

        return redirect()->route('riwayat-jabatan-fungsional.index')
            ->with('success', 'Riwayat Jabatan Fungsional created successfully.');
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

        $riwayatJabatanStruktural = RiwayatJabatanFungsional::whereId($request->id)->firstOrFail();
        $riwayatJabatanStruktural->update($request->all());

        return redirect()->route('riwayat-jabatan-fungsional.index')
            ->with('success', 'Riwayat Jabatan Fungsional updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $riwayatJabatanStruktural = RiwayatJabatanFungsional::whereId($request->id)->firstOrFail();
        $riwayatJabatanStruktural->delete();

        return redirect()->route('riwayat-jabatan-fungsional.index')
            ->with('success', 'Riwayat Jabatan Fungsional deleted successfully.');
    }
}
