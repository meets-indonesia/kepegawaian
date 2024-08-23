<?php

namespace App\Http\Controllers;

use App\Models\HukumanDisiplin;
use App\Models\PendingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HukumanDisiplinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HukumanDisiplin::all();
        return view('pages.hukuman-disiplin', [
            'pagename' => "hukuman-disiplin",
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

        HukumanDisiplin::create($validatedData);

        return redirect()->back()->with('success', 'Hukuman Disiplin created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // find the hukuman disiplin
        $hukumanDisiplin = HukumanDisiplin::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $hukumanDisiplin->id,
                'validated_data' => $validatedData,
                'type' => 'Hukuman Disiplin',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $hukumanDisiplin->id, $updateData);

            return redirect()->back()->with('success', 'Hukuman Disiplin update requested successfully');
        }

        $hukumanDisiplin = HukumanDisiplin::findOrFail($id);
        $hukumanDisiplin->update($validatedData);

        return redirect()->back()->with('success', 'Hukuman Disiplin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // find the hukuman disiplin
        $hukumanDisiplin = HukumanDisiplin::findOrFail($id);

        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $hukumanDisiplin->id,
                'name' => $hukumanDisiplin->name,
                'type' => 'Hukuman Disiplin',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $hukumanDisiplin->id, $deleteData);

            return redirect()->back()->with('success', 'Hukuman Disiplin delete requested successfully');
        }

        $hukumanDisiplin->delete();

        return redirect()->back()->with('success', 'Hukuman Disiplin deleted successfully');
    }
}
