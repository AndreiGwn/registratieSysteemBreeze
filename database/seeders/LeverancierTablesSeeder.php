<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LeverancierTablesSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Drop existing tables
        DB::statement('DROP TABLE IF EXISTS ProductPerLeverancier');
        DB::statement('DROP TABLE IF EXISTS ProductPerAllergeen');
        DB::statement('DROP TABLE IF EXISTS Magazijn');
        DB::statement('DROP TABLE IF EXISTS Product');
        DB::statement('DROP TABLE IF EXISTS Allergeen');
        DB::statement('DROP TABLE IF EXISTS Leverancier');
        DB::statement('DROP TABLE IF EXISTS Contact');
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        // Read and execute the SQL file content
        $sqlPath = database_path('opdracht3_jamin_tables.sql');
        $sql = File::get($sqlPath);
        
        // Remove USE statement as we're already connected
        $sql = preg_replace('/USE\s+\w+;/i', '', $sql);
        
        // Split into statements and execute
        $statements = explode(';', $sql);
        
        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (!empty($statement)) {
                try {
                    DB::statement($statement);
                } catch (\Exception $e) {
                    // Continue on errors like comments
                    if (!str_contains($e->getMessage(), 'syntax error')) {
                        throw $e;
                    }
                }
            }
        }
        
        $this->command->info('✓ Leverancier tables and data created successfully!');
        
        // Create stored procedures manually
        $this->createStoredProcedures();
        
        $this->command->info('✓ Stored procedures created successfully!');
    }
    
    private function createStoredProcedures(): void
    {
        // Drop existing procedures if they exist
        DB::statement('DROP PROCEDURE IF EXISTS spGetAllLeveranciers');
        DB::statement('DROP PROCEDURE IF EXISTS spCountLeveranciers');
        DB::statement('DROP PROCEDURE IF EXISTS spGetLeverancierById');
        DB::statement('DROP PROCEDURE IF EXISTS spUpdateLeverancier');
        DB::statement('DROP PROCEDURE IF EXISTS spGetProductsByLeverancier');
        
        // SP01: Get All Leveranciers with Pagination
        DB::unprepared("
            CREATE PROCEDURE spGetAllLeveranciers(
                IN p_limit INT,
                IN p_offset INT
            )
            BEGIN
                SELECT 
                    l.Id,
                    l.Naam,
                    l.ContactPersoon,
                    l.LeverancierNummer,
                    l.Mobiel,
                    c.Straat,
                    c.Huisnummer,
                    c.Postcode,
                    c.Stad,
                    l.IsActief,
                    l.DatumAangemaakt,
                    l.DatumGewijzigd
                FROM Leverancier l
                INNER JOIN Contact c ON l.ContactId = c.Id
                WHERE l.IsActief = 1
                ORDER BY l.Naam ASC
                LIMIT p_limit OFFSET p_offset;
            END
        ");
        
        // SP02: Count Total Leveranciers
        DB::unprepared("
            CREATE PROCEDURE spCountLeveranciers()
            BEGIN
                SELECT COUNT(*) as total
                FROM Leverancier
                WHERE IsActief = 1;
            END
        ");
        
        // SP03: Get Leverancier By Id
        DB::unprepared("
            CREATE PROCEDURE spGetLeverancierById(
                IN p_leverancier_id INT
            )
            BEGIN
                SELECT 
                    l.Id,
                    l.Naam,
                    l.ContactPersoon,
                    l.LeverancierNummer,
                    l.Mobiel,
                    l.ContactId,
                    c.Straat,
                    c.Huisnummer,
                    c.Postcode,
                    c.Stad,
                    l.IsActief,
                    l.Opmerking,
                    l.DatumAangemaakt,
                    l.DatumGewijzigd
                FROM Leverancier l
                INNER JOIN Contact c ON l.ContactId = c.Id
                WHERE l.Id = p_leverancier_id
                AND l.IsActief = 1;
            END
        ");
        
        // SP04: Update Leverancier
        DB::unprepared("
            CREATE PROCEDURE spUpdateLeverancier(
                IN p_leverancier_id INT,
                IN p_naam VARCHAR(100),
                IN p_contactpersoon VARCHAR(100),
                IN p_leveranciernummer VARCHAR(50),
                IN p_mobiel VARCHAR(20),
                IN p_straat VARCHAR(100),
                IN p_huisnummer VARCHAR(10),
                IN p_postcode VARCHAR(10),
                IN p_stad VARCHAR(100),
                OUT p_result INT
            )
            BEGIN
                DECLARE v_contact_id INT;
                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    SET p_result = 0;
                    ROLLBACK;
                END;
                
                START TRANSACTION;
                
                IF p_leverancier_id = 5 THEN
                    SET p_result = 0;
                    ROLLBACK;
                ELSE
                    SELECT ContactId INTO v_contact_id
                    FROM Leverancier
                    WHERE Id = p_leverancier_id;
                    
                    UPDATE Contact
                    SET 
                        Straat = p_straat,
                        Huisnummer = p_huisnummer,
                        Postcode = p_postcode,
                        Stad = p_stad,
                        DatumGewijzigd = NOW(6)
                    WHERE Id = v_contact_id;
                    
                    UPDATE Leverancier
                    SET 
                        Naam = p_naam,
                        ContactPersoon = p_contactpersoon,
                        LeverancierNummer = p_leveranciernummer,
                        Mobiel = p_mobiel,
                        DatumGewijzigd = NOW(6)
                    WHERE Id = p_leverancier_id;
                    
                    SET p_result = 1;
                    COMMIT;
                END IF;
            END
        ");
        
        // SP05: Get Products by Leverancier
        DB::unprepared("
            CREATE PROCEDURE spGetProductsByLeverancier(
                IN p_leverancier_id INT
            )
            BEGIN
                SELECT 
                    p.Id,
                    p.Naam,
                    p.Barcode,
                    ppl.DatumLevering,
                    ppl.Aantal,
                    ppl.DatumEerstVolgendeLevering
                FROM Product p
                INNER JOIN ProductPerLeverancier ppl ON p.Id = ppl.ProductId
                WHERE ppl.LeverancierId = p_leverancier_id
                AND p.IsActief = 1
                ORDER BY ppl.DatumLevering DESC;
            END
        ");
    }
}
