<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;

class RiwayatPendidikanController extends Controller
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
    public function show(RiwayatPendidikan $riwayatPendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPendidikan $riwayatPendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $riwayatPendidikan = RiwayatPendidikan::whereId($request->id)->firstOrFail();

        $validatedData = $request->validate([
            'bidang_ilmu' => 'required',
            'nama_sekolah' => 'required',
            'tahun_selesai' => 'required|date',
        ]);

        $riwayatPendidikan->update($validatedData);

        return redirect()->back()
            ->with('success', 'Riwayat Pendidikan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatPendidikan $riwayatPendidikan)
    {
        //
    }
}
