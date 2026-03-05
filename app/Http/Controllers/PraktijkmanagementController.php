<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PraktijkmanagementController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Praktijkmanagement.index', [
            'title' => 'Praktijkmanagement Home'
        ]);
    }

    public function userroles()
    {
        // Haalt alle gebruikers op
        $users = $this->userModel->sp_GetAllUsers(auth()->user()->id);
        
        // Haalt alle gebruikersrollen op voor de select
        $userroles = $this->userModel->sp_GetAllUserroles();

        return view('Praktijkmanagement.userroles', [
            'title' => 'Gebruikersrollen',
            'users' => $users,
            'userroles' => $userroles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Haalt de gebruiker op
        $user = $this->userModel->sp_GetUserById($id);

        return view('Praktijkmanagement.show', [
            'title' => 'Gebruiker Details',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Haalt de gebruiker op die een wijziging krijgt.
        $user = $this->userModel->sp_GetUserById($id);
        
        // Haalt alle gebruikersrollen op voor de select
        $userroles = $this->userModel->sp_GetAllUserroles();

        return view('Praktijkmanagement.edit', [
            'title' => 'Wijzig de gebruikersrol',
            'user' => $user,
            'userroles' => $userroles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userModel = new User();
        $userModel->sp_UpdateUser(
            $id,
            $request->input('name'),
            $request->input('email'),
            $request->input('rolename')
        );

        return redirect()->route('praktijkmanagement.userroles')
            ->with('success', 'Gebruikersgegevens succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {
        $result = $this->userModel->sp_DeleteUser($userId);

        if ($result > 0) {
            return redirect()->route('praktijkmanagement.userroles')
                ->with('success', 'User is succesvol verwijdert');
        }

        return redirect()->route('praktijkmanagement.userroles')
            ->with('error', 'User is niet verwijdert');
    }
}
