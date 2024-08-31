<?php

namespace App\Http\Controllers;

use App\Models\RiwayatGrade;
use Illuminate\Http\Request;

class RiwayatGradeController extends Controller
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
    public function show(RiwayatGrade $riwayatGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatGrade $riwayatGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Retrieve the RiwayatGolongan instance by its ID
        $riwayatGolongan = RiwayatGrade::whereId($request->id)->firstOrFail();

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
    public function destroy(RiwayatGrade $riwayatGrade)
    {
        //
    }
}
