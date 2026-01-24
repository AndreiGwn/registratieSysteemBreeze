# Testplan - Opdracht 3: Wijzigen Leverancier
**Project:** Jamin Leveranciers Management  
**Datum:** 24 januari 2026  
**Versie:** 1.0  
**Auteur:** [Studentnaam]  

---

## 1. Inleiding

Dit testplan beschrijft de teststrategie voor User Story 01: "Wijzigen leverancier". Het doel is om te verifiëren dat alle functionaliteiten volgens de specificaties werken.

---

## 2. Test Scope

### In Scope:
- Scenario 01: Succesvol wijzigen van leveranciergegevens (Astra Sweets)
- Scenario 02: Mislukte wijziging door technische storing (De Bron)
- Pagination op overzichtspagina (max 4 records)
- Navigatie tussen verschillende pagina's
- Validatie van invoervelden

### Out of Scope:
- Performance testing
- Security testing
- Browser compatibility (alleen Chrome wordt getest)

---

## 3. Test Items

| Test ID | Beschrijving | Scenario | Prioriteit |
|---------|--------------|----------|------------|
| TC-01 | Navigatie naar overzicht leveranciers | N/A | Hoog |
| TC-02 | Weergave van alle leveranciers met pagination | N/A | Hoog |
| TC-03 | Klik op pen-icoon naar details pagina | N/A | Hoog |
| TC-04 | Weergave leverancier details | N/A | Hoog |
| TC-05 | Navigatie naar wijzig pagina | N/A | Hoog |
| TC-06 | Succesvol wijzigen Astra Sweets | Scenario 01 | Hoog |
| TC-07 | Mislukte wijziging De Bron | Scenario 02 | Hoog |
| TC-08 | Validatie verplichte velden | N/A | Gemiddeld |
| TC-09 | Pagination functionaliteit | N/A | Hoog |
| TC-10 | Redirects na 3 seconden | Scenario 01 & 02 | Hoog |

---

## 4. Testomgeving

**Hardware:**
- Computer met minimaal 8GB RAM
- Stabiele internetverbinding

**Software:**
- Windows 11
- Chrome Browser (laatste versie)
- PHP 8.2+
- MySQL 8.0+
- Laravel 11.x
- XAMPP / Laragon

**Database:**
- Database: jamin_db
- Tabellen: Leverancier, Contact, Product, Magazijn, ProductPerLeverancier, ProductPerAllergeen, Allergeen
- Test data: Volgens opgave ingeladen

---

## 5. Test Data

### Leveranciers Test Data:
1. **Venco** - Id: 1
2. **Astra Sweets** - Id: 2 (Voor Scenario 01 - Succesvol)
3. **Haribo** - Id: 3
4. **Basset** - Id: 4
5. **De Bron** - Id: 5 (Voor Scenario 02 - Foutscenario)
6. **Quality Street** - Id: 6

### Test Input Scenario 01 (Astra Sweets):
- **Mobiel:** 06-39398825 (nieuw)
- **Straatnaam:** Den Dolderlaan (nieuw)

### Test Input Scenario 02 (De Bron):
- **Mobiel:** 06-39398825 (nieuw)

---

## 6. Test Cases

### TC-01: Navigatie naar overzicht leveranciers

**Voorwaarden:**
- Gebruiker is ingelogd als Manager

**Stappen:**
1. Log in met manager account
2. Ga naar dashboard
3. Klik op "Wijzigen Leveranciers"

**Verwacht Resultaat:**
- Gebruiker komt op de overzichtspagina van leveranciers
- URL is: /leveranciers

---

### TC-02: Weergave van alle leveranciers met pagination

**Voorwaarden:**
- Gebruiker is op /leveranciers

**Stappen:**
1. Bekijk de lijst met leveranciers

**Verwacht Resultaat:**
- Maximaal 4 leveranciers worden getoond
- Kolommen zichtbaar: Naam, Contactpersoon, Leveranciernummer, Mobiel, Leverancier Details
- Pagination controls zijn zichtbaar (als meer dan 4 records)
- Pen-icoon is zichtbaar in laatste kolom

---

### TC-03: Klik op pen-icoon naar details pagina

**Voorwaarden:**
- Gebruiker is op /leveranciers

**Stappen:**
1. Klik op pen-icoon van "Astra Sweets"

**Verwacht Resultaat:**
- Gebruiker komt op details pagina van Astra Sweets
- URL is: /leveranciers/2
- Alle gegevens van Astra Sweets worden getoond

---

### TC-04: Weergave leverancier details

**Voorwaarden:**
- Gebruiker is op /leveranciers/2

**Stappen:**
1. Bekijk de details

**Verwacht Resultaat:**
- Alle velden worden correct getoond:
  - Naam: Astra Sweets
  - Contactpersoon: Jasper del Monte
  - Leveranciernummer: L1029284315
  - Mobiel: 06-39398734
  - Straatnaam: Den Dolderpad
  - Huisnummer: 2
  - Postcode: 1067RC
  - Stad: Utrecht
- Buttons "Wijzig", "Terug", "Home" zijn zichtbaar

---

### TC-05: Navigatie naar wijzig pagina

**Voorwaarden:**
- Gebruiker is op /leveranciers/2

**Stappen:**
1. Klik op "Wijzig" button

**Verwacht Resultaat:**
- Gebruiker komt op wijzig pagina
- URL is: /leveranciers/2/edit
- Alle velden zijn gevuld met huidige waarden
- Velden zijn bewerkbaar

---

### TC-06: Succesvol wijzigen Astra Sweets (Scenario 01)

**Voorwaarden:**
- Gebruiker is op /leveranciers/2/edit

**Stappen:**
1. Wijzig "Mobiel" naar: 06-39398825
2. Wijzig "Straatnaam" naar: Den Dolderlaan
3. Klik op "Sla Op"

**Verwacht Resultaat:**
- Melding wordt getoond: "De wijzigingen zijn doorgevoerd"
- Melding heeft groene achtergrond
- Na 3 seconden redirect naar /leveranciers/2
- Op details pagina zijn de wijzigingen zichtbaar:
  - Mobiel: 06-39398825
  - Straatnaam: Den Dolderlaan

---

### TC-07: Mislukte wijziging De Bron (Scenario 02)

**Voorwaarden:**
- Gebruiker is op /leveranciers overzichtspagina

**Stappen:**
1. Klik op pen-icoon van "De Bron"
2. Klik op "Wijzig"
3. Wijzig "Mobiel" naar: 06-39398825
4. Klik op "Sla Op"

**Verwacht Resultaat:**
- Foutmelding wordt getoond: "Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens"
- Melding heeft rode achtergrond
- Na 3 seconden redirect naar /leveranciers/5
- Op details pagina zijn de wijzigingen NIET zichtbaar (oude waarden blijven staan)

---

### TC-08: Validatie verplichte velden

**Voorwaarden:**
- Gebruiker is op /leveranciers/2/edit

**Stappen:**
1. Maak veld "Naam" leeg
2. Klik op "Sla Op"

**Verwacht Resultaat:**
- Validatiefout wordt getoond
- Formulier wordt niet verzonden
- Gebruiker blijft op edit pagina

---

### TC-09: Pagination functionaliteit

**Voorwaarden:**
- Database heeft 6 leveranciers
- Gebruiker is op /leveranciers

**Stappen:**
1. Bekijk pagina 1
2. Klik op "Volgende" of pagina 2
3. Bekijk pagina 2

**Verwacht Resultaat:**
- Pagina 1 toont leveranciers 1-4
- Pagina 2 toont leveranciers 5-6
- Pagination controls werken correct
- Huidige pagina is gemarkeerd

---

### TC-10: Redirects na 3 seconden

**Voorwaarden:**
- Wijziging is uitgevoerd (succes of fout)

**Stappen:**
1. Wacht 3 seconden na melding

**Verwacht Resultaat:**
- Na 3 seconden wordt gebruiker automatisch doorgestuurd
- Redirect gaat naar de details pagina van de betreffende leverancier

---

## 7. Entry & Exit Criteria

### Entry Criteria:
- Database is aangemaakt met alle tabellen
- Stored procedures zijn aangemaakt
- Test data is ingeladen
- Applicatie draait lokaal
- Manager gebruiker is aangemaakt

### Exit Criteria:
- Alle test cases zijn uitgevoerd
- Alle high priority test cases zijn geslaagd
- Testrapport is ingevuld

---

## 8. Test Deliverables

1. Testplan (dit document)
2. Testrapport met resultaten
3. Video van werkende applicatie (max 60 sec)
4. Screenshots van test uitvoeringen

---

## 9. Risico's

| Risico | Impact | Waarschijnlijkheid | Mitigatie |
|--------|--------|-------------------|-----------|
| Database niet correct ingeladen | Hoog | Laag | Script dubbel checken |
| Stored procedures werken niet | Hoog | Gemiddeld | Procedures handmatig testen |
| Pagination werkt niet correct | Gemiddeld | Laag | Query's testen in MySQL |
| Redirects werken niet | Laag | Laag | JavaScript testen in browser |

---

## 10. Goedkeuring

**Tester:** _____________________  
**Datum:** _____________________  
**Handtekening:** _____________________
