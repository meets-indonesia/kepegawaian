<?php

namespace App\Http\Controllers;

use App\Models\KelompokPegawai;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelompokPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KelompokPegawai::all();
        return view('pages.kelompok-pegawai', [
            'pagename' => "kelompok-pegawai",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-kelompok-pegawai', [
            'pagename' => "create-kelompok-pegawai"
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

        // Create a new KelompokPegawai record
        KelompokPegawai::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('kelompok-pegawai.index')
            ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelompokPegawai $unitKerja)
    {
        return view('pages.show-kelompok-pegawai', [
            'pagename' => "show-kelompok-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelompokPegawai $unitKerja)
    {
        return view('pages.edit-kelompok-pegawai', [
            'pagename' => "edit-kelompok-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelompokPegawai $unitKerja)
    {
        // Find the existing KelompokPegawai record
        $data = KelompokPegawai::findorFail($unitKerja->id);

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $validatedData = [
                'id' => $data->id,
                'validated_data'  => $validated,
                'type' => 'KelompokPegawai',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $data->id, $validatedData);
            return redirect()->route('kelompok-pegawai.index')
                ->with('success', 'Kelompok Pegawai Update request submitted successfully.');
        }

        // Update the existing KelompokPegawai record
        KelompokPegawai::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('kelompok-pegawai.index')
            ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the KelompokPegawai record
        $data = KelompokPegawai::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'type' => 'KelompokPegawai',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $data->id, $deleteData);
            return redirect()->route('kelompok-pegawai.index')
                ->with('success', 'Kelompok Pegawai delete request submitted successfully.');
        }

        // Delete the KelompokPegawai record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('kelompok-pegawai.index')
            ->with('success', 'Unit Kerja deleted successfully.');
    }
}
