-- =========================================
-- Stored Procedures voor Leverancier Management
-- Opdracht 3 - User Story 01
-- Auteur: [Studentnaam]
-- Datum: 24-01-2026
-- Beschrijving: CRUD operaties voor leverancier beheer
--               Inclusief pagination en scenario-based updates
-- =========================================

DELIMITER //

-- =========================================
-- SP01: Get All Leveranciers with Pagination
-- =========================================
DROP PROCEDURE IF EXISTS spGetAllLeveranciers//
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
END//

-- =========================================
-- SP02: Count Total Leveranciers
-- =========================================
DROP PROCEDURE IF EXISTS spCountLeveranciers//
CREATE PROCEDURE spCountLeveranciers()
BEGIN
    SELECT COUNT(*) as total
    FROM Leverancier
    WHERE IsActief = 1;
END//

-- =========================================
-- SP03: Get Leverancier By Id
-- =========================================
DROP PROCEDURE IF EXISTS spGetLeverancierById//
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
END//

-- =========================================
-- SP04: Update Leverancier (Scenario 1 - Astra Sweets)
-- This will successfully update when LeverancierId = 2
-- =========================================
DROP PROCEDURE IF EXISTS spUpdateLeverancier//
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
    
    -- Scenario 2: Simulate technical failure for "De Bron" (Id = 5)
    IF p_leverancier_id = 5 THEN
        SET p_result = 0;
        ROLLBACK;
    ELSE
        -- Get the ContactId for this leverancier
        SELECT ContactId INTO v_contact_id
        FROM Leverancier
        WHERE Id = p_leverancier_id;
        
        -- Update Contact table
        UPDATE Contact
        SET 
            Straat = p_straat,
            Huisnummer = p_huisnummer,
            Postcode = p_postcode,
            Stad = p_stad,
            DatumGewijzigd = NOW(6)
        WHERE Id = v_contact_id;
        
        -- Update Leverancier table
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
END//

-- =========================================
-- SP05: Get Products by Leverancier
-- =========================================
DROP PROCEDURE IF EXISTS spGetProductsByLeverancier//
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
END//

DELIMITER ;
