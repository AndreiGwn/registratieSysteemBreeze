-- ==============================================
-- Jamin Database Export - User Story 01
-- Database: breezedemo
-- Tables: leveranciers, products, allergenen, magazijns,
--         product_per_leveranciers, product_per_allergenen
-- ==============================================

-- Create leveranciers table
CREATE TABLE IF NOT EXISTS `leveranciers` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Naam` VARCHAR(100) NOT NULL,
    `ContactPersoon` VARCHAR(100) NOT NULL,
    `LeverancierNummer` VARCHAR(20) NOT NULL UNIQUE,
    `Mobiel` VARCHAR(15) NOT NULL,
    `IsActief` TINYINT(1) NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(255) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create products table
CREATE TABLE IF NOT EXISTS `products` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Naam` VARCHAR(100) NOT NULL,
    `Barcode` VARCHAR(20) NOT NULL UNIQUE,
    `IsActief` TINYINT(1) NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(255) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create allergenen table
CREATE TABLE IF NOT EXISTS `allergenen` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Naam` VARCHAR(50) NOT NULL,
    `Omschrijving` VARCHAR(255) NOT NULL,
    `IsActief` TINYINT(1) NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(255) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create magazijns table
CREATE TABLE IF NOT EXISTS `magazijns` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ProductId` BIGINT UNSIGNED NOT NULL,
    `VerpakkingsEenheid` DECIMAL(5,2) NOT NULL,
    `AantalAanwezig` INT NULL,
    `IsActief` TINYINT(1) NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(255) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    CONSTRAINT `fk_magazijns_productid` FOREIGN KEY (`ProductId`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create product_per_leveranciers table
CREATE TABLE IF NOT EXISTS `product_per_leveranciers` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `LeverancierId` BIGINT UNSIGNED NOT NULL,
    `ProductId` BIGINT UNSIGNED NOT NULL,
    `DatumLevering` DATE NOT NULL,
    `Aantal` INT NOT NULL,
    `DatumEerstVolgendeLevering` DATE NULL,
    `IsActief` TINYINT(1) NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(255) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    CONSTRAINT `fk_ppl_leverancierid` FOREIGN KEY (`LeverancierId`) REFERENCES `leveranciers` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ppl_productid` FOREIGN KEY (`ProductId`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create product_per_allergenen table
CREATE TABLE IF NOT EXISTS `product_per_allergenen` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ProductId` BIGINT UNSIGNED NOT NULL,
    `AllergeenId` BIGINT UNSIGNED NOT NULL,
    `IsActief` TINYINT(1) NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(255) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    CONSTRAINT `fk_ppa_productid` FOREIGN KEY (`ProductId`) REFERENCES `products` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ppa_allergeenid` FOREIGN KEY (`AllergeenId`) REFERENCES `allergenen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
