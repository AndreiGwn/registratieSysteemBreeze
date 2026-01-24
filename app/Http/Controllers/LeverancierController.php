<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LeverancierController extends Controller
{
    /**
     * Display a listing of leveranciers with pagination
     * Wireframe-02: Overzicht Leveranciers
     */
    public function index(Request $request)
    {
        try {
            $perPage = 4; // Max 4 records per page as per requirements
            $page = $request->get('page', 1);
            $offset = ($page - 1) * $perPage;

            // Get paginated leveranciers using stored procedure
            $leveranciers = DB::select('CALL spGetAllLeveranciers(?, ?)', [$perPage, $offset]);
            
            // Get total count for pagination
            $totalResult = DB::select('CALL spCountLeveranciers()');
            $total = $totalResult[0]->total;
            
            // Calculate pagination data
            $lastPage = ceil($total / $perPage);
            
            $pagination = [
                'current_page' => $page,
                'last_page' => $lastPage,
                'per_page' => $perPage,
                'total' => $total,
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total),
                'has_more_pages' => $page < $lastPage,
                'prev_page' => $page > 1 ? $page - 1 : null,
                'next_page' => $page < $lastPage ? $page + 1 : null,
            ];

            return view('Manager.leveranciers.index', compact('leveranciers', 'pagination'));
        } catch (\Exception $e) {
            Log::error('Error fetching leveranciers: ' . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het ophalen van de leveranciers.');
        }
    }

    /**
     * Display the specified leverancier
     * Wireframe-03: Leverancier Details
     */
    public function show($id)
    {
        try {
            $leverancier = DB::select('CALL spGetLeverancierById(?)', [$id]);
            
            if (empty($leverancier)) {
                return redirect()->route('leveranciers.index')
                    ->with('error', 'Leverancier niet gevonden.');
            }

            $leverancier = $leverancier[0];
            
            // Get products for this leverancier
            $producten = DB::select('CALL spGetProductsByLeverancier(?)', [$id]);

            return view('Manager.leveranciers.show', compact('leverancier', 'producten'));
        } catch (\Exception $e) {
            Log::error('Error fetching leverancier details: ' . $e->getMessage());
            return redirect()->route('leveranciers.index')
                ->with('error', 'Er is een fout opgetreden bij het ophalen van de leverancier details.');
        }
    }

    /**
     * Show the form for editing the specified leverancier
     * Wireframe-04: Wijzig Leveranciergegevens
     */
    public function edit($id)
    {
        try {
            $leverancier = DB::select('CALL spGetLeverancierById(?)', [$id]);
            
            if (empty($leverancier)) {
                return redirect()->route('leveranciers.index')
                    ->with('error', 'Leverancier niet gevonden.');
            }

            $leverancier = $leverancier[0];

            return view('Manager.leveranciers.edit', compact('leverancier'));
        } catch (\Exception $e) {
            Log::error('Error loading edit form: ' . $e->getMessage());
            return redirect()->route('leveranciers.index')
                ->with('error', 'Er is een fout opgetreden bij het laden van het wijzigformulier.');
        }
    }

    /**
     * Update the specified leverancier in storage
     * Handles both Scenario 1 (success) and Scenario 2 (failure)
     */
    public function update(Request $request, $id)
    {
        // Validate input with custom messages
        $validated = $request->validate([
            'naam' => 'required|string|max:100',
            'contactpersoon' => 'required|string|max:100',
            'leveranciernummer' => 'required|string|max:50',
            'mobiel' => 'required|string|max:20|regex:/^06-[0-9]{8}$/',
            'straat' => 'required|string|max:100',
            'huisnummer' => 'required|string|max:10',
            'postcode' => 'required|string|max:10',
            'stad' => 'required|string|max:100',
        ], [
            'mobiel.regex' => 'Het mobiele nummer moet het formaat 06-12345678 hebben.',
            'naam.required' => 'Naam is verplicht.',
            'contactpersoon.required' => 'Contactpersoon is verplicht.',
        ]);

        try {
            // Call stored procedure with OUT parameter
            DB::statement('CALL spUpdateLeverancier(?, ?, ?, ?, ?, ?, ?, ?, ?, @result)', [
                $id,
                $validated['naam'],
                $validated['contactpersoon'],
                $validated['leveranciernummer'],
                $validated['mobiel'],
                $validated['straat'],
                $validated['huisnummer'],
                $validated['postcode'],
                $validated['stad']
            ]);

            // Get the result
            $result = DB::select('SELECT @result as result')[0]->result;

            if ($result == 1) {
                // Scenario 1: Success (Astra Sweets and others except De Bron)
                return redirect()->route('leveranciers.show', $id)
                    ->with('success', 'De wijzigingen zijn doorgevoerd');
            } else {
                // Scenario 2: Failure (De Bron - Id = 5)
                return redirect()->route('leveranciers.show', $id)
                    ->with('error', 'Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens');
            }
        } catch (\Exception $e) {
            Log::error('Error updating leverancier: ' . $e->getMessage());
            return redirect()->route('leveranciers.show', $id)
                ->with('error', 'Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens');
        }
    }
}
