<?php

namespace App\Http\Controllers;

use App\Models\GajiPokok;
use App\Models\Golongan; // Add this line
use Illuminate\Http\Request;

class GajiPokokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GajiPokok::with([
            'golongan'
        ])->get();
        $golongan = Golongan::all();
        return view('pages.gaji-pokok', [
            'pagename' => "gaji-pokok",
            'data' => $data,
            'golongan' => $golongan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'golongan_id' => 'required|exists:golongan,id',
            'masa_kerja' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        GajiPokok::create($request->all());

        return redirect()->route('gaji-pokok.index')->with('success', 'Gaji Pokok created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'golongan_id' => 'required|exists:golongan,id',
            'masa_kerja' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        GajiPokok::find($request->id)->update($request->all());

        return redirect()->route('gaji-pokok.index')->with('success', 'Gaji Pokok updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $gajiPokok = GajiPokok::find($request->id);

        $gajiPokok->delete();

        return redirect()->route('gaji-pokok.index')->with('success', 'Gaji Pokok deleted successfully.');
    }
}
