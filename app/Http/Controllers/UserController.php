<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Add this line to import the Role class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with(['role'])->get();
        $roles = Role::all();
        return view('pages.user', [
            'pagename' => "user",
            'data' => $data,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'role_id' => 'required|integer',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->back()->with('message', 'User created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:users,id',
            'username' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'sometimes|string',
            'role_id' => 'sometimes|integer|exists:role,id',
        ]);

        $user = User::whereId($request->id)->firstOrFail();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->back()->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:users,id',
        ]);

        $user = User::whereId($validatedData['id'])->firstOrFail();
        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully');
    }
}
