<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EselonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Eselon::all();
        return view('pages.eselon', [
            'pagename' => "eselon",
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

        Eselon::create($validatedData);

        return redirect()->back()->with('success', 'Eselon created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $eselon = Eselon::findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $eselon->id,
                'validated_data' => $validatedData,
                'type' => 'Eselon',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $eselon->id, $updateData);

            return redirect()->back()
                ->with('success', 'Update request has been sent for approval.');
        }

        $eselon->update($validatedData);

        return redirect()->back()->with('success', 'Eselon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $eselon = Eselon::findOrFail($request->id);
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $eselon->id,
                'name' => $eselon->name,
                'type' => 'Eselon',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $eselon->id, $deleteData);

            return redirect()->back()
                ->with('success', 'Delete request has been sent for approval.');
        }
        $eselon->delete();

        return redirect()->back()->with('success', 'Eselon deleted successfully');
    }
}
