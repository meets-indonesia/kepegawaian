<?php

namespace App\Http\Controllers;

use App\Models\KelompokPegawai;
use Illuminate\Http\Request;

class KelompokPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KelompokPegawai::all();
        return view('pages.kelompok-pegawai', [
            'pagename' => "kelompok-pegawai",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-kelompok-pegawai', [
            'pagename' => "create-kelompok-pegawai"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new KelompokPegawai record
        KelompokPegawai::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('kelompok-pegawai.index')
                         ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelompokPegawai $unitKerja)
    {
        return view('pages.show-kelompok-pegawai', [
            'pagename' => "show-kelompok-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelompokPegawai $unitKerja)
    {
        return view('pages.edit-kelompok-pegawai', [
            'pagename' => "edit-kelompok-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelompokPegawai $unitKerja)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the existing KelompokPegawai record
        KelompokPegawai::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('kelompok-pegawai.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = KelompokPegawai::find($request->id);
        // Delete the KelompokPegawai record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('kelompok-pegawai.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
