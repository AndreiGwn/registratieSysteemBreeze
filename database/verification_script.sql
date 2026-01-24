-- =========================================
-- Verificatie Script voor Opdracht 3
-- Te gebruiken na het draaien van de create scripts
-- =========================================

USE jamin_db;

-- =========================================
-- 1. CONTROLEER OF ALLE TABELLEN BESTAAN
-- =========================================
SHOW TABLES;
-- Verwacht: 7 tabellen
-- - Allergeen
-- - Contact
-- - Leverancier
-- - Magazijn
-- - Product
-- - ProductPerAllergeen
-- - ProductPerLeverancier

-- =========================================
-- 2. CONTROLEER AANTAL RECORDS PER TABEL
-- =========================================

SELECT 'Contact' as Tabel, COUNT(*) as AantalRecords FROM Contact
UNION ALL
SELECT 'Leverancier', COUNT(*) FROM Leverancier
UNION ALL
SELECT 'Product', COUNT(*) FROM Product
UNION ALL
SELECT 'Allergeen', COUNT(*) FROM Allergeen
UNION ALL
SELECT 'Magazijn', COUNT(*) FROM Magazijn
UNION ALL
SELECT 'ProductPerAllergeen', COUNT(*) FROM ProductPerAllergeen
UNION ALL
SELECT 'ProductPerLeverancier', COUNT(*) FROM ProductPerLeverancier;

-- Verwachte output:
-- Contact: 6
-- Leverancier: 6
-- Product: 13
-- Allergeen: 5
-- Magazijn: 13
-- ProductPerAllergeen: 12
-- ProductPerLeverancier: 17

-- =========================================
-- 3. CONTROLEER FOREIGN KEY CONSTRAINTS
-- =========================================

SELECT 
    TABLE_NAME,
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME
FROM 
    INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE 
    TABLE_SCHEMA = 'jamin_db'
    AND REFERENCED_TABLE_NAME IS NOT NULL;

-- =========================================
-- 4. CONTROLEER OF SYSTEEMVELDEN AANWEZIG ZIJN
-- =========================================

-- Contact tabel
DESCRIBE Contact;
-- Moet bevatten: IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

-- Leverancier tabel
DESCRIBE Leverancier;
-- Moet bevatten: IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

-- =========================================
-- 5. CONTROLEER STORED PROCEDURES
-- =========================================

SHOW PROCEDURE STATUS WHERE Db = 'jamin_db';
-- Verwacht: 5 procedures
-- - spGetAllLeveranciers
-- - spCountLeveranciers
-- - spGetLeverancierById
-- - spUpdateLeverancier
-- - spGetProductsByLeverancier

-- =========================================
-- 6. TEST DATA VERIFICATIE
-- =========================================

-- Check Astra Sweets (voor Scenario 01)
SELECT 
    l.Id,
    l.Naam,
    l.Mobiel,
    c.Straat
FROM Leverancier l
INNER JOIN Contact c ON l.ContactId = c.Id
WHERE l.Id = 2;
-- Verwacht: 
-- Id: 2
-- Naam: Astra Sweets
-- Mobiel: 06-39398734
-- Straat: Den Dolderpad

-- Check De Bron (voor Scenario 02)
SELECT 
    l.Id,
    l.Naam,
    l.Mobiel
FROM Leverancier l
WHERE l.Id = 5;
-- Verwacht:
-- Id: 5
-- Naam: De Bron
-- Mobiel: 06-34291234

-- =========================================
-- 7. TEST STORED PROCEDURES
-- =========================================

-- Test pagination
CALL spGetAllLeveranciers(4, 0);
-- Verwacht: 4 records (eerste pagina)

CALL spGetAllLeveranciers(4, 4);
-- Verwacht: 2 records (tweede pagina)

-- Test count
CALL spCountLeveranciers();
-- Verwacht: 6 leveranciers

-- Test get by id
CALL spGetLeverancierById(2);
-- Verwacht: Details van Astra Sweets

-- =========================================
-- 8. TEST UPDATE SCENARIO'S (BELANGRIJK!)
-- =========================================

-- Scenario 01 Test (BEFORE UPDATE)
SELECT 
    l.Mobiel as Leverancier_Mobiel,
    c.Straat as Contact_Straat,
    l.DatumGewijzigd
FROM Leverancier l
INNER JOIN Contact c ON l.ContactId = c.Id
WHERE l.Id = 2;

-- Run deze stored procedure call
CALL spUpdateLeverancier(
    2,                      -- Astra Sweets
    'Astra Sweets',
    'Jasper del Monte',
    'L1029284315',
    '06-39398825',          -- Nieuwe mobiel
    'Den Dolderlaan',       -- Nieuwe straat
    '2',
    '1067RC',
    'Utrecht',
    @result
);

SELECT @result as UpdateResult;
-- Verwacht: 1 (success)

-- Check AFTER UPDATE
SELECT 
    l.Mobiel as Leverancier_Mobiel,
    c.Straat as Contact_Straat,
    l.DatumGewijzigd
FROM Leverancier l
INNER JOIN Contact c ON l.ContactId = c.Id
WHERE l.Id = 2;
-- Verwacht:
-- Mobiel: 06-39398825 (GEWIJZIGD)
-- Straat: Den Dolderlaan (GEWIJZIGD)
-- DatumGewijzigd: [RECENT TIMESTAMP]

-- Scenario 02 Test (SHOULD FAIL)
CALL spUpdateLeverancier(
    5,                      -- De Bron (moet falen)
    'De Bron',
    'Remco Veenstra',
    'L1023857736',
    '06-39398825',          -- Poging tot wijzigen
    'Leon van Bonstraat',
    '213',
    '145XC',
    'Lunteren',
    @result
);

SELECT @result as UpdateResult;
-- Verwacht: 0 (failure)

-- Check dat NIETS is gewijzigd
SELECT 
    l.Mobiel,
    l.DatumGewijzigd
FROM Leverancier l
WHERE l.Id = 5;
-- Verwacht:
-- Mobiel: 06-34291234 (ONGEWIJZIGD)

-- =========================================
-- 9. DATA INTEGRITY CHECKS
-- =========================================

-- Check op orphaned records
SELECT 'Orphaned Leveranciers' as Check_Type, COUNT(*) as Count
FROM Leverancier l
LEFT JOIN Contact c ON l.ContactId = c.Id
WHERE c.Id IS NULL;
-- Verwacht: 0

-- Check op duplicate leverancier numbers
SELECT LeverancierNummer, COUNT(*) as Count
FROM Leverancier
GROUP BY LeverancierNummer
HAVING Count > 1;
-- Verwacht: geen results (geen duplicaten)

-- Check op duplicate barcodes
SELECT Barcode, COUNT(*) as Count
FROM Product
GROUP BY Barcode
HAVING Count > 1;
-- Verwacht: geen results (geen duplicaten)

-- =========================================
-- 10. FINAL SUMMARY
-- =========================================

SELECT 
    'Database Setup' as Status,
    CASE 
        WHEN (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jamin_db') = 7 
        THEN 'OK ✓'
        ELSE 'FAIL ✗'
    END as Tables,
    CASE 
        WHEN (SELECT COUNT(*) FROM Leverancier) = 6 
        THEN 'OK ✓'
        ELSE 'FAIL ✗'
    END as Test_Data,
    CASE 
        WHEN (SELECT COUNT(*) FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_SCHEMA = 'jamin_db' AND ROUTINE_TYPE = 'PROCEDURE') = 5 
        THEN 'OK ✓'
        ELSE 'FAIL ✗'
    END as Stored_Procedures;

-- =========================================
-- EINDE VERIFICATIE
-- Als alle checks "OK ✓" zijn, is de database correct opgezet!
-- =========================================
