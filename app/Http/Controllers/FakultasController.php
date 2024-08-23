<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Fakultas::all();
        return view('pages.fakultas', [
            'pagename' => "fakultas",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-fakultas', [
            'pagename' => "create-fakultas"
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

        // Create a new Fakultas record
        Fakultas::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('fakultas.index')
            ->with('success', 'Unit Kerja berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $Fakultas)
    {
        return view('pages.show-fakultas', [
            'pagename' => "show-fakultas",
            'Fakultas' => $Fakultas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $Fakultas)
    {
        return view('pages.edit-fakultas', [
            'pagename' => "edit-fakultas",
            'Fakultas' => $Fakultas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fakultas $Fakultas)
    {
        $Fakultas = Fakultas::findOrFail($request->id);
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Check if the user is a staff
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $Fakultas->id,
                'validated_data' => $validated,
                'type' => 'Fakultas',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $Fakultas->id, $updateData);

            return redirect()->route('fakultas.index')
                ->with('success', 'Unit Kerja update request submitted successfully.');
        }

        // Update the existing Fakultas record
        Fakultas::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('fakultas.index')
            ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Fakultas::findOrFail($request->id);

        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'type' => 'Fakultas',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $data->id, $deleteData);

            return redirect()->route('fakultas.index')
                ->with('success', 'Delete request has been sent for approval.');
        }

        // Delete the Fakultas record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('fakultas.index')
            ->with('success', 'Unit Kerja deleted successfully.');
    }
}
