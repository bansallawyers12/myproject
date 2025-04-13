<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('business_entities', function (Blueprint $table) {
            // Add trading name if it doesn't exist
            if (!Schema::hasColumn('business_entities', 'trading_name')) {
                $table->string('trading_name')->nullable()->after('legal_name');
            }
            
            // Add registered address if it doesn't exist
            if (!Schema::hasColumn('business_entities', 'registered_address')) {
                $table->text('registered_address')->nullable()->after('trading_name');
            }
            
            // Add registered email if it doesn't exist
            if (!Schema::hasColumn('business_entities', 'registered_email')) {
                $table->string('registered_email')->nullable()->after('registered_address');
            }
            
            // Add phone number if it doesn't exist
            if (!Schema::hasColumn('business_entities', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('registered_email');
            }
            
            // Add creation date if it doesn't exist
            if (!Schema::hasColumn('business_entities', 'creation_date')) {
                $table->date('creation_date')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_entities', function (Blueprint $table) {
            // Drop columns if they exist
            $columns = [
                'trading_name',
                'registered_address',
                'registered_email',
                'phone_number',
                'creation_date'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('business_entities', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
