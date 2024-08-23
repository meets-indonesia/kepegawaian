<?php

namespace App\Http\Controllers;

use App\Models\PendingAction;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UnitKerja::all();
        return view('pages.unit-kerja', [
            'pagename' => "unit-kerja",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-unit-kerja', [
            'pagename' => "create-unit-kerja"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new UnitKerja record
        UnitKerja::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitKerja $unitKerja)
    {
        return view('pages.show-unit-kerja', [
            'pagename' => "show-unit-kerja",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitKerja $unitKerja)
    {
        return view('pages.edit-unit-kerja', [
            'pagename' => "edit-unit-kerja",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $unitKerja = UnitKerja::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $unitKerja->id,
                'validated_data' => $validated,
                'type' => 'UnitKerja',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $unitKerja->id, $updateData);

            return redirect()->route('unit-kerja.index')
                ->with('success', 'Update request has been sent for approval.');
        }

        $unitKerja->update($validated);

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = UnitKerja::findOrFail($request->id);

        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'type' => 'UnitKerja',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];


            PendingAction::savePendingAction('delete', $data->id, $deleteData);

            return redirect()->route('unit-kerja.index')
                ->with('success', 'Delete request has been sent for approval.');
        }

        $data->delete();

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja deleted successfully.');
    }
}
