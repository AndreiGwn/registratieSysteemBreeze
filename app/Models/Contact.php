<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['straat', 'huisnummer', 'postcode', 'stad'];

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'contact_id');
    }
}

