<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropColumn('date_of_birth'); // Remove date_of_birth
            $table->string('abn', 11)->nullable()->after('tax_file_number'); // Add ABN (11 digits, optional)
        });
    }

    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable(); // Re-add date_of_birth if rolling back
            $table->dropColumn('abn'); // Remove ABN
        });
    }
};