<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazijn extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'Magazijn';

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
        'ProductId',
        'VerpakkingsEenheid',
        'AantalAanwezig',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'VerpakkingsEenheid' => 'decimal:1',
        'AantalAanwezig' => 'integer',
        'IsActief' => 'boolean',
        'DatumAangemaakt' => 'datetime',
        'DatumGewijzigd' => 'datetime',
    ];

    /**
     * Get the product associated with this magazijn entry.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }
}
