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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        LokasiKerja::create($validatedData);

        return redirect()->back()->with('success', 'Lokasi Kerja created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lokasiKerja = LokasiKerja::whereId($request->id)->first();
        $lokasiKerja->update($validatedData);

        return redirect()->back()->with('success', 'Lokasi Kerja updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $lokasiKerja = LokasiKerja::whereId($request->id)->first();
        $lokasiKerja->delete();

        return redirect()->back()->with('success', 'Lokasi Kerja deleted successfully');
    }
}
