<?php

namespace App\Http\Controllers;

use App\Models\RiwayatJenisPegawai;
use Illuminate\Http\Request;

class RiwayatJenisPegawaiController extends Controller
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
    public function show(RiwayatJenisPegawai $riwayatJenisPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatJenisPegawai $riwayatJenisPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $riwayatJenisPegawai = RiwayatJenisPegawai::whereId($request->id)->firstOrFail();
      
      $validatedData = $request->validate([
        'tahun_mulai' => 'required|date',
        ]);

        $riwayatJenisPegawai->update($validatedData);

        return redirect()->back()->with('success', 'Riwayat jenis pegawai updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $riwayat = RiwayatJenisPegawai::findOrFail($request->id);

        $riwayat->delete();

        return redirect()->back()->with('success', 'Riwayat deleted successfully.');
    }
}
