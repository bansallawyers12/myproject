<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Remove unique constraints that prevent a person from having multiple roles in the same entity.
     */
    public function up(): void
    {
        // Get database connection type
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");

        Schema::table('entity_person', function (Blueprint $table) use ($driver) {
            // Drop constraints if they exist (different syntax for different database drivers)
            if ($driver === 'mysql') {
                // MySQL approach
                // Check if constraints exist and drop them
                $constraints = DB::select("
                    SELECT CONSTRAINT_NAME
                    FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
                    WHERE CONSTRAINT_TYPE = 'UNIQUE'
                    AND TABLE_NAME = 'entity_person'
                    AND TABLE_SCHEMA = DATABASE()
                ");
                
                foreach ($constraints as $constraint) {
                    $table->dropUnique($constraint->CONSTRAINT_NAME);
                }
                
                // Explicitly try to drop these common unique constraints
                try {
                    $table->dropUnique('unique_person_role');
                } catch (\Exception $e) {
                    // Constraint might not exist, that's OK
                }
                
                try {
                    $table->dropUnique('unique_trustee_role');
                } catch (\Exception $e) {
                    // Constraint might not exist, that's OK
                }
                
                // Try to drop any potential indexes on the role columns
                try {
                    $table->dropIndex(['business_entity_id', 'person_id', 'role', 'role_status']);
                } catch (\Exception $e) {
                    // Index might not exist, that's OK
                }
                
                try {
                    $table->dropIndex(['business_entity_id', 'entity_trustee_id', 'role', 'role_status']);
                } catch (\Exception $e) {
                    // Index might not exist, that's OK
                }
                
                // Try dropping by alternative potential names
                try {
                    $table->dropUnique('entity_person_business_entity_id_person_id_role_unique');
                } catch (\Exception $e) {
                    // Constraint might not exist, that's OK
                }
                
                try {
                    $table->dropUnique('entity_person_business_entity_id_entity_trustee_id_role_unique');
                } catch (\Exception $e) {
                    // Constraint might not exist, that's OK
                }
            } else if ($driver === 'pgsql') {
                // PostgreSQL approach
                $constraints = DB::select("
                    SELECT conname
                    FROM pg_constraint
                    JOIN pg_class ON pg_constraint.conrelid = pg_class.oid
                    JOIN pg_namespace ON pg_class.relnamespace = pg_namespace.oid
                    WHERE pg_class.relname = 'entity_person'
                    AND pg_constraint.contype = 'u'
                ");
                
                foreach ($constraints as $constraint) {
                    $table->dropUnique($constraint->conname);
                }
                
                // Try the same explicit drops as for MySQL
                try {
                    $table->dropUnique('unique_person_role');
                } catch (\Exception $e) {
                    // Constraint might not exist, that's OK
                }
                
                try {
                    $table->dropUnique('unique_trustee_role');
                } catch (\Exception $e) {
                    // Constraint might not exist, that's OK
                }
            } else if ($driver === 'sqlite') {
                // For SQLite, we need to recreate the table without the constraints
                // This is more complex and requires a multi-step migration
                // For now, we'll log a message noting the limitation
                \Log::info('SQLite database detected. Note that dropping unique constraints in SQLite requires recreating the table.');
                
                // We'll create a special DB query to check for unique constraints
                $indexInfo = DB::select("PRAGMA index_list('entity_person')");
                foreach ($indexInfo as $index) {
                    if ($index->unique) {
                        \Log::info("Found unique constraint on entity_person: {$index->name}");
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     * This is a non-reversible migration as we don't know the exact constraints that were removed.
     */
    public function down(): void
    {
        // This is intentionally left empty as we cannot reliably restore
        // constraints that we've removed without knowing their exact definitions.
    }
};
