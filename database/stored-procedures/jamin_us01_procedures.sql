-- ==============================================
-- Jamin Stored Procedures - User Story 01 ONLY
-- ==============================================

DELIMITER $$

-- ==============================================
-- Stored Procedure: spGetLeveranciersWithProductCount
-- Description: Get all suppliers with their product count
-- US01 Scenario 01: Display suppliers overview (Wireframe-01)
-- ==============================================
DROP PROCEDURE IF EXISTS spGetLeveranciersWithProductCount$$
CREATE PROCEDURE spGetLeveranciersWithProductCount()
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
END$$

-- ==============================================
-- Stored Procedure: spGetProductenByLeverancier
-- Description: Get all products for a specific supplier
-- US01 Scenario 01: Display products per supplier (Wireframe-02)
-- ==============================================
DROP PROCEDURE IF EXISTS spGetProductenByLeverancier$$
CREATE PROCEDURE spGetProductenByLeverancier(IN leverancierId INT)
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
END$$

-- ==============================================
-- Stored Procedure: spGetAllergenenByProduct
-- Description: Get all allergens for a specific product
-- US01 Scenario 02: Display allergens for a product (Wireframe-03)
-- ==============================================
DROP PROCEDURE IF EXISTS spGetAllergenenByProduct$$
CREATE PROCEDURE spGetAllergenenByProduct(IN productId INT)
BEGIN
    SELECT 
        a.id,
        a.Naam,
        a.Omschrijving
    FROM allergenen a
    INNER JOIN product_per_allergenen ppa ON a.id = ppa.AllergeenId
    WHERE ppa.ProductId = productId AND a.IsActief = TRUE
    ORDER BY a.Naam;
END$$

-- ==============================================
-- Stored Procedure: spGetLeverancierById
-- Description: Get a single supplier by ID
-- Helper for US01
-- ==============================================
DROP PROCEDURE IF EXISTS spGetLeverancierById$$
CREATE PROCEDURE spGetLeverancierById(IN leverancierId INT)
BEGIN
    SELECT 
        id,
        Naam,
        ContactPersoon,
        LeverancierNummer,
        Mobiel
    FROM leveranciers
    WHERE id = leverancierId AND IsActief = TRUE;
END$$

-- ==============================================
-- Stored Procedure: spGetProductById
-- Description: Get a single product by ID
-- Helper for US01
-- ==============================================
DROP PROCEDURE IF EXISTS spGetProductById$$
CREATE PROCEDURE spGetProductById(IN productId INT)
BEGIN
    SELECT 
        id,
        Naam,
        Barcode,
        IsActief
    FROM products
    WHERE id = productId;
END$$

DELIMITER ;

-- ==============================================
-- End of User Story 01 Stored Procedures
-- ==============================================
