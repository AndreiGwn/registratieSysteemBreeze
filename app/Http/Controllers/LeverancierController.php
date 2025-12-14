<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeverancierController extends Controller
{
    /**
     * US01 Scenario 01: Display supplier overview (Wireframe-01)
     * Shows all suppliers with their product count
     */
    public function index()
    {
        // MANDATORY: Use PDO via stored procedure (not Eloquent)
        $leveranciers = DB::select('CALL spGetLeveranciersWithProductCount()');
        
        return view('leveranciers.index', compact('leveranciers'));
    }

    /**
     * US01 Scenario 01 & 02: Display products per supplier (Wireframe-02/03)
     * - Scenario 01: Show products if supplier has products
     * - Scenario 02: Show "no products" message if supplier has no products
     */
    public function show($id)
    {
        // MANDATORY: Use PDO via stored procedures (not Eloquent)
        $leverancierData = DB::select('CALL spGetLeverancierById(?)', [$id]);
        
        if (empty($leverancierData)) {
            abort(404, 'Leverancier niet gevonden');
        }
        
        $leverancier = $leverancierData[0];
        $products = DB::select('CALL spGetProductenByLeverancier(?)', [$id]);
        
        // For each product, get allergens
        foreach ($products as $product) {
            $product->allergenen = DB::select('CALL spGetAllergenenByProduct(?)', [$product->id]);
        }
        
        return view('leveranciers.show', compact('leverancier', 'products'));
    }
}

