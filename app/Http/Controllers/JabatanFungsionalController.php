<?php

namespace App\Http\Controllers;

use App\Models\JabatanFungsional;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Find the jabatan fungsional
        $jabatanFungsional = JabatanFungsional::findOrFail($request->id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'masa' => 'nullable|string',
        ]);

        // If the user is not an admin, save the update request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $jabatanFungsional->id,
                'validated_data' => $validatedData,
                'type' => 'JabatanFungsional',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $jabatanFungsional->id, $updateData);

            return redirect()->back()->with('success', 'Jabatan Fungsional updated successfully');
        }


        JabatanFungsional::whereId($request->id)->first()->update($validatedData);

        return redirect()->route('jabatan-fungsional.index')->with('success', 'Jabatan Fungsional updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the jabatan fungsional
        $jabatanFungsional = JabatanFungsional::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $jabatanFungsional->id,
                'name' => $jabatanFungsional->name,
                'type' => 'JabatanFungsional',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $jabatanFungsional->id, $deleteData);

            return redirect()->back()->with('success', 'Delete request has been sent for approval.');
        }

        $jabatanFungsional->delete();

        return redirect()->route('jabatan-fungsional.index')->with('success', 'Jabatan Fungsional deleted successfully.');
    }
}
