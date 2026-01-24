<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'Product';

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
        'Barcode',
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
     * Get the leveranciers for the product.
     */
    public function leveranciers()
    {
        return $this->belongsToMany(Leverancier::class, 'ProductPerLeverancier', 'ProductId', 'LeverancierId')
            ->withPivot('DatumLevering', 'Aantal', 'DatumEerstVolgendeLevering');
    }

    /**
     * Get the allergenen for the product.
     */
    public function allergenen()
    {
        return $this->belongsToMany(Allergeen::class, 'ProductPerAllergeen', 'ProductId', 'AllergeenId');
    }

    /**
     * Get the magazijn record for the product.
     */
    public function magazijn()
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'Id');
    }
}
