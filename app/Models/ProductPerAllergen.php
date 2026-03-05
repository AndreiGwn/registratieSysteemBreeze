<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPerAllergen extends Model
{
    protected $table = 'product_per_allergen';
    protected $fillable = ['product_id', 'allergen_id'];
}
