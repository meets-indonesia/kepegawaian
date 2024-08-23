<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\Grade;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\PendingAction;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Find the struktur
        $struktur = Struktur::findOrFail($request->id);

        // Validate the incoming request data
        $validated = $request->validate([
            'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
            'jabatan_fungsional_id' => 'nullable|exists:jabatan_fungsional,id',
            'grade_id' => 'required|exists:grade,id',
            'eselon_id' => 'required|exists:eselon,id',
            'parent_id' => 'nullable|exists:struktur,id',
            'jv' => 'required|string|max:255',
        ]);

        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $struktur->id,
                'validated_data' => $validated,
                'type' => 'Struktur',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $struktur->id, $updateData);

            return redirect()->back()->with('success', 'Struktur update request submitted successfully.');
        }

        Struktur::where('id', $request->id)->update($validated);

        return redirect()->route('struktur.index')->with('success', 'Struktur updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the struktur
        $struktur = Struktur::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $struktur->id,
                'jabatan_struktural_id' => $struktur->jabatan_struktural_id,
                'jabatan_fungsional_id' => $struktur->jabatan_fungsional_id,
                'grade_id' => $struktur->grade_id,
                'eselon_id' => $struktur->eselon_id,
                'parent_id' => $struktur->parent_id,
                'jv' => $struktur->jv,
                'type' => 'Struktur',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $struktur->id, $deleteData);

            return redirect()->route('struktur.index')->with('success', 'Struktur delete request submitted successfully.');
        }

        $struktur->delete();

        return redirect()->route('struktur.index')->with('success', 'Struktur deleted successfully.');
    }
}
