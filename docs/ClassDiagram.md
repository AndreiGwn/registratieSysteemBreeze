# Class Diagram - Jamin Leveranciers Management

```mermaid
classDiagram
    class LeverancierController {
        +index(Request) : View
        +show(int id) : View
        +edit(int id) : View
        +update(Request, int id) : RedirectResponse
    }
    
    class Leverancier {
        +int Id
        +string Naam
        +string ContactPersoon
        +string LeverancierNummer
        +string Mobiel
        +int ContactId
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
        +contact() : BelongsTo
        +producten() : BelongsToMany
    }
    
    class Contact {
        +int Id
        +string Straat
        +string Huisnummer
        +string Postcode
        +string Stad
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
        +leverancier() : HasOne
    }
    
    class Product {
        +int Id
        +string Naam
        +string Barcode
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
        +leveranciers() : BelongsToMany
        +allergenen() : BelongsToMany
        +magazijn() : HasOne
    }
    
    class Allergeen {
        +int Id
        +string Naam
        +string Omschrijving
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
        +producten() : BelongsToMany
    }
    
    class Magazijn {
        +int Id
        +int ProductId
        +decimal VerpakkingsEenheid
        +int AantalAanwezig
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
        +product() : BelongsTo
    }
    
    class ProductPerLeverancier {
        +int Id
        +int LeverancierId
        +int ProductId
        +date DatumLevering
        +int Aantal
        +date DatumEerstVolgendeLevering
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
    }
    
    class ProductPerAllergeen {
        +int Id
        +int ProductId
        +int AllergeenId
        +bit IsActief
        +string Opmerking
        +DateTime DatumAangemaakt
        +DateTime DatumGewijzigd
    }
    
    LeverancierController --> Leverancier : uses
    LeverancierController --> Contact : uses
    Leverancier "1" -- "1" Contact : has
    Leverancier "1" -- "0..*" ProductPerLeverancier : delivers
    Product "1" -- "0..*" ProductPerLeverancier : supplied by
    Product "1" -- "1" Magazijn : stored in
    Product "1" -- "0..*" ProductPerAllergeen : contains
    Allergeen "1" -- "0..*" ProductPerAllergeen : found in
```

## Beschrijving van Classes

### LeverancierController
**Verantwoordelijkheid:** Afhandelen van HTTP requests voor leverancier management

**Belangrijkste methoden:**
- `index()`: Toont overzicht van leveranciers met pagination (max 4 records)
- `show()`: Toont details van specifieke leverancier
- `edit()`: Toont formulier voor wijzigen leverancier
- `update()`: Verwerkt wijzigingen en roept stored procedure aan

**Design Patterns:**
- MVC (Model-View-Controller)
- Dependency Injection (via Laravel's service container)

### Model Classes
Alle model classes erven van `Illuminate\Database\Eloquent\Model` en implementeren:
- Active Record pattern voor database interacties
- Relationships (BelongsTo, HasOne, BelongsToMany)
- Mass assignment protection via `$fillable`
- Timestamps beheer via custom fields

### Relaties

**1:1 Relaties:**
- Leverancier heeft één Contact
- Product heeft één Magazijn record

**1:N Relaties:**
- Product heeft meerdere Magazijn entries (historisch)
- Contact kan bij meerdere leveranciers horen (in theorie)

**N:M Relaties:**
- Leverancier levert meerdere Producten (via ProductPerLeverancier)
- Product bevat meerdere Allergenen (via ProductPerAllergeen)

## Stored Procedures (Database Layer)

```
spGetAllLeveranciers(limit, offset) → ResultSet
spCountLeveranciers() → int
spGetLeverancierById(id) → Leverancier
spUpdateLeverancier(params...) → OUT int result
spGetProductsByLeverancier(id) → ResultSet
```

## Sequence Diagram - Update Scenario

```mermaid
sequenceDiagram
    participant User
    participant Browser
    participant Controller as LeverancierController
    participant DB as Database
    participant SP as Stored Procedure
    
    User->>Browser: Klik "Sla Op"
    Browser->>Controller: PUT /leveranciers/{id}
    Controller->>Controller: Validate Input
    Controller->>SP: CALL spUpdateLeverancier(params)
    
    alt Leverancier Id = 5 (De Bron)
        SP->>SP: Check Id = 5
        SP->>SP: SET result = 0
        SP->>SP: ROLLBACK
        SP-->>Controller: result = 0
        Controller-->>Browser: redirect with error
        Browser-->>User: Rode melding + redirect na 3s
    else Other Leverancier (e.g., Astra Sweets)
        SP->>DB: UPDATE Contact
        SP->>DB: UPDATE Leverancier
        SP->>SP: SET result = 1
        SP->>SP: COMMIT
        SP-->>Controller: result = 1
        Controller-->>Browser: redirect with success
        Browser-->>User: Groene melding + redirect na 3s
    end
```

## Class Responsibilities

| Class | Verantwoordelijkheid | Layer |
|-------|---------------------|-------|
| LeverancierController | HTTP request handling, routing, view rendering | Presentation |
| Leverancier Model | Data representation, business logic, relationships | Domain |
| Contact Model | Address data management | Domain |
| Product Model | Product data management | Domain |
| Allergeen Model | Allergen information | Domain |
| Magazijn Model | Inventory tracking | Domain |
| Stored Procedures | Data persistence, transaction management, business rules | Data Access |

## SOLID Principles Applied

**Single Responsibility Principle (SRP):**
- Elke model class heeft één verantwoordelijkheid
- Controller heeft alleen routing verantwoordelijkheid
- Stored procedures isoleren database logic

**Open/Closed Principle (OCP):**
- Models zijn open voor extensie via Eloquent relationships
- Gesloten voor modificatie door gebruik van protected properties

**Liskov Substitution Principle (LSP):**
- Alle models kunnen worden vervangen door hun parent Model class
- Interface consistency via Eloquent

**Interface Segregation Principle (ISP):**
- Models implementeren alleen de methods die ze nodig hebben
- Geen forced implementation van ongebruikte methods

**Dependency Inversion Principle (DIP):**
- Controller depends op abstractions (Eloquent Model) niet op concrete implementations
- Database access via Laravel's Query Builder/PDO abstraction

## Testing Strategy

**Unit Tests:**
- Test model creation
- Test model relationships
- Test data validation

**Integration Tests:**
- Test stored procedure calls
- Test transaction rollbacks
- Test pagination logic

**Feature Tests:**
- Test complete user flows
- Test scenario 01 (success)
- Test scenario 02 (failure)
