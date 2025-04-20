<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('entity_person')) {
            Schema::create('entity_person', function (Blueprint $table) {
                $table->id();
                $table->foreignId('business_entity_id')->constrained()->onDelete('cascade');
                $table->unsignedBigInteger('person_id')->nullable();
                $table->foreignId('entity_trustee_id')->nullable()->constrained('business_entities')->onDelete('cascade');
                $table->enum('role', ['Director', 'Secretary', 'Shareholder', 'Trustee', 'Beneficiary', 'Settlor', 'Owner']);
                $table->date('appointment_date');
                $table->date('resignation_date')->nullable();
                $table->enum('role_status', ['Active', 'Resigned']);
                $table->decimal('shares_percentage', 5, 2)->nullable();
                $table->enum('authority_level', ['Full', 'Limited'])->nullable();
                $table->boolean('asic_updated')->default(false);
                $table->date('asic_due_date')->nullable();
                $table->timestamps();

                $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
                
                // Note: We intentionally do not add unique constraints here
                // to allow a person to have multiple roles in the same entity
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('entity_person');
    }
};