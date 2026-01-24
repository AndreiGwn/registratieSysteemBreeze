<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergeen extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'Allergeen';

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
        'Omschrijving',
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
     * Get the products that contain this allergeen.
     */
    public function producten()
    {
        return $this->belongsToMany(Product::class, 'ProductPerAllergeen', 'AllergeenId', 'ProductId');
    }
}
