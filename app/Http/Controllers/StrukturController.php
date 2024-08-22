<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\Grade;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Struktur::with([
            'jabatan_struktural',
            'jabatan_fungsional',
            'grade',
            'eselon',
            'parent',
        ])->get();

        $jabatan_struktural = JabatanStruktural::all();
        $jabatan_fungsional = JabatanFungsional::all();
        $grade = Grade::all();
        $eselon = Eselon::all();
        $parent = Struktur::all();

        return view('pages.struktur', [
            'pagename' => "struktur",
            'data' => $data,
            'jabatan_struktural' => $jabatan_struktural,
            'jabatan_fungsional' => $jabatan_fungsional,   
            'grade' => $grade,
            'eselon' => $eselon,
            'parent' => $parent,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
            'jabatan_fungsional_id' => 'nullable|exists:jabatan_fungsional,id',
            'grade_id' => 'required|exists:grade,id',
            'eselon_id' => 'required|exists:eselon,id',
            'parent_id' => 'nullable|exists:struktur,id',
            'jv' => 'required|string|max:255',
        ]);

        Struktur::create($request->all());

        return redirect()->route('struktur.index')->with('success', 'Struktur created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
            'jabatan_fungsional_id' => 'nullable|exists:jabatan_fungsional,id',
            'grade_id' => 'required|exists:grade,id',
            'eselon_id' => 'required|exists:eselon,id',
            'parent_id' => 'nullable|exists:struktur,id',
            'jv' => 'required|string|max:255',
        ]);

        Struktur::where('id', $request->id)->update($validated);

        return redirect()->route('struktur.index')->with('success', 'Struktur updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $struktur = Struktur::find($request->id);

        $struktur->delete();

        return redirect()->route('struktur.index')->with('success', 'Struktur deleted successfully.');
    }
}
