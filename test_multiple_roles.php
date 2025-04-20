<?php

// Set up the Laravel application environment
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BusinessEntity;
use App\Models\Person;
use App\Models\EntityPerson;
use Illuminate\Support\Facades\DB;

// Clear existing entity-person records
echo "Cleaning up existing data...\n";
DB::statement('DELETE FROM entity_person');

// Get first entity and person
$entity = BusinessEntity::first();
$person = Person::first();

if (!$entity) {
    echo "Error: No business entity found!\n";
    exit(1);
}

if (!$person) {
    echo "Error: No person found!\n";
    exit(1);
}

echo "Using entity: {$entity->legal_name} (ID: {$entity->id})\n";
echo "Using person: {$person->first_name} {$person->last_name} (ID: {$person->id})\n";

try {
    // Create first role
    $role1 = EntityPerson::create([
        'business_entity_id' => $entity->id,
        'person_id' => $person->id,
        'role' => 'Director',
        'appointment_date' => now(),
        'role_status' => 'Active'
    ]);
    
    echo "✅ Created first role: Director (ID: {$role1->id})\n";
    
    // Create second role for same person in same entity
    $role2 = EntityPerson::create([
        'business_entity_id' => $entity->id,
        'person_id' => $person->id,
        'role' => 'Shareholder',
        'appointment_date' => now(),
        'role_status' => 'Active',
        'shares_percentage' => 50
    ]);
    
    echo "✅ Created second role: Shareholder (ID: {$role2->id})\n";
    
    // Create third role for same person in same entity
    $role3 = EntityPerson::create([
        'business_entity_id' => $entity->id,
        'person_id' => $person->id,
        'role' => 'Secretary',
        'appointment_date' => now(),
        'role_status' => 'Active'
    ]);
    
    echo "✅ Created third role: Secretary (ID: {$role3->id})\n";
    
    // Count results
    $count = EntityPerson::where('business_entity_id', $entity->id)
        ->where('person_id', $person->id)
        ->count();
    
    echo "✅ RESULT: Successfully created {$count} different roles for the same person in the same entity.\n";
    
    // List all created roles
    $roles = EntityPerson::where('business_entity_id', $entity->id)
        ->where('person_id', $person->id)
        ->get();
    
    echo "\nList of roles created:\n";
    echo "---------------------\n";
    
    foreach ($roles as $role) {
        echo "ID: {$role->id}, Role: {$role->role}, Status: {$role->role_status}\n";
    }
    
    echo "\nMultiple roles test PASSED! 🎉\n";
    
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    exit(1);
} 