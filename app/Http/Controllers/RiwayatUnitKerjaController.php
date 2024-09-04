<?php

namespace App\Http\Controllers;

use App\Models\RiwayatUnitKerja;
use Illuminate\Http\Request;

class RiwayatUnitKerjaController extends Controller
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
    public function show(RiwayatUnitKerja $riwayatUnitKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatUnitKerja $riwayatUnitKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Retrieve the RiwayatGolongan instance by its ID
        $riwayatGolongan = RiwayatUnitKerja::whereId($request->id)->firstOrFail();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'tanggal_mulai' => 'required|date',
        ]);

        // Update the RiwayatGolongan instance with the validated data
        $riwayatGolongan->update($validatedData);

        // Return a response indicating success
        return redirect()->back()->with('success', 'Riwayat berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $riwayat = RiwayatUnitKerja::findOrFail($request->id);

        $riwayat->delete();

        return redirect()->back()->with('success', 'Riwayat deleted successfully.');
    }
}
