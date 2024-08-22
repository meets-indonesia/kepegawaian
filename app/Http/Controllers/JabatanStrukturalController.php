<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\JabatanStruktural;
use Illuminate\Http\Request;

class JabatanStrukturalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JabatanStruktural::with(['eselon'])->get();
        $eselon = Eselon::all();
        return view('pages.jabatan-struktural', [
            'pagename' => "jabatan-struktural",
            'data' => $data,
            'eselon' => $eselon
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'masa' => 'required|numeric',
            'eselon_id' => 'required|exists:eselon,id',
        ]);

        // Create a new JabatanStruktural record
        JabatanStruktural::create($validatedData);

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'masa' => 'required|numeric',
            'eselon_id' => 'required|exists:eselon,id',
        ]);

        // Update the JabatanStruktural record
        JabatanStruktural::whereId($request->id)->first()->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $jabatanStruktural = JabatanStruktural::find($request->id);
        // Delete the JabatanStruktural record
        $jabatanStruktural->delete();

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural deleted successfully.');
    }
}
