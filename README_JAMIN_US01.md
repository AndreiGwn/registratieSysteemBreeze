# Jamin Magazijnbeheer - User Story 01

## 📋 Opdracht Informatie

**Vak:** Backend Development  
**Periode:** 2  
**Student:** Andre  
**Branch:** dev-opdracht-2-us01  
**User Story:** US01 - Overzicht Leveranciers en Producten

---

## 🎯 User Story 01

**Als** Magazijnmedewerker  
**Wil ik** een informatieoverzicht kunnen zien van de verschillende leveranciers  
**Zodat** ik snel kan zien welke leveranciers welke producten leveren en welke allergenen er in zitten

### Scenario 01: Leverancier met Producten (Wireframe-01 & 02)
**Gegeven** dat ik ben ingelogd als magazijnmedewerker  
**Als** ik het overzicht van leveranciers bekijk  
**Dan** zie ik een tabel met alle actieve leveranciers en hun aantal producten  
**En** kan ik op een leverancier klikken om de producten te zien  
**En** zie ik per product de allergeneninformatie

### Scenario 02: Leverancier zonder Producten (Wireframe-03)
**Gegeven** dat ik ben ingelogd als magazijnmedewerker  
**Als** ik een leverancier bekijk die geen producten heeft  
**Dan** zie ik een duidelijke melding dat er geen producten zijn

---

## 🏗️ Technische Architectuur

### Verplichte Technologieën
✅ **MVC Framework:** Laravel 12  
✅ **OOP:** Controllers, Models (alleen voor structuur)  
✅ **Stored Procedures:** Alle data access via MySQL procedures  
✅ **PDO:** `DB::select()` voor stored procedure calls  
✅ **System Fields:** IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd

### Database Schema

#### Tables (6 totaal)
1. **leveranciers** - Supplier information
2. **products** - Product catalog (Product 10 "Winegums" IsActief=false)
3. **allergenen** - Allergen types
4. **magazijns** - Warehouse stock
5. **product_per_leveranciers** - Product deliveries per supplier
6. **product_per_allergenen** - Product-allergen relationships

#### Stored Procedures (5 voor US01)
1. `spGetLeveranciersWithProductCount()` - Get all suppliers with product count
2. `spGetProductenByLeverancier(leverancierId)` - Get products for supplier
3. `spGetAllergenenByProduct(productId)` - Get allergens for product
4. `spGetLeverancierById(leverancierId)` - Get single supplier
5. `spGetProductById(productId)` - Get single product

### System Fields (Verplicht in Alle Tabellen)
```sql
IsActief           TINYINT(1)   DEFAULT 1
Opmerking          VARCHAR(255) NULL
DatumAangemaakt    DATETIME(6)  DEFAULT CURRENT_TIMESTAMP(6)
DatumGewijzigd     DATETIME(6)  DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
```

---

## 📁 Project Structuur

```
database/
  migrations/
    2025_12_14_195923_create_leveranciers_table.php
    2025_12_14_195924_create_products_table.php
    2025_12_14_195925_create_allergenen_table.php
    2025_12_14_195926_create_magazijns_table.php
    2025_12_14_195926_create_product_per_leveranciers_table.php
    2025_12_14_195927_create_product_per_allergenen_table.php
    2025_12_14_200946_install_us01_stored_procedures.php
  seeders/
    JaminDataSeeder.php
  stored-procedures/
    jamin_us01_procedures.sql
  exports/
    create_jamin_tables.sql

app/Http/Controllers/
  LeverancierController.php

resources/views/leveranciers/
  index.blade.php   # Wireframe-01: Supplier overview
  show.blade.php    # Wireframe-02/03: Products per supplier

routes/
  web.php

vids/
  README.md
```

---

## 🚀 Installatie & Setup

### 1. Clone Repository
```bash
git clone https://github.com/AndreiGwn/registratieSysteemBreeze.git
cd Breezedemo
git checkout dev-opdracht-2-us01
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=breezedemo
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed --seeder=JaminDataSeeder
```

This will:
- Create 6 database tables with system fields
- Install 5 stored procedures
- Seed all specification data including:
  - 5 suppliers (Venco, Astra Sweets, Haribo, Basset, De Bron)
  - 13 products (including inactive Winegums)
  - 5 allergen types
  - Stock information
  - Delivery history

### 6. Start Development Server
```bash
php artisan serve
npm run dev
```

### 7. Access Application
- URL: http://localhost:8000
- Register/Login as user
- Navigate to "Overzicht Leveranciers" from dashboard

---

## 🧪 Testing Scenarios

### Test 1: Leveranciers Overzicht (Wireframe-01)
1. Login to application
2. Click "Overzicht Leveranciers" on dashboard
3. **Verify:** Table shows 5 suppliers
4. **Verify:** Columns: Naam, Contactpersoon, LeverancierNummer, Mobiel, Aantal Producten
5. **Verify:** Product counts are correct:
   - Venco: 3 producten
   - Astra Sweets: 3 producten
   - Haribo: 3 producten
   - Basset: 0 producten
   - De Bron: 2 producten

### Test 2: Producten Weergave (Wireframe-02)
1. Click "Bekijk Producten" for Venco
2. **Verify:** Shows supplier info (Naam, Contactpersoon, etc.)
3. **Verify:** Shows 3 products: Mintnopjes, Schoolkrijt, Honingdrop
4. **Verify:** Each product shows barcode
5. **Verify:** Mintnopjes shows 3 allergens (Gluten, Gelatine, AZO-Kleurstof)
6. **Verify:** Products without allergens show "Geen allergenen"

### Test 3: Inactive Product (Product 10)
1. Navigate to products (need to add Product 10 to a supplier delivery first)
2. **Verify:** Winegums shows "Niet Actief" badge
3. **Verify:** Background is greyed out

### Test 4: Geen Producten (Wireframe-03)
1. Click "Bekijk Producten" for Basset
2. **Verify:** Yellow warning box appears
3. **Verify:** Message: "Deze leverancier heeft op dit moment geen producten"

---

## 🔍 Code Quality Checklist

### Database Access (VERPLICHT)
- ✅ NO Eloquent ORM queries (no `Model::find()`, `Model::where()`, etc.)
- ✅ ALL data access via stored procedures
- ✅ PDO usage: `DB::select('CALL spProcedureName(?)', [$param])`

### Example - LeverancierController.php:
```php
// ✅ CORRECT - Uses stored procedure
$leveranciers = DB::select('CALL spGetLeveranciersWithProductCount()');

// ❌ WRONG - Would violate assignment requirements
// $leveranciers = Leverancier::with('products')->get();
```

### System Fields
- ✅ All 6 tables have IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd
- ✅ IsActief defaults to TRUE
- ✅ DatumAangemaakt auto-set on insert
- ✅ DatumGewijzigd auto-updates on record change

### Seed Data
- ✅ Product 10 (Winegums) has IsActief = false
- ✅ All specification data matches assignment document
- ✅ Basset supplier has no products (for Scenario 02 test)

---

## 📊 Database ERD

```
leveranciers (1) ----< (N) product_per_leveranciers
                                    |
                                    | (N)
                                    |
                                    v (1)
                              products (1) ----< (N) product_per_allergenen
                                    |                      |
                                    |                      | (N)
                                    v (1)                  v (1)
                              magazijns              allergenen
```

---

## 📹 Video Demonstraties

Zie `vids/README.md` voor instructies.

**Required videos:**
1. `us01_scenario01_wireframe01.mp4` - Supplier overview
2. `us01_scenario01_wireframe02.mp4` - Products with allergens
3. `us01_scenario02_wireframe03.mp4` - No products message

---

## 🎨 Wireframes Implementatie

### Wireframe-01: Leveranciers Overzicht
**Locatie:** `resources/views/leveranciers/index.blade.php`  
**Route:** `/leveranciers`  
**Controller:** `LeverancierController@index`  
**Stored Procedure:** `spGetLeveranciersWithProductCount()`

**Features:**
- Tabel met alle leveranciers
- Product count per leverancier
- "Bekijk Producten" link

### Wireframe-02: Producten per Leverancier
**Locatie:** `resources/views/leveranciers/show.blade.php`  
**Route:** `/leveranciers/{id}`  
**Controller:** `LeverancierController@show`  
**Stored Procedures:**
- `spGetLeverancierById(id)`
- `spGetProductenByLeverancier(id)`
- `spGetAllergenenByProduct(id)` (per product)

**Features:**
- Leverancier informatie
- Product lijst met barcode
- Status badge (Actief/Niet Actief)
- Allergenen warnings per product
- "Geen allergenen" message

### Wireframe-03: Geen Producten
**Locatie:** `resources/views/leveranciers/show.blade.php` (same view, conditional)  
**Route:** `/leveranciers/{id}`  
**Controller:** `LeverancierController@show`

**Features:**
- Yellow warning box
- Clear message
- Leverancier info still visible

---

## 🌳 Git Workflow

### Branch Structuur
```
main
  └── dev-opdracht-2-us01 (THIS BRANCH - US01 only)
```

### Commits (Minimum 10)
1. feat(us01): Add database tables with system fields and seeders
2. feat(us01): Add database export scripts
3. feat(us01): Add video documentation structure
4. feat(us01): Add project documentation (README)
5. (Continue with granular commits...)

### Next Step
After US01 is complete and merged:
```bash
git checkout main
git checkout -b dev-opdracht-2-us02
# Implement US02: Add delivery functionality
```

---

## 📝 Assignment Requirements Compliance

| Requirement | Status | Notes |
|------------|--------|-------|
| MVC Framework | ✅ | Laravel 12 |
| OOP | ✅ | Controllers, structured code |
| Stored Procedures | ✅ | 5 procedures for US01 |
| PDO | ✅ | DB::select() used |
| System Fields | ✅ | All 4 fields in all 6 tables |
| Migrations | ✅ | 7 migrations (6 tables + procedures) |
| Seeder | ✅ | JaminDataSeeder with all data |
| Wireframe-01 | ✅ | index.blade.php |
| Wireframe-02 | ✅ | show.blade.php (with products) |
| Wireframe-03 | ✅ | show.blade.php (no products) |
| Video's | 📹 | Directory + instructions ready |
| Database Export | ✅ | create_jamin_tables.sql |
| Separate Branch | ✅ | dev-opdracht-2-us01 |
| Min 10 Commits | 🔄 | In progress |

---

## 🐛 Known Issues & Limitations

### US01 Scope
This branch implements ONLY User Story 01:
- ✅ View suppliers
- ✅ View products per supplier
- ✅ View allergens per product
- ❌ NO add delivery functionality (that's US02 on different branch)

### Product 10 Visibility
Product 10 (Winegums) is inactive but can still be viewed. Consider:
- Should inactive products be hidden from lists?
- Current: Shows with "Niet Actief" badge

### Basset No Products
Basset supplier intentionally has no products to test Scenario 02.

---

## 👨‍💻 Development Notes

### PDO Requirement
The assignment REQUIRES stored procedures + PDO. Do NOT use Eloquent for data retrieval:

```php
// ❌ WRONG - Violates assignment
$products = Product::where('leverancier_id', $id)->get();

// ✅ CORRECT - Meets requirements
$products = DB::select('CALL spGetProductenByLeverancier(?)', [$id]);
```

### System Fields
All system fields are managed automatically by MySQL:
- `DatumAangemaakt`: Set on INSERT
- `DatumGewijzigd`: Updated on every UPDATE
- `IsActief`: Defaults to 1 (true)
- `Opmerking`: Nullable text field

---

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs/12.x)
- [MySQL Stored Procedures](https://dev.mysql.com/doc/refman/8.0/en/stored-programs.html)
- [Laravel PDO](https://laravel.com/docs/12.x/database#running-queries)
- [Tailwind CSS](https://tailwindcss.com/docs)

---

## 📧 Contact

**Student:** Andre  
**Repository:** https://github.com/AndreiGwn/registratieSysteemBreeze  
**Branch:** dev-opdracht-2-us01

---

*Last updated: December 14, 2025*
