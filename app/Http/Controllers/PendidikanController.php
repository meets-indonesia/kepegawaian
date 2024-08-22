<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pendidikan::all();
        return view('pages.pendidikan', [
            'pagename' => "pendidikan",
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

        Pendidikan::create($validatedData);

        return redirect()->route('pendidikan.index')->with('success', 'Pendidikan created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pendidikan = Pendidikan::whereId($id)->firstOrFail();
        $pendidikan->update($validatedData);

        return redirect()->route('pendidikan.index')->with('success', 'Pendidikan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $pendidikan = Pendidikan::whereId($request->id)->firstOrFail();
        $pendidikan->delete();

        return redirect()->route('pendidikan.index')->with('success', 'Pendidikan deleted successfully.');
    }
}
