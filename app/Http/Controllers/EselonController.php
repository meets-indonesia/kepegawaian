<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('message', 'Eselon created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eselon = Eselon::whereId($request->id)->firstOrFail();
        $eselon->update($validatedData);

        return redirect()->back()->with('message', 'Eselon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $eselon = Eselon::whereId($request->id)->firstOrFail();
        $eselon->delete();

        return redirect()->back()->with('message', 'Eselon deleted successfully');
    }
}
