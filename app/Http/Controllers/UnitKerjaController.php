<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UnitKerja::all();
        return view('pages.unit-kerja', [
            'pagename' => "unit-kerja",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-unit-kerja', [
            'pagename' => "create-unit-kerja"
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

        // Create a new UnitKerja record
        UnitKerja::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('unit-kerja.index')
                         ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitKerja $unitKerja)
    {
        return view('pages.show-unit-kerja', [
            'pagename' => "show-unit-kerja",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitKerja $unitKerja)
    {
        return view('pages.edit-unit-kerja', [
            'pagename' => "edit-unit-kerja",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitKerja $unitKerja)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the existing UnitKerja record
        $unitKerja->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('unit-kerja.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        dd($request);
        // Delete the UnitKerja record
        $unitKerja->delete();

        // Redirect to the index page with a success message
        return redirect()->route('unit-kerja.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
