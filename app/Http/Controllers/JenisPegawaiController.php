<?php

namespace App\Http\Controllers;

use App\Models\JenisPegawai;
use Illuminate\Http\Request;

class JenisPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisPegawai::all();
        return view('pages.jenis-pegawai', [
            'pagename' => "jenis-pegawai",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-jenis-pegawai', [
            'pagename' => "create-jenis-pegawai"
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

        // Create a new JenisPegawai record
        JenisPegawai::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jenis-pegawai.index')
                         ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPegawai $unitKerja)
    {
        return view('pages.show-jenis-pegawai', [
            'pagename' => "show-jenis-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPegawai $unitKerja)
    {
        return view('pages.edit-jenis-pegawai', [
            'pagename' => "edit-jenis-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPegawai $unitKerja)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the existing JenisPegawai record
        JenisPegawai::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jenis-pegawai.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = JenisPegawai::find($request->id);
        // Delete the JenisPegawai record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('jenis-pegawai.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
