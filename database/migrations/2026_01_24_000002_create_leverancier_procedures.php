<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Read and execute the stored procedures SQL file
        $sqlFile = database_path('stored-procedures/leverancier_procedures.sql');
        $sql = file_get_contents($sqlFile);
        
        DB::unprepared($sql);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllLeveranciers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spCountLeveranciers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetLeverancierById');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateLeverancier');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetProductsByLeverancier');
    }
};
