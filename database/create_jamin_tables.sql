-- Jamin Database Table Structures
-- User Story 01 - Database Schema

CREATE TABLE `leveranciers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) NOT NULL,
  `ContactPersoon` varchar(100) NOT NULL,
  `LeverancierNummer` varchar(20) NOT NULL,
  `Mobiel` varchar(15) NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(255) DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `DatumGewijzigd` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  UNIQUE KEY `leveranciers_leveranciernummer_unique` (`LeverancierNummer`)
);

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) NOT NULL,
  `Barcode` varchar(20) NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(255) DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `DatumGewijzigd` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_barcode_unique` (`Barcode`)
);

CREATE TABLE `allergenen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) NOT NULL,
  `Omschrijving` varchar(255) NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(255) DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `DatumGewijzigd` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
);

CREATE TABLE `magazijns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` bigint unsigned NOT NULL,
  `VerpakkingsEenheid` decimal(5,2) NOT NULL,
  `AantalAanwezig` int DEFAULT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(255) DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `DatumGewijzigd` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `magazijns_productid_foreign` (`ProductId`),
  CONSTRAINT `magazijns_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `products` (`id`) ON DELETE CASCADE
);

CREATE TABLE `product_per_leveranciers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `LeverancierId` bigint unsigned NOT NULL,
  `ProductId` bigint unsigned NOT NULL,
  `DatumLevering` date NOT NULL,
  `Aantal` int NOT NULL,
  `DatumEerstVolgendeLevering` date DEFAULT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(255) DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `DatumGewijzigd` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_per_leveranciers_leverancierid_foreign` (`LeverancierId`),
  KEY `product_per_leveranciers_productid_foreign` (`ProductId`),
  CONSTRAINT `product_per_leveranciers_leverancierid_foreign` FOREIGN KEY (`LeverancierId`) REFERENCES `leveranciers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_per_leveranciers_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `products` (`id`) ON DELETE CASCADE
);

CREATE TABLE `product_per_allergenen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` bigint unsigned NOT NULL,
  `AllergeenId` bigint unsigned NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(255) DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `DatumGewijzigd` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_per_allergenen_productid_foreign` (`ProductId`),
  KEY `product_per_allergenen_allergeenid_foreign` (`AllergeenId`),
  CONSTRAINT `product_per_allergenen_allergeenid_foreign` FOREIGN KEY (`AllergeenId`) REFERENCES `allergenen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_per_allergenen_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `products` (`id`) ON DELETE CASCADE
);
