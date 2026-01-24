-- =========================================
-- Opdracht 3 Database Create Script
-- Jamin Leveranciers Management
-- Datum: 24-01-2026
-- =========================================

-- Drop existing tables if they exist (in correct order due to foreign keys)
DROP TABLE IF EXISTS ProductPerLeverancier;
DROP TABLE IF EXISTS ProductPerAllergeen;
DROP TABLE IF EXISTS Magazijn;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Allergeen;
DROP TABLE IF EXISTS Leverancier;
DROP TABLE IF EXISTS Contact;

-- =========================================
-- Tabel: Contact
-- =========================================
CREATE TABLE Contact (
    Id INT NOT NULL AUTO_INCREMENT,
    Straat VARCHAR(100) NOT NULL,
    Huisnummer VARCHAR(10) NOT NULL,
    Postcode VARCHAR(10) NOT NULL,
    Stad VARCHAR(100) NOT NULL,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- Tabel: Leverancier
-- =========================================
CREATE TABLE Leverancier (
    Id INT NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    ContactPersoon VARCHAR(100) NOT NULL,
    LeverancierNummer VARCHAR(50) NOT NULL UNIQUE,
    Mobiel VARCHAR(20) NOT NULL,
    ContactId INT NOT NULL,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (ContactId) REFERENCES Contact(Id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- Tabel: Allergeen
-- =========================================
CREATE TABLE Allergeen (
    Id INT NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Omschrijving VARCHAR(250) NOT NULL,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- Tabel: Product
-- =========================================
CREATE TABLE Product (
    Id INT NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Barcode VARCHAR(50) NOT NULL UNIQUE,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- Tabel: Magazijn
-- =========================================
CREATE TABLE Magazijn (
    Id INT NOT NULL AUTO_INCREMENT,
    ProductId INT NOT NULL,
    VerpakkingsEenheid DECIMAL(5,1) NOT NULL,
    AantalAanwezig INT NULL,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- Tabel: ProductPerAllergeen
-- =========================================
CREATE TABLE ProductPerAllergeen (
    Id INT NOT NULL AUTO_INCREMENT,
    ProductId INT NOT NULL,
    AllergeenId INT NOT NULL,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE,
    FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- Tabel: ProductPerLeverancier
-- =========================================
CREATE TABLE ProductPerLeverancier (
    Id INT NOT NULL AUTO_INCREMENT,
    LeverancierId INT NOT NULL,
    ProductId INT NOT NULL,
    DatumLevering DATE NOT NULL,
    Aantal INT NOT NULL,
    DatumEerstVolgendeLevering DATE NULL,
    IsActief BIT DEFAULT 1,
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id) ON DELETE CASCADE,
    FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================
-- DATA INSERTION
-- =========================================

-- Insert Contact data
INSERT INTO Contact (Id, Straat, Huisnummer, Postcode, Stad) VALUES
(1, 'Van Gilslaan', '34', '1045CB', 'Hilvarenbeek'),
(2, 'Den Dolderpad', '2', '1067RC', 'Utrecht'),
(3, 'Fredo Raalteweg', '257', '1236OP', 'Nijmegen'),
(4, 'Bertrand Russellhof', '21', '2034AP', 'Den Haag'),
(5, 'Leon van Bonstraat', '213', '145XC', 'Lunteren'),
(6, 'Bea van Lingenlaan', '234', '2197FG', 'Sint Pancras');

-- Insert Leverancier data
INSERT INTO Leverancier (Id, Naam, ContactPersoon, LeverancierNummer, Mobiel, ContactId) VALUES
(1, 'Venco', 'Bert van Linge', 'L1029384719', '06-28493827', 1),
(2, 'Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734', 2),
(3, 'Haribo', 'Sven Stalman', 'L1029324748', '06-24383291', 3),
(4, 'Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823', 4),
(5, 'De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234', 5),
(6, 'Quality Street', 'Johan Nooij', 'L1029234586', '06-23458456', 6);

-- Insert Allergeen data
INSERT INTO Allergeen (Id, Naam, Omschrijving) VALUES
(1, 'Gluten', 'Dit product bevat gluten'),
(2, 'Gelatine', 'Dit product bevat gelatine'),
(3, 'AZO-Kleurstof', 'Dit product bevat AZO-kleurstoffen'),
(4, 'Lactose', 'Dit product bevat lactose'),
(5, 'Soja', 'Dit product bevat soja');

-- Insert Product data
INSERT INTO Product (Id, Naam, Barcode) VALUES
(1, 'Mintnopjes', '8719587231278'),
(2, 'Schoolkrijt', '8719587326713'),
(3, 'Honingdrop', '8719587327836'),
(4, 'Zure Beren', '8719587321441'),
(5, 'Cola Flesjes', '8719587321237'),
(6, 'Turtles', '8719587322245'),
(7, 'Witte Muizen', '8719587328256'),
(8, 'Reuzen Slangen', '8719587325641'),
(9, 'Zoute Rijen', '8719587322739'),
(10, 'Winegums', '8719587327527'),
(11, 'Drop Munten', '8719587322345'),
(12, 'Kruis Drop', '8719587322265'),
(13, 'Zoute Ruitjes', '8719587323256');

-- Insert Magazijn data
INSERT INTO Magazijn (Id, ProductId, VerpakkingsEenheid, AantalAanwezig) VALUES
(1, 1, 5, 453),
(2, 2, 2.5, 400),
(3, 3, 5, 1),
(4, 4, 1, 800),
(5, 5, 3, 234),
(6, 6, 2, 345),
(7, 7, 1, 795),
(8, 8, 10, 233),
(9, 9, 2.5, 123),
(10, 10, 3, NULL),
(11, 11, 2, 367),
(12, 12, 1, 467),
(13, 13, 5, 20);

-- Insert ProductPerAllergeen data
INSERT INTO ProductPerAllergeen (Id, ProductId, AllergeenId) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 3),
(4, 3, 4),
(5, 6, 5),
(6, 9, 2),
(7, 9, 5),
(8, 10, 2),
(9, 12, 4),
(10, 13, 1),
(11, 13, 4),
(12, 13, 5);

-- Insert ProductPerLeverancier data
INSERT INTO ProductPerLeverancier (Id, LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering) VALUES
(1, 1, 1, '2023-04-09', 23, '2023-04-16'),
(2, 1, 1, '2023-04-18', 21, '2023-04-25'),
(3, 1, 2, '2023-04-09', 12, '2023-04-16'),
(4, 1, 3, '2023-04-10', 11, '2023-04-17'),
(5, 2, 4, '2023-04-14', 16, '2023-04-21'),
(6, 2, 4, '2023-04-21', 23, '2023-04-28'),
(7, 2, 5, '2023-04-14', 45, '2023-04-21'),
(8, 2, 6, '2023-04-14', 30, '2023-04-21'),
(9, 3, 7, '2023-04-12', 12, '2023-04-19'),
(10, 3, 7, '2023-04-19', 23, '2023-04-26'),
(11, 3, 8, '2023-04-10', 12, '2023-04-17'),
(12, 3, 9, '2023-04-11', 1, '2023-04-18'),
(13, 4, 10, '2023-04-16', 24, '2023-04-30'),
(14, 5, 11, '2023-04-10', 47, '2023-04-17'),
(15, 5, 11, '2023-04-19', 60, '2023-04-26'),
(16, 5, 12, '2023-04-11', 45, NULL),
(17, 5, 13, '2023-04-12', 23, NULL);
