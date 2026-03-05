<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['naam', 'contact_persoon', 'leverancier_nummer', 'mobiel', 'contact_id'];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_per_supplier', 'supplier_id', 'product_id')
            ->withPivot('datum_levering', 'aantal', 'datum_eerst_volgende_levering')
            ->withTimestamps();
    }
}
