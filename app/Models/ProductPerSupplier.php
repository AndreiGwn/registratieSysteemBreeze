<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPerSupplier extends Model
{
    protected $table = 'product_per_supplier';
    protected $fillable = ['supplier_id', 'product_id', 'datum_levering', 'aantal', 'datum_eerst_volgende_levering'];
}
