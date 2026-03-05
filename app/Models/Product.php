<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['naam', 'barcode'];

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class, 'product_per_allergen', 'product_id', 'allergen_id');
    }

    public function magazine()
    {
        return $this->hasOne(Magazine::class, 'product_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_per_supplier', 'product_id', 'supplier_id')
            ->withPivot('datum_levering', 'aantal', 'datum_eerst_volgende_levering')
            ->withTimestamps();
    }
}
