<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $table = 'magazine';
    protected $fillable = ['product_id', 'verpakkings_eenheid', 'aantal_aanwezig'];
}
