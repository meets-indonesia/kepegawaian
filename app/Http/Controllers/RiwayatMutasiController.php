<?php

namespace App\Http\Controllers;

use App\Models\RiwayatMutasi;
use Illuminate\Http\Request;

class RiwayatMutasiController extends Controller
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
    public function show(RiwayatMutasi $riwayatMutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatMutasi $riwayatMutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiwayatMutasi $riwayatMutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $riwayat = RiwayatMutasi::findOrFail($request->id);

        $riwayat->delete();

        return redirect()->back()->with('success', 'Riwayat deleted successfully.');
    }
}
