<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_entity_id')->constrained()->onDelete('cascade');
            $table->enum('asset_type', ['Car', 'House Owned', 'House Rented', 'Warehouse', 'Land', 'Office', 'Shop', 'Real Estate'])->default('Car');
            $table->string('name');
            $table->date('acquisition_date');
            $table->decimal('acquisition_cost', 15, 2);
            $table->decimal('current_value', 15, 2)->default(0);
            $table->enum('status', ['Active', 'Inactive', 'Sold', 'Under Maintenance'])->default('Active');
            $table->text('description')->nullable();

            // Car-specific fields
            $table->string('registration_number')->nullable();
            $table->date('registration_due_date')->nullable();
            $table->string('insurance_company')->nullable();
            $table->date('insurance_due_date')->nullable();
            $table->decimal('insurance_amount', 15, 2)->nullable();
            $table->string('vin_number')->nullable();
            $table->integer('mileage')->nullable();
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid'])->nullable();
            $table->date('service_due_date')->nullable();
            $table->boolean('vic_roads_updated')->default(false);

            // Property-specific fields
            $table->text('address')->nullable();
            $table->integer('square_footage')->nullable();
            $table->decimal('council_rates_amount', 15, 2)->nullable();
            $table->date('council_rates_due_date')->nullable();
            $table->decimal('owners_corp_amount', 15, 2)->nullable();
            $table->date('owners_corp_due_date')->nullable();
            $table->decimal('land_tax_amount', 15, 2)->nullable();
            $table->date('land_tax_due_date')->nullable();
            $table->boolean('sro_updated')->default(false);
            $table->decimal('real_estate_percentage', 5, 2)->nullable(); // Real estate agent percentage
            $table->decimal('rental_income', 15, 2)->nullable(); // For rented properties

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};