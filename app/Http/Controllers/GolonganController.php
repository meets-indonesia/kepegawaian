<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Golongan::all();
        return view('pages.golongan', [
            'pagename' => "golongan",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create-golongan', [
            'pagename' => "create-golongan"
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
            'golongan' => 'required',
        ]);

        // Create a new Golongan record
        Golongan::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('golongan.index')
            ->with('success', 'Golongan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Golongan $Golongan)
    {
        return view('pages.show-golongan', [
            'pagename' => "show-golongan",
            'Golongan' => $Golongan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Golongan $Golongan)
    {
        return view('pages.edit-golongan', [
            'pagename' => "edit-golongan",
            'Golongan' => $Golongan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Golongan $Golongan)
    {
        // find the existing Golongan record
        $golongan = Golongan::findOrFail($request->id);

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'golongan' => 'required',
        ]);

        // Check if the user is an admin
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $golongan->id,
                'validated_data' => $validated,
                'type' => 'Golongan',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $Golongan->id, $updateData);

            return redirect()->back()
                ->with('success', 'Update request has been sent for approval.');
        }

        // Update the existing Golongan record
        Golongan::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('golongan.index')
            ->with('success', 'Golongan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Golongan::findOrFail($request->id);

        // Check if the user is an admin
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'golongan' => $data->golongan,
                'type' => 'Golongan',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $data->id, $deleteData);

            return redirect()->route('golongan.index')
                ->with('success', 'Delete request has been sent for approval.');
        }

        // Delete the Golongan record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('golongan.index')
            ->with('success', 'Golongan deleted successfully.');
    }
}
