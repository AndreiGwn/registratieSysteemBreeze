<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leverancier extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'Leverancier';

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
        'Naam',
        'ContactPersoon',
        'LeverancierNummer',
        'Mobiel',
        'ContactId',
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
     * Get the contact associated with the leverancier.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'ContactId', 'Id');
    }

    /**
     * Get the products for the leverancier.
     */
    public function producten()
    {
        return $this->belongsToMany(Product::class, 'ProductPerLeverancier', 'LeverancierId', 'ProductId')
            ->withPivot('DatumLevering', 'Aantal', 'DatumEerstVolgendeLevering');
    }
}
