<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bank_statement_entries', function (Blueprint $table) {
            // Add transaction_id column if it doesn’t exist
            if (!Schema::hasColumn('bank_statement_entries', 'transaction_id')) {
                $table->unsignedBigInteger('transaction_id')->nullable()->after('transaction_type');
                $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bank_statement_entries', function (Blueprint $table) {
            if (Schema::hasColumn('bank_statement_entries', 'transaction_id')) {
                $table->dropForeign(['transaction_id']);
                $table->dropColumn('transaction_id');
            }
        });
    }
};