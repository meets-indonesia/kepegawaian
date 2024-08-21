<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Prodi::with(['jurusan'])->get();
        $jurusan = Jurusan::all();
        return view('pages.program-studi', [
            'pagename' => "program-studi",
            'jurusan' => $jurusan,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-program-studi', [
            'pagename' => "create-program-studi"
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
            'jurusan_id' => 'required'
        ]);

        // Create a new Prodi record
        Prodi::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('program-studi.index')
                         ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $Prodi)
    {
        return view('pages.show-program-studi', [
            'pagename' => "show-program-studi",
            'Prodi' => $Prodi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $Prodi)
    {
        return view('pages.edit-program-studi', [
            'pagename' => "edit-program-studi",
            'Prodi' => $Prodi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $Prodi)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jurusan_id' => 'required'
        ]);

        // Update the existing Prodi record
        Prodi::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('program-studi.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Prodi::find($request->id);
        // Delete the Prodi record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('program-studi.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
