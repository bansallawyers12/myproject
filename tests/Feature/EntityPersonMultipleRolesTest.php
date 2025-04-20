<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BusinessEntity;
use App\Models\Person;
use App\Models\EntityPerson;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EntityPersonMultipleRolesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $businessEntity;
    protected $person;

    public function setUp(): void
    {
        parent::setUp();
        
        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        
        // Create a business entity
        $this->businessEntity = BusinessEntity::create([
            'name' => 'Test Company',
            'legal_name' => 'Test Company Legal Name',
            'type' => 'Company',
            'abn' => '12345678901',
            'acn' => '123456789',
            'status' => 'Active',
            'user_id' => $this->user->id
        ]);
        
        // Create a person
        $this->person = Person::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone_number' => '0412345678',
            'abn' => '98765432101',
        ]);
    }

    /** @test */
    public function person_can_have_multiple_roles_in_same_entity()
    {
        // Create the first role for the person
        $directorRole = EntityPerson::create([
            'business_entity_id' => $this->businessEntity->id,
            'person_id' => $this->person->id,
            'role' => 'Director',
            'appointment_date' => now(),
            'role_status' => 'Active',
        ]);
        
        $this->assertDatabaseHas('entity_person', [
            'id' => $directorRole->id,
            'business_entity_id' => $this->businessEntity->id,
            'person_id' => $this->person->id,
            'role' => 'Director',
        ]);
        
        // Create a second role for the same person in the same entity
        $shareholderRole = EntityPerson::create([
            'business_entity_id' => $this->businessEntity->id,
            'person_id' => $this->person->id,
            'role' => 'Shareholder',
            'appointment_date' => now(),
            'role_status' => 'Active',
            'shares_percentage' => 50.00,
        ]);
        
        $this->assertDatabaseHas('entity_person', [
            'id' => $shareholderRole->id,
            'business_entity_id' => $this->businessEntity->id,
            'person_id' => $this->person->id,
            'role' => 'Shareholder',
        ]);
        
        // Create a third role for the same person in the same entity
        $secretaryRole = EntityPerson::create([
            'business_entity_id' => $this->businessEntity->id,
            'person_id' => $this->person->id,
            'role' => 'Secretary',
            'appointment_date' => now(),
            'role_status' => 'Active',
        ]);
        
        $this->assertDatabaseHas('entity_person', [
            'id' => $secretaryRole->id,
            'business_entity_id' => $this->businessEntity->id,
            'person_id' => $this->person->id,
            'role' => 'Secretary',
        ]);
        
        // Verify we have 3 different roles for the same person in the same entity
        $roles = EntityPerson::where('business_entity_id', $this->businessEntity->id)
            ->where('person_id', $this->person->id)
            ->get();
            
        $this->assertEquals(3, $roles->count());
        $this->assertContains('Director', $roles->pluck('role')->toArray());
        $this->assertContains('Shareholder', $roles->pluck('role')->toArray());
        $this->assertContains('Secretary', $roles->pluck('role')->toArray());
    }
} 