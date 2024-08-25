<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jurusan::with(['fakultas'])->get();
        $fakultas = Fakultas::all();
        return view('pages.jurusan', [
            'pagename' => "jurusan",
            'data' => $data,
            'fakultas' => $fakultas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-jurusan', [
            'pagename' => "create-jurusan"
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
            'fakultas_id' => 'required'
        ]);

        // Create a new Jurusan record
        Jurusan::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $Jurusan)
    {
        return view('pages.show-jurusan', [
            'pagename' => "show-jurusan",
            'Jurusan' => $Jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $Jurusan)
    {
        return view('pages.edit-jurusan', [
            'pagename' => "edit-jurusan",
            'Jurusan' => $Jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $Jurusan)
    {
        // Find the existing Jurusan record
        $data = Jurusan::findOrFail($request->id);

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fakultas_id' => 'required'
        ]);

        // If the user is not an admin, save the update request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $validatedData = [
                'id' => $data->id,
                'validated_data'  => $validated,
                'type' => 'Jurusan',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $data->id, $validatedData);
            return redirect()->route('jurusan.index')
                ->with('success', 'Jurusan Update request submitted successfully.');
        }

        // Update the existing Jurusan record
        Jurusan::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the Jurusan record
        $data = Jurusan::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'fakultas_id' => $data->fakultas_id,
                'type' => 'Jurusan',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $data->id, $deleteData);
            return redirect()->route('jurusan.index')
                ->with('success', 'Jurusan delete request submitted successfully.');
        }

        // Delete the Jurusan record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('jurusan.index')
            ->with('success', 'Unit Kerja deleted successfully.');
    }
}
