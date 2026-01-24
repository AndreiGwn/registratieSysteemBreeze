# Database Specificatie Tabel - Opdracht 3

**Project:** Jamin Leveranciers Management  
**Datum:** 24 januari 2026  
**Auteur:** [Studentnaam]  

---

## Tabel 1: Contact

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor contact tabel |
| Straat | VARCHAR | 100 | NO | - | - | - | Straatnaam van het adres |
| Huisnummer | VARCHAR | 10 | NO | - | - | - | Huisnummer inclusief toevoeging |
| Postcode | VARCHAR | 10 | NO | - | - | - | Postcode van het adres |
| Stad | VARCHAR | 100 | NO | - | - | - | Plaatsnaam |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking over het contact |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Een contact kan bij één leverancier horen (1:1)

---

## Tabel 2: Leverancier

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor leverancier tabel |
| Naam | VARCHAR | 100 | NO | - | - | - | Naam van de leverancier |
| ContactPersoon | VARCHAR | 100 | NO | - | - | - | Naam van de contactpersoon |
| LeverancierNummer | VARCHAR | 50 | NO | - | UNIQUE | - | Uniek leveranciernummer |
| Mobiel | VARCHAR | 20 | NO | - | - | - | Mobiel telefoonnummer |
| ContactId | INT | - | NO | - | FK | - | Foreign key naar Contact tabel |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking over leverancier |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Leverancier heeft één contact (N:1) via ContactId → Contact.Id
- Leverancier kan meerdere producten leveren (N:M) via ProductPerLeverancier

**Constraints:**
- FOREIGN KEY (ContactId) REFERENCES Contact(Id) ON DELETE CASCADE

---

## Tabel 3: Allergeen

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor allergeen tabel |
| Naam | VARCHAR | 100 | NO | - | - | - | Naam van het allergeen |
| Omschrijving | VARCHAR | 250 | NO | - | - | - | Beschrijving van het allergeen |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Een allergeen kan in meerdere producten voorkomen (N:M) via ProductPerAllergeen

---

## Tabel 4: Product

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor product tabel |
| Naam | VARCHAR | 100 | NO | - | - | - | Naam van het product |
| Barcode | VARCHAR | 50 | NO | - | UNIQUE | - | Unieke barcode van het product |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Product kan meerdere allergenen bevatten (N:M) via ProductPerAllergeen
- Product kan door meerdere leveranciers geleverd worden (N:M) via ProductPerLeverancier
- Product heeft één magazijn record (1:1) via Magazijn

---

## Tabel 5: Magazijn

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor magazijn tabel |
| ProductId | INT | - | NO | - | FK | - | Foreign key naar Product tabel |
| VerpakkingsEenheid | DECIMAL | 5,1 | NO | - | - | - | Grootte van de verpakkingseenheid |
| AantalAanwezig | INT | - | YES | NULL | - | - | Hoeveelheid op voorraad (NULL = onbekend) |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Magazijn hoort bij één product (N:1) via ProductId → Product.Id

**Constraints:**
- FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE

---

## Tabel 6: ProductPerAllergeen

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor koppeltabel |
| ProductId | INT | - | NO | - | FK | - | Foreign key naar Product tabel |
| AllergeenId | INT | - | NO | - | FK | - | Foreign key naar Allergeen tabel |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Koppeling tussen Product en Allergeen (N:M)

**Constraints:**
- FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE
- FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id) ON DELETE CASCADE

---

## Tabel 7: ProductPerLeverancier

| Kolomnaam | Datatype | Lengte | Nullable | Default | Key | Extra | Beschrijving |
|-----------|----------|--------|----------|---------|-----|-------|--------------|
| Id | INT | - | NO | - | PK | AUTO_INCREMENT | Primary key voor koppeltabel |
| LeverancierId | INT | - | NO | - | FK | - | Foreign key naar Leverancier tabel |
| ProductId | INT | - | NO | - | FK | - | Foreign key naar Product tabel |
| DatumLevering | DATE | - | NO | - | - | - | Datum van de levering |
| Aantal | INT | - | NO | - | - | - | Aantal geleverde producten |
| DatumEerstVolgendeLevering | DATE | - | YES | NULL | - | - | Datum van eerstvolgende levering |
| IsActief | BIT | 1 | NO | 1 | - | - | Geeft aan of record actief is (1=actief, 0=inactief) |
| Opmerking | VARCHAR | 250 | YES | NULL | - | - | Optionele opmerking |
| DatumAangemaakt | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | - | Timestamp van aanmaak record |
| DatumGewijzigd | DATETIME | 6 | NO | CURRENT_TIMESTAMP(6) | - | ON UPDATE | Timestamp van laatste wijziging |

**Relaties:**
- Koppeling tussen Leverancier en Product (N:M)

**Constraints:**
- FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id) ON DELETE CASCADE
- FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE

---

## Entity Relationship Diagram (ERD)

```
Contact (1) ----< (N) Leverancier (N) >----< (N) ProductPerLeverancier (N) >----< (N) Product
                                                                                          |
                                                                                         (1)
                                                                                          |
                                                                                         (N)
                                                                                      Magazijn
                                                                                          
Product (N) >----< (N) ProductPerAllergeen (N) >----< (N) Allergeen
```

---

## Stored Procedures

### 1. spGetAllLeveranciers
**Doel:** Haalt alle actieve leveranciers op met paginatie  
**Parameters:**
- IN p_limit INT - Aantal records per pagina
- IN p_offset INT - Startpunt voor records

**Returns:** Resultset met leveranciers en contactgegevens

---

### 2. spCountLeveranciers
**Doel:** Telt het totaal aantal actieve leveranciers  
**Parameters:** Geen  
**Returns:** Total count

---

### 3. spGetLeverancierById
**Doel:** Haalt één specifieke leverancier op met contactgegevens  
**Parameters:**
- IN p_leverancier_id INT - ID van de leverancier

**Returns:** Resultset met leverancier details

---

### 4. spUpdateLeverancier
**Doel:** Wijzigt leverancier- en contactgegevens  
**Parameters:**
- IN p_leverancier_id INT
- IN p_naam VARCHAR(100)
- IN p_contactpersoon VARCHAR(100)
- IN p_leveranciernummer VARCHAR(50)
- IN p_mobiel VARCHAR(20)
- IN p_straat VARCHAR(100)
- IN p_huisnummer VARCHAR(10)
- IN p_postcode VARCHAR(10)
- IN p_stad VARCHAR(100)
- OUT p_result INT - 1 = success, 0 = failure

**Business Logic:**
- Als p_leverancier_id = 5 (De Bron), dan altijd falen (Scenario 02)
- Anders succesvol updaten (Scenario 01)

**Returns:** OUT parameter p_result

---

### 5. spGetProductsByLeverancier
**Doel:** Haalt alle producten op die door een leverancier geleverd worden  
**Parameters:**
- IN p_leverancier_id INT - ID van de leverancier

**Returns:** Resultset met producten en leveringsdetails

---

## Indexen

**Aanbevolen indexen voor performance:**

1. **Leverancier table:**
   - INDEX idx_leveranciernummer (LeverancierNummer)
   - INDEX idx_contactid (ContactId)

2. **Product table:**
   - INDEX idx_barcode (Barcode)

3. **ProductPerLeverancier table:**
   - INDEX idx_leverancierid (LeverancierId)
   - INDEX idx_productid (ProductId)

4. **ProductPerAllergeen table:**
   - INDEX idx_productid (ProductId)
   - INDEX idx_allergeenid (AllergeenId)

---

## Opmerkingen

1. Alle tabellen gebruiken de InnoDB storage engine voor transactie-ondersteuning
2. Character set: utf8mb4 voor volledige Unicode-ondersteuning
3. Cascade deletes zijn ingesteld op alle foreign keys
4. Systeemvelden (IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd) zijn consistent toegepast op alle tabellen
5. Soft delete strategie via IsActief veld (records worden niet fysiek verwijderd)
