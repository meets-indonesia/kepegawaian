<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
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

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Check if the user has role_id 2
        if (Auth::user()->role_id == 2) {
            // Store the update request in Redis with a unique key
            $updateData = [
                'id' => $unitKerja->id,
                'validated_data' => $validated,
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            $key = "pending_update:unit_kerja:{$unitKerja->id}";
            Redis::set($key, json_encode($updateData));

            return redirect()->route('unit-kerja.index')
                ->with('success', 'Update request has been sent for approval.');
        }

        // If not role_id 2, update the existing UnitKerja record
        $unitKerja->update($validated);

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = UnitKerja::find($request->id);
        // Delete the UnitKerja record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja deleted successfully.');
    }



    /**
     * Display a listing of the pending updates.
     */
    public function pendingUpdates()
    {
        // Check if the user has role_id 1
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('error', 'You do not have permission to view pending updates.');
        }

        $keys = Redis::keys('laravel_database_pending_update:unit_kerja:*');
        $updates = [];
        foreach ($keys as $key) {
            $updates[] = json_decode(Redis::get($key), true);
        }
        return view('admin.pending-updates', ['updates' => $updates]);
    }

    /**
     * Approve a pending update.
     */
    public function verifyUpdate(Request $request, $id)
    {
        // Check if the user has role_id 1
        if (Auth::user()->role_id != 1) {
            return redirect()->route('home')->with('error', 'You do not have permission to verify updates.');
        }

        $key = "laravel_database_pending_update:unit_kerja:{$id}";
        $updateData = json_decode(Redis::get($key), true);

        if (!$updateData) {
            return redirect()->route('admin.pending-updates')->with('error', 'Update request not found.');
        }

        // Update the database
        $unitKerja = UnitKerja::findOrFail($updateData['id']);
        $unitKerja->update($updateData['validated_data']);

        // Remove the key from Redis
        Redis::del($key);

        return redirect()->route('admin.pending-updates')->with('success', 'Update verified and applied successfully.');
    }
}
