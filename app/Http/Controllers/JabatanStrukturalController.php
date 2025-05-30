<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\JabatanStruktural;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanStrukturalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JabatanStruktural::with(['eselon', 'parent', 'children'])->get();
        $eselon = Eselon::all();
        $jabatans = JabatanStruktural::whereNull('parent_id')->with('children')->get();

        return view('pages.jabatan-struktural', [
            'pagename' => "jabatan-struktural",
            'data' => $data,
            'eselon' => $eselon,
            'jabatans' => $jabatans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'masa' => 'required|numeric',
            'eselon_id' => 'required|exists:eselon,id',
            'parent_id' => 'nullable|exists:jabatan_struktural,id'
        ]);

        // Create a new JabatanStruktural record
        JabatanStruktural::create($validatedData);

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Find the JabatanStruktural record
        $jabatanStruktural = JabatanStruktural::findOrFail($request->id);

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'masa' => 'required|numeric',
            'eselon_id' => 'required|exists:eselon,id',
            'parent_id' => 'nullable|exists:jabatan_struktural,id'
        ]);

        // Prevent circular reference
        if ($validatedData['parent_id'] == $jabatanStruktural->id) {
            return redirect()->back()->with('error', 'Tidak bisa memilih jabatan ini sebagai atasan.');
        }

        // Check if the new parent is a descendant
        if ($validatedData['parent_id']) {
            $descendants = $jabatanStruktural->descendants()->pluck('id')->toArray();
            if (in_array($validatedData['parent_id'], $descendants)) {
                return redirect()->back()->with('error', 'Tidak bisa memilih jabatan bawahan sebagai atasan.');
            }
        }

        // If the user is not an admin, save the update request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $jabatanStruktural->id,
                'validated_data' => $validatedData,
                'type' => 'JabatanStruktural',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $jabatanStruktural->id, $updateData);

            return redirect()->back()->with('success', 'Permintaan update Jabatan Struktural berhasil diajukan.');
        }

        // Update the JabatanStruktural record
        $jabatanStruktural->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the JabatanStruktural record
        $jabatanStruktural = JabatanStruktural::findOrFail($request->id);

        // Check if this jabatan has children
        if ($jabatanStruktural->children()->count() > 0) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus jabatan yang memiliki bawahan.');
        }

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $jabatanStruktural->id,
                'name' => $jabatanStruktural->name,
                'masa' => $jabatanStruktural->masa,
                'eselon_id' => $jabatanStruktural->eselon_id,
                'parent_id' => $jabatanStruktural->parent_id,
                'type' => 'JabatanStruktural',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $jabatanStruktural->id, $deleteData);

            return redirect()->back()->with('success', 'Permintaan hapus Jabatan Struktural berhasil diajukan.');
        }

        // Delete the JabatanStruktural record
        $jabatanStruktural->delete();

        // Redirect back with a success message
        return redirect()->route('jabatan-struktural.index')->with('success', 'Jabatan Struktural deleted successfully.');
    }

    /**
     * Get jabatan struktural data for select options
     */
    public function getJabatanOptions(Request $request)
    {
        $query = JabatanStruktural::query();

        if ($request->has('exclude')) {
            $query->where('id', '!=', $request->exclude);
        }

        $jabatans = $query->get(['id', 'name as text']);

        return response()->json($jabatans);
    }
}
