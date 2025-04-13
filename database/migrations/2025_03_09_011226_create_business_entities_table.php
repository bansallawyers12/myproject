<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_entities', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name');
            $table->enum('entity_type', ['Company', 'Trust', 'Sole Trader', 'Partnership'])->default('Company');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('registration_date');
            $table->string('abn')->nullable();
            $table->string('acn')->nullable();
            $table->string('trust_name')->nullable();
            $table->date('trust_establishment_date')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Deregistered'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_entities');
    }
};