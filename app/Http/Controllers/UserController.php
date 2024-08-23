<?php

namespace App\Http\Controllers;

use App\Models\PendingAction;
use App\Models\User;
use App\Models\Role; // Add this line to import the Role class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // find the user
        $user = User::findOrFail($request->id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:users,id',
            'username' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'sometimes|string',
            'role_id' => 'sometimes|integer|exists:role,id',
        ]);

        // If the user is not an admin, save the update request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $user->id,
                'validated_data' => $validatedData,
                'type' => 'UnitKerja',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $user->id, $updateData);

            return redirect()->back()
                ->with('success', 'Update request has been sent for approval.');
        }

        $user = User::whereId($request->id)->firstOrFail();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the user
        $user = User::findOrFail($request->id);

        $validatedData = $request->validate([
            'id' => 'required|integer|exists:users,id',
        ]);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'type' => 'User',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $user->id, $deleteData);

            return redirect()->back()->with('success', 'Delete request has been sent for approval.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
