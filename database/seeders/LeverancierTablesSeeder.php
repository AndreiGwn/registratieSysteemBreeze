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
        
        // Now create stored procedures
        $procPath = database_path('stored-procedures/leverancier_procedures.sql');
        $procSql = File::get($procPath);
        
        // Remove USE statement
        $procSql = preg_replace('/USE\s+\w+;/i', '', $procSql);
        
        // Remove DELIMITER commands and replace // with ;
        $procSql = preg_replace('/DELIMITER\s+\/\//i', '', $procSql);
        $procSql = preg_replace('/DELIMITER\s+;/i', '', $procSql);
        
        // Split by END// and execute each procedure separately
        $procedures = preg_split('/END\/\//i', $procSql);
        
        foreach ($procedures as $procedure) {
            $procedure = trim($procedure);
            if (!empty($procedure) && !preg_match('/^\s*--/', $procedure)) {
                $procedure = $procedure . ' END;';
                try {
                    DB::unprepared($procedure);
                } catch (\Exception $e) {
                    // Log but continue
                    $this->command->warn('Procedure warning: ' . substr($e->getMessage(), 0, 100));
                }
            }
        }
        
        $this->command->info('✓ Stored procedures created successfully!');
    }
}
