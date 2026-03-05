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
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_DeleteUser;
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_DeleteUser(
                IN p_id INT
            )
            BEGIN
                DELETE FROM users
                WHERE Id = p_id;
                
                SELECT ROW_COUNT() AS affected;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_DeleteUser");
    }
};
