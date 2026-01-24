# Testrapport - Opdracht 3: Wijzigen Leverancier
**Project:** Jamin Leveranciers Management  
**Datum:** 24 januari 2026  
**Versie:** 1.0  
**Tester:** [Studentnaam]  

---

## 1. Executive Summary

Dit testrapport bevat de resultaten van de uitgevoerde tests voor User Story 01: "Wijzigen leverancier". De tests zijn uitgevoerd volgens het testplan versie 1.0.

**Samenvatting:**
- Totaal aantal test cases: 10
- Geslaagd: [IN TE VULLEN NA TESTEN]
- Gefaald: [IN TE VULLEN NA TESTEN]
- Geblokkeerd: [IN TE VULLEN NA TESTEN]

---

## 2. Testomgeving

**Datum uitvoering:** [IN TE VULLEN]  
**Tijd:** [IN TE VULLEN]  
**Browser:** Chrome [VERSIE IN TE VULLEN]  
**Besturingssysteem:** Windows 11  
**Database versie:** MySQL 8.0  
**Laravel versie:** 11.x  

---

## 3. Test Resultaten

### TC-01: Navigatie naar overzicht leveranciers

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Gebruiker komt op /leveranciers pagina |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-02: Weergave van alle leveranciers met pagination

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Max 4 leveranciers met pagination controls |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-03: Klik op pen-icoon naar details pagina

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Navigatie naar /leveranciers/2 |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-04: Weergave leverancier details

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Alle velden van Astra Sweets correct weergegeven |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Details gecontroleerd** | |
| - Naam | ☐ Correct ☐ Incorrect |
| - Contactpersoon | ☐ Correct ☐ Incorrect |
| - Leveranciernummer | ☐ Correct ☐ Incorrect |
| - Mobiel | ☐ Correct ☐ Incorrect |
| - Straatnaam | ☐ Correct ☐ Incorrect |
| - Huisnummer | ☐ Correct ☐ Incorrect |
| - Postcode | ☐ Correct ☐ Incorrect |
| - Stad | ☐ Correct ☐ Incorrect |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-05: Navigatie naar wijzig pagina

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Wijzig pagina met vooringevulde velden |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-06: Succesvol wijzigen Astra Sweets (Scenario 01) ⭐ BELANGRIJK

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Succesmelding en wijzigingen opgeslagen |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Controles** | |
| - Succesmelding getoond | ☐ Ja ☐ Nee |
| - Melding is groen | ☐ Ja ☐ Nee |
| - Tekst correct | ☐ Ja ☐ Nee |
| - Redirect na 3 sec | ☐ Ja ☐ Nee |
| - Mobiel gewijzigd | ☐ Ja ☐ Nee |
| - Straat gewijzigd | ☐ Ja ☐ Nee |
| **Database check** | |
| - Wijzigingen in database | ☐ Ja ☐ Nee |
| - DatumGewijzigd updated | ☐ Ja ☐ Nee |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN VERPLICHT] |

---

### TC-07: Mislukte wijziging De Bron (Scenario 02) ⭐ BELANGRIJK

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Foutmelding en geen wijzigingen opgeslagen |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Controles** | |
| - Foutmelding getoond | ☐ Ja ☐ Nee |
| - Melding is rood | ☐ Ja ☐ Nee |
| - Tekst correct | ☐ Ja ☐ Nee |
| - Redirect na 3 sec | ☐ Ja ☐ Nee |
| - Geen wijzigingen zichtbaar | ☐ Ja ☐ Nee |
| **Database check** | |
| - Geen wijzigingen in database | ☐ Ja ☐ Nee |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN VERPLICHT] |

---

### TC-08: Validatie verplichte velden

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Validatiefout bij lege verplichte velden |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-09: Pagination functionaliteit

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Pagination werkt met max 4 records per pagina |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Controles** | |
| - Pagina 1: 4 records | ☐ Ja ☐ Nee |
| - Pagina 2: 2 records | ☐ Ja ☐ Nee |
| - Navigation buttons werken | ☐ Ja ☐ Nee |
| - Huidige pagina gemarkeerd | ☐ Ja ☐ Nee |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

### TC-10: Redirects na 3 seconden

| Aspect | Resultaat |
|--------|-----------|
| **Status** | ☐ Geslaagd ☐ Gefaald ☐ Geblokkeerd |
| **Uitgevoerd door** | [NAAM] |
| **Datum** | [DATUM] |
| **Verwacht resultaat** | Automatische redirect na 3 seconden |
| **Werkelijk resultaat** | [IN TE VULLEN] |
| **Opmerkingen** | [IN TE VULLEN] |
| **Screenshot** | [BIJVOEGEN INDIEN NODIG] |

---

## 4. Gevonden Defects

| Defect ID | Beschrijving | Severity | Status | Gevonden in TC |
|-----------|--------------|----------|--------|----------------|
| DEF-001 | [BESCHRIJVING] | ☐ Hoog ☐ Gemiddeld ☐ Laag | ☐ Open ☐ Opgelost | TC-XX |
| DEF-002 | [BESCHRIJVING] | ☐ Hoog ☐ Gemiddeld ☐ Laag | ☐ Open ☐ Opgelost | TC-XX |

*Voeg regels toe indien nodig*

---

## 5. Test Coverage

| Component | Coverage | Status |
|-----------|----------|--------|
| Navigatie | [X/X test cases] | ☐ ✓ ☐ ✗ |
| CRUD operaties | [X/X test cases] | ☐ ✓ ☐ ✗ |
| Pagination | [X/X test cases] | ☐ ✓ ☐ ✗ |
| Validatie | [X/X test cases] | ☐ ✓ ☐ ✗ |
| Stored Procedures | [X/X test cases] | ☐ ✓ ☐ ✗ |
| UI/UX | [X/X test cases] | ☐ ✓ ☐ ✗ |

---

## 6. Database Verificatie

### Scenario 01 - Astra Sweets (voor wijziging)
```sql
SELECT * FROM Leverancier WHERE Id = 2;
SELECT * FROM Contact WHERE Id = 2;
```

**Verwacht:**
- Mobiel: 06-39398734
- Straat: Den Dolderpad

**Na wijziging:**
- Mobiel: 06-39398825
- Straat: Den Dolderlaan

**Geverifieerd:** ☐ Ja ☐ Nee

---

### Scenario 02 - De Bron (geen wijziging verwacht)
```sql
SELECT * FROM Leverancier WHERE Id = 5;
SELECT * FROM Contact WHERE Id = 5;
```

**Voor wijziging:**
- Mobiel: 06-34291234

**Na mislukte wijziging:**
- Mobiel: 06-34291234 (ongewijzigd)

**Geverifieerd:** ☐ Ja ☐ Nee

---

## 7. Unit Tests Resultaten

| Test | Resultaat | Output |
|------|-----------|--------|
| LeverancierTest::test_leverancier_can_be_created_with_contact | ☐ Pass ☐ Fail | [IN TE VULLEN] |
| LeverancierTest::test_leverancier_contact_relationship | ☐ Pass ☐ Fail | [IN TE VULLEN] |

**Command gebruikt:**
```bash
php artisan test --filter LeverancierTest
```

---

## 8. Performance Observaties

| Actie | Verwachte tijd | Werkelijke tijd | Status |
|-------|----------------|-----------------|--------|
| Laden overzichtspagina | < 2 sec | [METEN] | ☐ OK ☐ Traag |
| Laden details pagina | < 1 sec | [METEN] | ☐ OK ☐ Traag |
| Opslaan wijzigingen | < 2 sec | [METEN] | ☐ OK ☐ Traag |
| Redirect | 3 sec | [METEN] | ☐ OK ☐ Afwijkend |

---

## 9. Browser Compatibility

| Browser | Versie | Getest | Status | Opmerkingen |
|---------|--------|--------|--------|-------------|
| Chrome | [VERSIE] | ☐ Ja ☐ Nee | ☐ OK ☐ Issues | [OPMERKINGEN] |

---

## 10. Code Quality Checks

| Check | Status | Opmerkingen |
|-------|--------|-------------|
| PSR-12 coding standards | ☐ ✓ ☐ ✗ | [OPMERKINGEN] |
| No syntax errors | ☐ ✓ ☐ ✗ | [OPMERKINGEN] |
| Proper error handling | ☐ ✓ ☐ ✗ | [OPMERKINGEN] |
| SQL injection prevention | ☐ ✓ ☐ ✗ | [OPMERKINGEN] |
| XSS prevention | ☐ ✓ ☐ ✗ | [OPMERKINGEN] |

---

## 11. Aanbevelingen

1. [AANBEVELING 1]
2. [AANBEVELING 2]
3. [AANBEVELING 3]

---

## 12. Conclusie

**Eindoordeel:** ☐ Goedgekeurd ☐ Goedgekeurd met opmerkingen ☐ Afgekeurd

**Motivatie:**
[IN TE VULLEN NA VOLTOOIEN VAN ALLE TESTS]

**Gereed voor productie:** ☐ Ja ☐ Nee

---

## 13. Goedkeuring

**Tester:** _____________________  
**Datum:** _____________________  
**Handtekening:** _____________________

**Docent:** _____________________  
**Datum:** _____________________  
**Handtekening:** _____________________

---

## 14. Bijlagen

1. Video demonstratie (max 60 seconden)
2. Screenshots van test uitvoeringen
3. Database export
4. Git commit history
