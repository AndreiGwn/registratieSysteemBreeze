<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $fillable = ['naam', 'omschrijving'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_per_allergen', 'allergen_id', 'product_id');
    }
}
