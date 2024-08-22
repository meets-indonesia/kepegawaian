<?php

namespace App\Http\Controllers;

use App\Models\JabatanFungsional;
use Illuminate\Http\Request;

class JabatanFungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JabatanFungsional::all();
        return view('pages.jabatan-fungsional', [
            'pagename' => "jabatan-fungsional",
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
            'masa' => 'nullable|string',
        ]);

        JabatanFungsional::create($validatedData);

        return redirect()->route('jabatan-fungsional.index')->with('success', 'Jabatan Fungsional created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'masa' => 'nullable|string',
        ]);


        JabatanFungsional::whereId($request->id)->first()->update($validatedData);

        return redirect()->route('jabatan-fungsional.index')->with('success', 'Jabatan Fungsional updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $jabatanFungsional = JabatanFungsional::whereId($request->id)->first();
        $jabatanFungsional->delete();

        return redirect()->route('jabatan-fungsional.index')->with('success', 'Jabatan Fungsional deleted successfully.');
    }
}
