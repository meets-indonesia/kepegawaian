<?php

namespace App\Http\Controllers;

use App\Models\JenisPegawai;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisPegawai::all();
        return view('pages.jenis-pegawai', [
            'pagename' => "jenis-pegawai",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-jenis-pegawai', [
            'pagename' => "create-jenis-pegawai"
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

        // Create a new JenisPegawai record
        JenisPegawai::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jenis-pegawai.index')
            ->with('success', 'Jenis Pegawai berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPegawai $unitKerja)
    {
        return view('pages.show-jenis-pegawai', [
            'pagename' => "show-jenis-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPegawai $unitKerja)
    {
        return view('pages.edit-jenis-pegawai', [
            'pagename' => "edit-jenis-pegawai",
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPegawai $unitKerja)
    {
        // find the existing JenisPegawai record
        $data = JenisPegawai::findOrFail($request->id);

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $data->id,
                'validated_data' => $validated,
                'type' => 'JenisPegawai',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $data->id, $updateData);
            return redirect()->route('jenis-pegawai.index')
                ->with('success', 'Jenis Pegawai delete request submitted successfully.');
        }

        // Update the existing JenisPegawai record
        JenisPegawai::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jenis-pegawai.index')
            ->with('success', 'Jenis Pegawai updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the JenisPegawai record
        $data = JenisPegawai::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'type' => 'JenisPegawai',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $data->id, $deleteData);
            return redirect()->route('jenis-pegawai.index')
                ->with('success', 'Jenis Pegawai delete request submitted successfully.');
        }

        // Delete the JenisPegawai record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('jenis-pegawai.index')
            ->with('success', 'Jenis Pegawai deleted successfully.');
    }
}
