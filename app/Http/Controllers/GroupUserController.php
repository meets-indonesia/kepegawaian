<?php

namespace App\Http\Controllers;

use App\Models\Role; // Import the Role model
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::all();
        return view('pages.group-user', [
            'pagename' => "roles",
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|integer',
        ]);

        Role::create($validatedData);

        return redirect()->back()->with('success', 'Role created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'level' => 'sometimes|integer',
        ]);

        $role = Role::whereId($request->id)->firstOrFail();
        $role->update($validatedData);

        return redirect()->back()->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $role = Role::whereId($request->id)->firstOrFail();
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully');
    }
}
