<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

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
                         ->with('success', 'Unit Kerja berhasil ditambah');
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
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fakultas_id' => 'required'
        ]);

        // Update the existing Jurusan record
        Jurusan::where('id', $request->id)->update($validated);

        // Redirect to the index page with a success message
        return redirect()->route('jurusan.index')
                         ->with('success', 'Unit Kerja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Jurusan::find($request->id);
        // Delete the Jurusan record
        $data->delete();

        // Redirect to the index page with a success message
        return redirect()->route('jurusan.index')
                         ->with('success', 'Unit Kerja deleted successfully.');
    }
}
