<?php

namespace App\Http\Controllers;

use App\Models\GajiPokok;
use App\Models\Golongan; // Add this line
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GajiPokokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GajiPokok::with([
            'golongan'
        ])->get();
        $golongan = Golongan::all();
        return view('pages.gaji-pokok', [
            'pagename' => "gaji-pokok",
            'data' => $data,
            'golongan' => $golongan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'golongan_id' => 'required|exists:golongan,id',
            'masa_kerja' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        GajiPokok::create($request->all());

        return redirect()->route('gaji-pokok.index')->with('success', 'Gaji Pokok created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Find the gaji pokok
        $gajiPokok = GajiPokok::findOrFail($request->id);

        // Validate the incoming request data
        $request->validate([
            'golongan_id' => 'required|exists:golongan,id',
            'masa_kerja' => 'required',
            'gaji_pokok' => 'required|numeric',
        ]);

        // If the user is not an admin, create a pending action
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $gajiPokok->id,
                'validated_data' => $request->all(),
                'type' => 'GajiPokok',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $gajiPokok->id, $updateData);

            return redirect()->route('gaji-pokok.index')
                ->with('success', 'Gaji Pokok update request submitted successfully.');
        }

        GajiPokok::find($request->id)->update($request->all());

        return redirect()->route('gaji-pokok.index')->with('success', 'Gaji Pokok updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $gajiPokok = GajiPokok::findOrFail($request->id);

        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $gajiPokok->id,
                'golongan_id' => $gajiPokok->golongan_id,
                'masa_kerja' => $gajiPokok->masa_kerja,
                'gaji_pokok' => $gajiPokok->gaji_pokok,
                'type' => 'GajiPokok',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $gajiPokok->id, $deleteData);

            return redirect()->route('gaji-pokok.index')
                ->with('success', 'Delete request has been sent for approval.');
        }

        $gajiPokok->delete();

        return redirect()->route('gaji-pokok.index')->with('success', 'Gaji Pokok deleted successfully.');
    }
}
