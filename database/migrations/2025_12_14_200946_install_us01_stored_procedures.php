<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // sp GetLeveranciersWithProductCount
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetLeveranciersWithProductCount');
        DB::unprepared('CREATE PROCEDURE spGetLeveranciersWithProductCount()
        BEGIN
            SELECT 
                l.id,
                l.Naam,
                l.ContactPersoon,
                l.LeverancierNummer,
                l.Mobiel,
                COUNT(DISTINCT ppl.ProductId) AS AantalProducten
            FROM leveranciers l
            LEFT JOIN product_per_leveranciers ppl ON l.id = ppl.LeverancierId
            WHERE l.IsActief = TRUE
            GROUP BY l.id, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel
            ORDER BY l.Naam;
        END');

        // spGetProductenByLeverancier
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetProductenByLeverancier');
        DB::unprepared('CREATE PROCEDURE spGetProductenByLeverancier(IN leverancierId INT)
        BEGIN
            SELECT DISTINCT
                p.id,
                p.Naam,
                p.Barcode,
                p.IsActief
            FROM products p
            INNER JOIN product_per_leveranciers ppl ON p.id = ppl.ProductId
            WHERE ppl.LeverancierId = leverancierId
            ORDER BY p.Naam;
        END');

        // spGetAllergenenByProduct
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllergenenByProduct');
        DB::unprepared('CREATE PROCEDURE spGetAllergenenByProduct(IN productId INT)
        BEGIN
            SELECT 
                a.id,
                a.Naam,
                a.Omschrijving
            FROM allergenen a
            INNER JOIN product_per_allergenen ppa ON a.id = ppa.AllergeenId
            WHERE ppa.ProductId = productId AND a.IsActief = TRUE
            ORDER BY a.Naam;
        END');

        // spGetLeverancierById
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetLeverancierById');
        DB::unprepared('CREATE PROCEDURE spGetLeverancierById(IN leverancierId INT)
        BEGIN
            SELECT 
                id,
                Naam,
                ContactPersoon,
                LeverancierNummer,
                Mobiel
            FROM leveranciers
            WHERE id = leverancierId AND IsActief = TRUE;
        END');

        // spGetProductById
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetProductById');
        DB::unprepared('CREATE PROCEDURE spGetProductById(IN productId INT)
        BEGIN
            SELECT 
                id,
                Naam,
                Barcode,
                IsActief
            FROM products
            WHERE id = productId;
        END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetLeveranciersWithProductCount');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetProductenByLeverancier');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllergenenByProduct');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetLeverancierById');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetProductById');
    }
};
