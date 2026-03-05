<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Allergen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllergenController extends Controller
{
    /**
     * Display a listing of products with allergens.
     */
    public function index(Request $request)
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        $query = Product::with(['allergens', 'magazine'])->whereHas('allergens')->orderBy('naam', 'ASC');

        // Filter by allergen if selected
        if ($request->has('allergen_id') && $request->allergen_id) {
            $query->whereHas('allergens', function ($q) use ($request) {
                $q->where('allergens.id', $request->allergen_id);
            });
        }

        $products = $query->paginate(10);
        $allergens = Allergen::all();
        $selectedAllergen = $request->allergen_id;

        return view('allergens.index', compact('products', 'allergens', 'selectedAllergen'));
    }

    /**
     * Display supplier information for a product.
     */
    public function supplier(Product $product)
    {
        // Only managers can access this
        if (Auth::user()->rolename !== 'praktijkmanagement') {
            abort(403, 'Insufficient permissions.');
        }

        $suppliers = $product->suppliers()->paginate(10);

        return view('allergens.supplier', compact('product', 'suppliers'));
    }
}
