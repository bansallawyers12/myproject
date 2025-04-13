<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Add business_entity_id column if it doesn't exist
            if (!Schema::hasColumn('transactions', 'business_entity_id')) {
                $table->foreignId('business_entity_id')
                      ->nullable()
                      ->after('bank_account_id')
                      ->constrained()
                      ->onDelete('set null');
                $table->index('business_entity_id');
            }

            // Optionally, ensure other columns match your requirements
            $table->decimal('amount', 15, 2)->change();
            $table->string('transaction_type')->nullable()->change();
            $table->decimal('gst_amount', 15, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'business_entity_id')) {
                $table->dropForeign(['business_entity_id']);
                $table->dropColumn('business_entity_id');
            }
        });
    }
};