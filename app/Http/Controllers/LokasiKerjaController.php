<?php

namespace App\Http\Controllers;

use App\Models\LokasiKerja;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokasiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LokasiKerja::all();
        return view('pages.lokasi-kerja', [
            'pagename' => "lokasi-kerja",
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

        LokasiKerja::create($validatedData);

        return redirect()->back()->with('success', 'Lokasi Kerja created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // find the lokasi kerja
        $data = LokasiKerja::findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // If the user is not an admin, create a pending action
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $data->id,
                'validated_data' => $validatedData,
                'type' => 'LokasiKerja',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $data->id, $updateData);

            return redirect()->back()->with('success', 'Lokasi Kerja update requested successfully');
        }

        $lokasiKerja = LokasiKerja::whereId($request->id)->first();
        $lokasiKerja->update($validatedData);

        return redirect()->back()->with('success', 'Lokasi Kerja updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // find the lokasi kerja
        $lokasiKerja = LokasiKerja::findOrFail($request->id);

        // If the user is not an admin, create a pending action
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $lokasiKerja->id,
                'name' => $lokasiKerja->name,
                'type' => 'LokasiKerja',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $lokasiKerja->id, $deleteData);

            return redirect()->back()->with('success', 'Lokasi Kerja delete requested successfully');
        }

        $lokasiKerja->delete();

        return redirect()->back()->with('success', 'Lokasi Kerja deleted successfully');
    }
}
