<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration is specifically for SQLite to recreate the entity_person table without unique constraints.
     * SQLite doesn't support dropping constraints directly.
     */
    public function up(): void
    {
        // This migration only applies to SQLite
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        
        if ($driver !== 'sqlite') {
            return; // Skip this migration for non-SQLite databases
        }
        
        // Step 1: Create a temporary table with the same structure but without unique constraints
        Schema::create('entity_person_temp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_entity_id');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreignId('entity_trustee_id')->nullable();
            $table->enum('role', ['Director', 'Secretary', 'Shareholder', 'Trustee', 'Beneficiary', 'Settlor', 'Owner']);
            $table->date('appointment_date');
            $table->date('resignation_date')->nullable();
            $table->enum('role_status', ['Active', 'Resigned']);
            $table->decimal('shares_percentage', 5, 2)->nullable();
            $table->enum('authority_level', ['Full', 'Limited'])->nullable();
            $table->boolean('asic_updated')->default(false);
            $table->date('asic_due_date')->nullable();
            $table->timestamps();
            
            // Foreign keys are recreated but no unique constraints
            $table->foreign('business_entity_id')->references('id')->on('business_entities')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('entity_trustee_id')->references('id')->on('business_entities')->onDelete('cascade');
        });
        
        // Step 2: Copy all data from the old table to the new table
        DB::statement('INSERT INTO entity_person_temp SELECT * FROM entity_person');
        
        // Step 3: Drop the old table
        Schema::dropIfExists('entity_person');
        
        // Step 4: Rename the new table to the original name
        Schema::rename('entity_person_temp', 'entity_person');
    }

    /**
     * Reverse the migrations.
     * This is a non-reversible migration as we don't know the exact constraints that were on the original table.
     */
    public function down(): void
    {
        // This is intentionally left empty as we cannot reliably restore
        // the table with its original constraints
    }
}; 