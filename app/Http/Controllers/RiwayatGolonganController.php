<?php

namespace App\Http\Controllers;

use App\Models\RiwayatGolongan;
use Illuminate\Http\Request;

class RiwayatGolonganController extends Controller
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
    public function show(RiwayatGolongan $riwayatGolongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatGolongan $riwayatGolongan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Retrieve the RiwayatGolongan instance by its ID
        $riwayatGolongan = RiwayatGolongan::whereId($request->id)->firstOrFail();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'tahun_mulai' => 'required|date',
        ]);

        // Update the RiwayatGolongan instance with the validated data
        $riwayatGolongan->update($validatedData);

        // Return a response indicating success
        return redirect()->back()->with('success', 'Riwayat golongan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatGolongan $riwayatGolongan)
    {
        //
    }
}
