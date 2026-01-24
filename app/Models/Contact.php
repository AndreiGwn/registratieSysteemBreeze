<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'Contact';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'Id';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'Straat',
        'Huisnummer',
        'Postcode',
        'Stad',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'IsActief' => 'boolean',
        'DatumAangemaakt' => 'datetime',
        'DatumGewijzigd' => 'datetime',
    ];

    /**
     * Get the leverancier associated with this contact.
     */
    public function leverancier()
    {
        return $this->hasOne(Leverancier::class, 'ContactId', 'Id');
    }
}
