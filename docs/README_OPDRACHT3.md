# Opdracht 3: Wijzigen Leverancier - Setup Instructies

## Overzicht
Deze feature implementeert User Story 01: "Als manager wil ik leveranciergegevens kunnen wijzigen zodat ik alle leveranciergegevens up-to-date kan houden."

## Belangrijke Bestanden

### Database
- `database/opdracht3_jamin_tables.sql` - Create script voor alle 7 tabellen met testdata
- `database/stored-procedures/leverancier_procedures.sql` - Stored procedures voor CRUD operaties

### Controllers & Models
- `app/Http/Controllers/LeverancierController.php` - Controller voor leverancier management
- `app/Models/Leverancier.php` - Leverancier model
- `app/Models/Contact.php` - Contact model
- `app/Models/Product.php` - Product model
- `app/Models/Allergeen.php` - Allergeen model
- `app/Models/Magazijn.php` - Magazijn model

### Views (Wireframes)
- `resources/views/Manager/leveranciers/index.blade.php` - Wireframe-02: Overzicht leveranciers
- `resources/views/Manager/leveranciers/show.blade.php` - Wireframe-03: Leverancier details
- `resources/views/Manager/leveranciers/edit.blade.php` - Wireframe-04: Wijzig leveranciergegevens
- `resources/views/dashboard.blade.php` - Wireframe-01: Homepage met link

### Tests
- `tests/Unit/LeverancierTest.php` - 2 Unit tests voor Leverancier model

### Documentatie
- `docs/Testplan.md` - Volledig testplan
- `docs/Testrapport.md` - Template voor testrapport (in te vullen)
- `docs/DatabaseSpecificatieTabel.md` - Specificatie van alle tabellen

## Setup Instructies

### Stap 1: Database Aanmaken

```sql
-- 1. Maak database aan (indien nog niet gedaan)
CREATE DATABASE IF NOT EXISTS jamin_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jamin_db;

-- 2. Run het create script
SOURCE database/opdracht3_jamin_tables.sql;

-- 3. Run de stored procedures
SOURCE database/stored-procedures/leverancier_procedures.sql;

-- 4. Verificatie: Check of alles correct is aangemaakt
SHOW TABLES;
SHOW PROCEDURE STATUS WHERE Db = 'jamin_db';
SELECT * FROM Leverancier;
```

### Stap 2: Database Configuratie in Laravel

Update `.env` bestand:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jamin_db
DB_USERNAME=root
DB_PASSWORD=
```

### Stap 3: Manager Gebruiker Aanmaken

Je hebt een gebruiker nodig met role `manager`. Als je die nog niet hebt:

```sql
-- Voeg een manager toe aan de users tabel
INSERT INTO users (name, email, email_verified_at, password, rolename, created_at, updated_at)
VALUES ('Manager Test', 'manager@jamin.nl', NOW(), '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5NANs/0sSzwP6', 'manager', NOW(), NOW());
-- Password is: password
```

### Stap 4: Applicatie Starten

```bash
# Installeer dependencies (indien nodig)
composer install
npm install

# Run migrations (voor de bestaande users tabel e.d.)
php artisan migrate

# Start de development server
php artisan serve

# In een aparte terminal: start Vite
npm run dev
```

### Stap 5: Testen

1. **Login als Manager**
   - Email: manager@jamin.nl
   - Password: password

2. **Navigeer naar Dashboard**
   - Je ziet nu een sectie "Manager Menu" met de knop "Wijzigen Leveranciers"

3. **Test Scenario 01 (Succesvol)**
   - Klik op "Wijzigen Leveranciers"
   - Zie 6 leveranciers met pagination (4 per pagina)
   - Klik op pen-icoon bij "Astra Sweets" (2e leverancier)
   - Klik op "Wijzig" button
   - Verander Mobiel naar: `06-39398825`
   - Verander Straatnaam naar: `Den Dolderlaan`
   - Klik "Sla Op"
   - Zie groene succesmelding: "De wijzigingen zijn doorgevoerd"
   - Na 3 seconden wordt je doorgestuurd naar details pagina
   - Controleer dat wijzigingen zichtbaar zijn

4. **Test Scenario 02 (Mislukt)**
   - Ga terug naar overzicht leveranciers
   - Klik op pen-icoon bij "De Bron" (5e leverancier)
   - Klik op "Wijzig" button
   - Verander Mobiel naar: `06-39398825`
   - Klik "Sla Op"
   - Zie rode foutmelding: "Door een technische storing is het niet mogelijk de wijziging door te voeren..."
   - Na 3 seconden wordt je doorgestuurd naar details pagina
   - Controleer dat oude waarden nog steeds zichtbaar zijn (geen wijzigingen)

### Stap 6: Unit Tests Draaien

```bash
# Run de Leverancier unit tests
php artisan test --filter=LeverancierTest

# Verwacht output:
# PASS  Tests\Unit\LeverancierTest
# ✓ leverancier can be created with contact
# ✓ leverancier contact relationship
```

## Features Checklist

- ✅ 7 Tabellen aangemaakt met systeem velden (IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
- ✅ Foreign key relaties tussen tabellen
- ✅ Test data ingeladen (6 leveranciers, 13 producten, 5 allergenen, etc.)
- ✅ 5 Stored procedures voor CRUD operaties
- ✅ LeverancierController met index, show, edit, update methods
- ✅ Server-side pagination (max 4 records per pagina)
- ✅ Scenario 01: Succesvol wijzigen Astra Sweets
- ✅ Scenario 02: Mislukte wijziging De Bron
- ✅ 3 seconden redirect met melding
- ✅ Link op Manager homepage naar "Wijzigen Leveranciers"
- ✅ 2 Unit tests
- ✅ Testplan document
- ✅ Testrapport template
- ✅ Database specificatie tabel

## Video Maken (60 seconden max)

### Wat te laten zien:

**Deel 1: Database (10 sec)**
1. Open MySQL Workbench
2. Laat zien: SHOW TABLES; (7 tabellen)
3. Laat zien: SELECT * FROM Leverancier; (6 leveranciers)

**Deel 2: Scenario 01 - Succesvol (25 sec)**
1. Login als manager
2. Klik "Wijzigen Leveranciers"
3. Laat pagination zien (pagina 1: 4 records, pagina 2: 2 records)
4. Klik pen-icoon "Astra Sweets"
5. Klik "Wijzig"
6. Verander Mobiel en Straatnaam
7. Klik "Sla Op"
8. Laat groene succesmelding zien
9. Laat gewijzigde gegevens op details pagina zien

**Deel 3: Scenario 02 - Mislukt (20 sec)**
1. Ga terug naar overzicht
2. Klik pen-icoon "De Bron"
3. Klik "Wijzig"
4. Verander Mobiel
5. Klik "Sla Op"
6. Laat rode foutmelding zien
7. Laat zien dat oude gegevens ongewijzigd zijn

**Deel 4: Database verificatie (5 sec)**
1. Ga terug naar MySQL Workbench
2. SELECT * FROM Leverancier WHERE Id = 2; (laat gewijzigde data zien)
3. SELECT * FROM Leverancier WHERE Id = 5; (laat ongewijzigde data zien)

### Video opnemen:
1. Druk op Windows + G
2. Klik op opname knop
3. Voer bovenstaande stappen uit
4. Stop opname
5. Sla op als `leverancier_demo.mp4` in de `vids/` folder

## Commit Strategie

We hebben al 1 commit gedaan. Maak nu regelmatig commits tijdens verder werken:

```bash
# Bijvoorbeeld:
git add .
git commit -m "Add unit tests for Leverancier model"

git add docs/
git commit -m "Add documentation: testplan, testrapport, database specs"

git add vids/
git commit -m "Add demo video"

# etc... tot minimaal 10 commits
```

## Troubleshooting

### Probleem: Stored procedures geven errors
**Oplossing:** Zorg dat je de delimiter correct hebt ingesteld. Run het script regel voor regel in MySQL Workbench.

### Probleem: Pagination werkt niet
**Oplossing:** Check of er minimaal 5 leveranciers in de database zitten. Run de insert statements opnieuw.

### Probleem: Redirects werken niet na 3 seconden
**Oplossing:** Check of JavaScript enabled is in je browser. Inspect de console voor errors.

### Probleem: Unit tests falen
**Oplossing:** Run `php artisan config:clear` en `php artisan test --filter=LeverancierTest` opnieuw.

### Probleem: "De Bron" wordt wel gewijzigd
**Oplossing:** Check of de stored procedure `spUpdateLeverancier` correct is aangemaakt. De IF statement moet checken op `p_leverancier_id = 5`.

## Contact

Voor vragen: [Je naam en contactgegevens]

## Licentie

Dit project is gemaakt voor educatieve doeleinden - MBO Utrecht BE-S2-P2
