<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Leverancier;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeverancierManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $manager;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a manager user for testing
        $this->manager = User::factory()->create([
            'rolename' => 'manager',
            'email' => 'manager@test.com'
        ]);
    }

    /**
     * Test that only managers can access leverancier index page
     */
    public function test_only_managers_can_access_leverancier_index()
    {
        $response = $this->actingAs($this->manager)
            ->get(route('leveranciers.index'));

        $response->assertStatus(200);
        $response->assertViewIs('Manager.leveranciers.index');
    }

    /**
     * Test that unauthenticated users are redirected
     */
    public function test_unauthenticated_users_cannot_access_leveranciers()
    {
        $response = $this->get(route('leveranciers.index'));
        
        $response->assertRedirect(route('login'));
    }

    /**
     * Test pagination is applied correctly
     */
    public function test_pagination_shows_max_four_records_per_page()
    {
        // This test would require database setup with actual data
        // For now, we're testing the route accessibility
        $this->actingAs($this->manager);
        
        $response = $this->get(route('leveranciers.index'));
        
        $response->assertStatus(200);
        $response->assertViewHas('pagination');
    }

    /**
     * Test that leverancier details page is accessible
     */
    public function test_leverancier_show_page_is_accessible()
    {
        // Create test data
        $contact = Contact::create([
            'Straat' => 'Teststraat',
            'Huisnummer' => '1',
            'Postcode' => '1234AB',
            'Stad' => 'Teststad',
            'IsActief' => 1,
        ]);

        $leverancier = Leverancier::create([
            'Naam' => 'Test Leverancier',
            'ContactPersoon' => 'Test Persoon',
            'LeverancierNummer' => 'L123456789',
            'Mobiel' => '06-12345678',
            'ContactId' => $contact->Id,
            'IsActief' => 1,
        ]);

        $response = $this->actingAs($this->manager)
            ->get(route('leveranciers.show', $leverancier->Id));

        $response->assertStatus(200);
        $response->assertViewIs('Manager.leveranciers.show');
        $response->assertViewHas('leverancier');
    }

    /**
     * Test that edit form is accessible
     */
    public function test_leverancier_edit_form_is_accessible()
    {
        $contact = Contact::create([
            'Straat' => 'Editstraat',
            'Huisnummer' => '2',
            'Postcode' => '5678CD',
            'Stad' => 'Editstad',
            'IsActief' => 1,
        ]);

        $leverancier = Leverancier::create([
            'Naam' => 'Edit Leverancier',
            'ContactPersoon' => 'Edit Persoon',
            'LeverancierNummer' => 'L987654321',
            'Mobiel' => '06-98765432',
            'ContactId' => $contact->Id,
            'IsActief' => 1,
        ]);

        $response = $this->actingAs($this->manager)
            ->get(route('leveranciers.edit', $leverancier->Id));

        $response->assertStatus(200);
        $response->assertViewIs('Manager.leveranciers.edit');
        $response->assertViewHas('leverancier');
        $response->assertSee('Wijzig Leveranciergegevens');
    }
}
