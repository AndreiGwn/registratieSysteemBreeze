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
        // sp_GetAllUsers
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_GetAllUsers;
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_GetAllUsers(
                IN user_Id INT
            )
            BEGIN
                SELECT 
                    id,
                    name,
                    email,
                    rolename,
                    created_at,
                    updated_at
                FROM 
                    users
                ORDER BY 
                    id ASC;
            END
        ");

        // Sp_GetUserById
        DB::unprepared("
            DROP PROCEDURE IF EXISTS Sp_GetUserById;
        ");

        DB::unprepared("
            CREATE PROCEDURE Sp_GetUserById(
                IN user_Id INT
            )
            BEGIN
                SELECT 
                    id,
                    name,
                    email,
                    email_verified_at,
                    rolename,
                    created_at,
                    updated_at
                FROM 
                    users
                WHERE 
                    id = user_Id;
            END
        ");

        // Sp_GetAllUserroles
        DB::unprepared("
            DROP PROCEDURE IF EXISTS Sp_GetAllUserroles;
        ");

        DB::unprepared("
            CREATE PROCEDURE Sp_GetAllUserroles()
            BEGIN
                SELECT DISTINCT
                    rolename
                FROM 
                    users
                ORDER BY 
                    rolename ASC;
            END
        ");

        // Sp_UpdateUser
        DB::unprepared("
            DROP PROCEDURE IF EXISTS Sp_UpdateUser;
        ");

        DB::unprepared("
            CREATE PROCEDURE Sp_UpdateUser(
                IN p_id INT,
                IN p_name VARCHAR(255),
                IN p_email VARCHAR(255),
                IN p_rolename VARCHAR(255)
            )
            BEGIN
                UPDATE users
                SET 
                    name = p_name,
                    email = p_email,
                    rolename = p_rolename,
                    updated_at = NOW()
                WHERE 
                    id = p_id;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetAllUsers");
        DB::unprepared("DROP PROCEDURE IF EXISTS Sp_GetUserById");
        DB::unprepared("DROP PROCEDURE IF EXISTS Sp_GetAllUserroles");
        DB::unprepared("DROP PROCEDURE IF EXISTS Sp_UpdateUser");
    }
};
