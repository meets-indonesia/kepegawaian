<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Golongan::all();
        return view('pages.golongan', [
            'pagename' => "golongan",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-golongan', [
            'pagename' => "create-golongan"
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
            'golongan' => 'required',
        ]);

        // Create a new Golongan record
        Golongan::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('golongan.index')
                         ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Golongan $Golongan)
    {
        return view('pages.show-golongan', [
            'pagename' => "show-golongan",
            'Golongan' => $Golongan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Golongan $Golongan)
    {
        return view('pages.edit-golongan', [
            'pagename' => "edit-golongan",
            'Golongan' => $Golongan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Golongan $Golongan)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'golongan' => 'required',
        ]);

        // Update the existing Golongan record
        Golongan::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('golongan.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Golongan::find($request->id);
        // Delete the Golongan record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('golongan.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
