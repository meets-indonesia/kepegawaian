<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Find the pendidikan
        $pendidikan = Pendidikan::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // If the user is not an admin, save the update request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $pendidikan->id,
                'validated_data' => $validatedData,
                'type' => 'Pendidikan',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $pendidikan->id, $updateData);

            return redirect()->back()->with('success', 'Pendidikan updated successfully.');
        }

        $pendidikan = Pendidikan::whereId($id)->firstOrFail();
        $pendidikan->update($validatedData);

        return redirect()->route('pendidikan.index')->with('success', 'Pendidikan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the pendidikan
        $pendidikan = Pendidikan::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $pendidikan->id,
                'name' => $pendidikan->name,
                'type' => 'Pendidikan',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $pendidikan->id, $deleteData);

            return redirect()->back()->with('success', 'Pendidikan delete request submitted successfully.');
        }

        $pendidikan->delete();

        return redirect()->route('pendidikan.index')->with('success', 'Pendidikan deleted successfully.');
    }
}
