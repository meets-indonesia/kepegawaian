<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Fakultas::all();
        return view('pages.fakultas', [
            'pagename' => "fakultas",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-fakultas', [
            'pagename' => "create-fakultas"
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

        // Create a new Fakultas record
        Fakultas::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('fakultas.index')
                         ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $Fakultas)
    {
        return view('pages.show-fakultas', [
            'pagename' => "show-fakultas",
            'Fakultas' => $Fakultas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $Fakultas)
    {
        return view('pages.edit-fakultas', [
            'pagename' => "edit-fakultas",
            'Fakultas' => $Fakultas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fakultas $Fakultas)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the existing Fakultas record
        Fakultas::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('fakultas.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Fakultas::find($request->id);
        // Delete the Fakultas record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('fakultas.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
