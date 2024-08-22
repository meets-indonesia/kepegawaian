<?php

namespace App\Http\Controllers;

use App\Models\HukumanDisiplin;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('message', 'Hukuman Disiplin created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hukumanDisiplin = HukumanDisiplin::findOrFail($id);
        $hukumanDisiplin->update($validatedData);

        return redirect()->back()->with('message', 'Hukuman Disiplin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hukumanDisiplin = HukumanDisiplin::findOrFail($id);
        $hukumanDisiplin->delete();

        return redirect()->back()->with('message', 'Hukuman Disiplin deleted successfully');
    }
}
