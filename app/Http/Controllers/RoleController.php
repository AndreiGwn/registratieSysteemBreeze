<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of all users with their roles.
     */
    public function index()
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        $users = User::all();
        return view('roles.index', compact('users'));
    }

    /**
     * Display the specified user's details.
     */
    public function show(User $user)
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        return view('roles.show', compact('user'));
    }

    /**
     * Show the form for editing the user's role.
     */
    public function edit(User $user)
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        $roles = ['praktijkmanagement', 'leverancier'];
        return view('roles.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user's role.
     */
    public function update(Request $request, User $user)
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        $validated = $request->validate([
            'rolename' => 'required|string|in:praktijkmanagement,leverancier',
        ]);

        $user->update($validated);

        return redirect()->route('roles.index')->with('success', 'Rol succesvol gewijzigd.');
    }

    /**
     * Delete the specified user.
     */
    public function destroy(User $user)
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        // Don't allow deleting the current user
        if ($user->id === Auth::id()) {
            return redirect()->route('roles.index')->with('error', 'Je kunt je eigen account niet verwijderen.');
        }

        $user->delete();

        return redirect()->route('roles.index')->with('success', 'Gebruiker succesvol verwijderd.');
    }
}
