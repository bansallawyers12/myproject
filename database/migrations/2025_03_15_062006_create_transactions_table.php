<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->constrained()->onDelete('cascade');
            $table->foreignId('business_entity_id')->nullable()->constrained()->onDelete('set null'); // New column
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->string('transaction_type')->nullable(); // Updated below
            $table->decimal('gst_amount', 15, 2)->nullable();
            $table->string('gst_status')->nullable();
            $table->timestamps();
            $table->index('bank_account_id');
            $table->index('business_entity_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};