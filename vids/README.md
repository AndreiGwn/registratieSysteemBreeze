# Jamin Magazijnbeheer - Video Demonstraties

## User Story 01: Overzicht Leveranciers en Producten

### Video 1: Leveranciers Overzicht (Scenario 01 - Wireframe-01)
**Bestand:** `us01_scenario01_wireframe01.mp4`

**Demonstratie:**
1. Login als magazijnmedewerker
2. Navigeer naar "Overzicht Leveranciers"
3. Toon tabel met:
   - Naam leverancier
   - Contactpersoon
   - Leverancier nummer
   - Mobiel nummer
   - Aantal producten
4. Klik op "Bekijk Producten" voor een leverancier

---

### Video 2: Producten per Leverancier (Scenario 01 - Wireframe-02)
**Bestand:** `us01_scenario01_wireframe02.mp4`

**Demonstratie:**
1. Vanaf leveranciers overzicht
2. Selecteer leverancier met producten (bijv. Venco, Astra Sweets, Haribo)
3. Toon product lijst met:
   - Product naam
   - Barcode
   - Status (Actief/Niet Actief)
   - Allergenen per product
4. Demonstreer inactive product (Winegums) met rode badge
5. Terug naar overzicht

---

### Video 3: Geen Producten Bericht (Scenario 02 - Wireframe-03)
**Bestand:** `us01_scenario02_wireframe03.mp4`

**Demonstratie:**
1. Navigeer naar leverancier ZONDER producten (Basset heeft geen producten in seed data)
2. Toon gele waarschuwing: "Deze leverancier heeft op dit moment geen producten"
3. Verifieer dat UI duidelijk aangeeft: geen data beschikbaar

---

## Technische Vereisten Getoond in Video's

### Database Access
- ✅ Stored Procedures gebruikt (GEEN Eloquent ORM)
- ✅ PDO via `DB::select('CALL spProcedureName(?)')`
- ✅ System fields aanwezig in alle tabellen

### Stored Procedures Gebruikt
1. `spGetLeveranciersWithProductCount()` - Leveranciers overzicht
2. `spGetLeverancierById(leverancierId)` - Leverancier details
3. `spGetProductenByLeverancier(leverancierId)` - Producten per leverancier
4. `spGetAllergenenByProduct(productId)` - Allergenen per product

---

## Opname Instructies

### Setup
1. Start WAMP server
2. Verifieer database is gevuld met seed data
3. Login credentials klaar
4. Browser scherm opname software gereed

### Scenario's
- Scenario 01: Leverancier MET producten
- Scenario 02: Leverancier ZONDER producten
- Toon inactive producten (Winegums)
- Toon allergenen badges

### Belangrijke Punten
- Laat URL balk zien (routes)
- Toon database queries in terminal/log (bewijs PDO)
- Highlight system fields in database viewer
- Demonstreer responsieve design

---

## Bestandslocaties
Plaats video bestanden in deze directory:
- `us01_scenario01_wireframe01.mp4`
- `us01_scenario01_wireframe02.mp4`
- `us01_scenario02_wireframe03.mp4`

**Aanbevolen tools:**
- OBS Studio (gratis screen recording)
- ShareX (screenshot + video)
- Windows Game Bar (Win + G)
