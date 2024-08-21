<?php

namespace App\Http\Controllers;

use App\Models\LokasiKerja;
use Illuminate\Http\Request;

class LokasiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LokasiKerja::all();
        return view('pages.lokasi-kerja', [
            'pagename' => "lokasi-kerja",
            'data' => $data
        ]);
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
    public function show(LokasiKerja $lokasiKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LokasiKerja $lokasiKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LokasiKerja $lokasiKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiKerja $lokasiKerja)
    {
        //
    }
}
