<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Leverancier;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeverancierTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Test that a Leverancier model can be created successfully
     * 
     * @return void
     */
    public function test_leverancier_can_be_created_with_contact()
    {
        // Arrange: Create a contact first
        $contact = Contact::create([
            'Straat' => 'Teststraat',
            'Huisnummer' => '123',
            'Postcode' => '1234AB',
            'Stad' => 'Teststad',
            'IsActief' => 1,
        ]);

        // Act: Create a leverancier
        $leverancier = Leverancier::create([
            'Naam' => 'Test Leverancier',
            'ContactPersoon' => 'Jan de Tester',
            'LeverancierNummer' => 'L1234567890',
            'Mobiel' => '06-12345678',
            'ContactId' => $contact->Id,
            'IsActief' => 1,
        ]);

        // Assert: Check that the leverancier was created
        $this->assertInstanceOf(Leverancier::class, $leverancier);
        $this->assertEquals('Test Leverancier', $leverancier->Naam);
        $this->assertEquals('Jan de Tester', $leverancier->ContactPersoon);
        $this->assertEquals('L1234567890', $leverancier->LeverancierNummer);
        $this->assertEquals('06-12345678', $leverancier->Mobiel);
        $this->assertEquals($contact->Id, $leverancier->ContactId);
        $this->assertTrue($leverancier->IsActief);
    }

    /**
     * Test 2: Test that the leverancier relationship with contact works correctly
     * 
     * @return void
     */
    public function test_leverancier_contact_relationship()
    {
        // Arrange: Create a contact
        $contact = Contact::create([
            'Straat' => 'Relatie Straat',
            'Huisnummer' => '456',
            'Postcode' => '5678CD',
            'Stad' => 'Relatiestad',
            'IsActief' => 1,
        ]);

        // Act: Create a leverancier with the contact
        $leverancier = Leverancier::create([
            'Naam' => 'Relatie Leverancier',
            'ContactPersoon' => 'Piet Relaties',
            'LeverancierNummer' => 'L0987654321',
            'Mobiel' => '06-98765432',
            'ContactId' => $contact->Id,
            'IsActief' => 1,
        ]);

        // Assert: Check that the relationship works
        $this->assertNotNull($leverancier->contact);
        $this->assertInstanceOf(Contact::class, $leverancier->contact);
        $this->assertEquals('Relatie Straat', $leverancier->contact->Straat);
        $this->assertEquals('456', $leverancier->contact->Huisnummer);
        $this->assertEquals('5678CD', $leverancier->contact->Postcode);
        $this->assertEquals('Relatiestad', $leverancier->contact->Stad);
    }
}
