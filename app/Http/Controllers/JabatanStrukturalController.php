<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\JabatanStruktural;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Find the JabatanStruktural record
        $jabatanStruktural = JabatanStruktural::findOrFail($request->id);

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'masa' => 'required|numeric',
            'eselon_id' => 'required|exists:eselon,id',
        ]);

        // If the user is not an admin, save the update request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $jabatanStruktural->id,
                'validated_data' => $validatedData,
                'type' => 'JabatanStruktural',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $jabatanStruktural->id, $updateData);

            return redirect()->back()->with('success', 'Jabatan Struktural update request submitted successfully.');
        }

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
        // Find the JabatanStruktural record
        $jabatanStruktural = JabatanStruktural::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $jabatanStruktural->id,
                'name' => $jabatanStruktural->name,
                'masa' => $jabatanStruktural->masa,
                'eselon_id' => $jabatanStruktural->eselon_id,
                'type' => 'JabatanStruktural',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $jabatanStruktural->id, $deleteData);

            return redirect()->back()->with('success', 'Jabatan Struktural delete request submitted successfully.');
        }

        // Delete the JabatanStruktural record
        $jabatanStruktural->delete();

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural deleted successfully.');
    }
}
