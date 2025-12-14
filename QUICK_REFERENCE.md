# US01 Quick Reference Guide

## Routes
```
GET /leveranciers              → LeverancierController@index (Wireframe-01)
GET /leveranciers/{id}         → LeverancierController@show  (Wireframe-02/03)
```

## Stored Procedures

### 1. spGetLeveranciersWithProductCount()
**Purpose:** Wireframe-01 - Supplier overview with product count  
**Parameters:** None  
**Returns:** id, Naam, ContactPersoon, LeverancierNummer, Mobiel, AantalProducten  
**Usage:** `DB::select('CALL spGetLeveranciersWithProductCount()')`

### 2. spGetLeverancierById(leverancierId)
**Purpose:** Get single supplier details  
**Parameters:** `leverancierId INT`  
**Returns:** id, Naam, ContactPersoon, LeverancierNummer, Mobiel  
**Usage:** `DB::select('CALL spGetLeverancierById(?)', [$id])`

### 3. spGetProductenByLeverancier(leverancierId)
**Purpose:** Wireframe-02 - Products for a supplier  
**Parameters:** `leverancierId INT`  
**Returns:** id, Naam, Barcode, IsActief  
**Usage:** `DB::select('CALL spGetProductenByLeverancier(?)', [$id])`

### 4. spGetAllergenenByProduct(productId)
**Purpose:** Wireframe-02/03 - Allergens for a product  
**Parameters:** `productId INT`  
**Returns:** id, Naam, Omschrijving  
**Usage:** `DB::select('CALL spGetAllergenenByProduct(?)', [$productId])`

### 5. spGetProductById(productId)
**Purpose:** Get single product details  
**Parameters:** `productId INT`  
**Returns:** id, Naam, Barcode, IsActief  
**Usage:** `DB::select('CALL spGetProductById(?)', [$id])`

## Database Tables

### leveranciers
- id, Naam, ContactPersoon, LeverancierNummer, Mobiel
- IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

### products
- id, Naam, Barcode
- IsActief (Product 10 "Winegums" = false), Opmerking, DatumAangemaakt, DatumGewijzigd

### allergenen
- id, Naam, Omschrijving
- IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

### magazijns
- id, ProductId (FK), VerpakkingsEenheid, AantalAanwezig
- IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

### product_per_leveranciers
- id, LeverancierId (FK), ProductId (FK), DatumLevering, Aantal, DatumEerstVolgendeLevering
- IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

### product_per_allergenen
- id, ProductId (FK), AllergeenId (FK)
- IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

## Seed Data Quick Reference

### Leveranciers (5)
1. Venco - Bert van Linge - L1029384719 - 06-28493827 (3 products)
2. Astra Sweets - Jasper del Monte - L1029284315 - 06-39398734 (3 products)
3. Haribo - Sven Stalman - L1029324748 - 06-24383291 (3 products)
4. **Basset - Joyce Stelterberg - L1023845773 - 06-48293823 (0 products)** ← Test Scenario 02
5. De Bron - Remco Veenstra - L1023857832 - 06-34291234 (2 products)

### Products (13)
1. Mintnopjes - 8719587231278 ← Has 3 allergens
2. Schoolkrijt - 8719587326713
3. Honingdrop - 8719587327836 ← Has Lactose
4. Zure Beren - 8719587321441
5. Cola Flesjes - 8719587321237
6. Turtles - 8719587322245 ← Has Soja
7. Witte Muizen - 8719587328256
8. Reuzen Slangen - 8719587325641
9. Zoute Rijen - 8719587322739 ← Has Gelatine + Soja
10. **Winegums - 8719587327527 (IsActief=false)** ← Inactive product
11. Drop Munten - 8719587322345
12. Kruis Drop - 8719587322265 ← Has Lactose
13. Zoute Ruitjes - 8719587323256 ← Has Gluten + Lactose + Soja

### Allergenen (5)
1. Gluten - Dit product bevat gluten
2. Gelatine - Dit product bevat gelatine
3. AZO-Kleurstof - Dit product bevat AZO-kleurstoffen
4. Lactose - Dit product bevat lactose
5. Soja - Dit product bevat soja

## Common Commands

### Database
```bash
# Fresh migration + seed
php artisan migrate:fresh --seed --seeder=JaminDataSeeder

# Run specific migration
php artisan migrate

# Rollback last migration
php artisan migrate:rollback
```

### Development Server
```bash
# Start Laravel
php artisan serve

# Start Vite (in separate terminal)
npm run dev
```

### Testing Stored Procedures (MySQL)
```sql
-- Test leveranciers with counts
CALL spGetLeveranciersWithProductCount();

-- Test Venco products
CALL spGetProductenByLeverancier(1);

-- Test Mintnopjes allergens
CALL spGetAllergenenByProduct(1);

-- Test Basset (no products)
CALL spGetProductenByLeverancier(4);
```

### Git
```bash
# Check branch
git branch

# Check status
git status

# Add and commit
git add .
git commit -m "message"

# Push to GitHub
git push -u origin dev-opdracht-2-us01

# View commits
git log --oneline
```

## View Components

### index.blade.php (Wireframe-01)
- Table with leveranciers
- Product count column
- "Bekijk Producten" links

### show.blade.php (Wireframe-02/03)
- Supplier info card
- Products list (if any)
- Allergen warnings per product
- Yellow warning for no products (Scenario 02)
- "Niet Actief" badge for inactive products
- "Terug naar Overzicht" button

## Wireframe Mapping

### Wireframe-01: Overzicht Leveranciers
- **File:** `resources/views/leveranciers/index.blade.php`
- **Route:** `/leveranciers`
- **Controller:** `LeverancierController@index`
- **SP:** `spGetLeveranciersWithProductCount()`
- **Scenario:** US01 Scenario 01

### Wireframe-02: Producten van Leverancier (met producten)
- **File:** `resources/views/leveranciers/show.blade.php`
- **Route:** `/leveranciers/{id}`
- **Controller:** `LeverancierController@show`
- **SP:** `spGetLeverancierById()`, `spGetProductenByLeverancier()`, `spGetAllergenenByProduct()`
- **Scenario:** US01 Scenario 01

### Wireframe-03: Geen Producten
- **File:** `resources/views/leveranciers/show.blade.php` (same file, conditional rendering)
- **Route:** `/leveranciers/4` (Basset)
- **Controller:** `LeverancierController@show`
- **SP:** `spGetLeverancierById()`, `spGetProductenByLeverancier()` (returns empty)
- **Scenario:** US01 Scenario 02

## Key Differences: US01 vs US02

### US01 (This Branch)
✅ View leveranciers  
✅ View products per leverancier  
✅ View allergens per product  
❌ **NO** add delivery functionality  
❌ **NO** delivery form  
❌ **NO** stock updates

### US02 (Future Branch: dev-opdracht-2-us02)
✅ All of US01 functionality  
✅ Add delivery form  
✅ Process new deliveries  
✅ Update stock in magazijn  
✅ Handle inactive products  
✅ `spAddDelivery()` stored procedure

## Assignment Requirements Checklist

- [x] MVC Framework (Laravel)
- [x] OOP (Controllers)
- [x] Stored Procedures (5 procedures for US01)
- [x] PDO (`DB::select('CALL ...')`)
- [x] System Fields (IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
- [x] Wireframe-01 (index.blade.php)
- [x] Wireframe-02 (show.blade.php with products)
- [x] Wireframe-03 (show.blade.php no products)
- [x] Separate branch (dev-opdracht-2-us01)
- [x] Migrations with system fields
- [x] Seeder with all spec data
- [x] Product 10 IsActief=false
- [x] Database export SQL
- [x] Documentation
- [ ] Videos (3 MP4 files) - TODO
- [ ] Minimum 10 commits - In Progress

## URLs

- **Local:** http://localhost:8000
- **GitHub:** https://github.com/AndreiGwn/registratieSysteemBreeze
- **Branch:** dev-opdracht-2-us01

## Contact Info

**Student:** Andre  
**Assignment:** BE-S2-P2 Opdracht 2  
**User Story:** US01  
**Date:** December 14, 2025
