<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKelompokPegawai;
use Illuminate\Http\Request;

class RiwayatKelompokPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatKelompokPegawai $riwayatKelompokPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatKelompokPegawai $riwayatKelompokPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $riwayatKelompokPegawai = RiwayatKelompokPegawai::whereId($request->id)->firstOrFail();

        $validatedData = $request->validate([
            'tahun_mulai' => 'required|date',
        ]);

        $riwayatKelompokPegawai->update($validatedData);

        return redirect()->back()->with('success', 'Riwayat kelompok pegawai updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $riwayat = RiwayatKelompokPegawai::findOrFail($request->id);

        $riwayat->delete();

        return redirect()->back()->with('success', 'Riwayat deleted successfully.');
    }
}
