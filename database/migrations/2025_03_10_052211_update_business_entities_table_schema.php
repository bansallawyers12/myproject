<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusinessEntitiesTableSchema extends Migration
{
    public function up(): void
    {
        Schema::table('business_entities', function (Blueprint $table) {
            // Drop columns not needed (if you’re sure they’re unused)
            $table->dropColumn(['trust_name', 'trust_establishment_date', 'registration_date']);

            // Add missing columns from controller/model
            $table->string('trading_name')->nullable()->after('legal_name');
            $table->string('tfn')->nullable()->after('acn');
            $table->string('corporate_key')->nullable()->after('tfn');
            $table->string('registered_address')->after('corporate_key');
            $table->string('registered_email')->unique()->after('registered_address');
            $table->string('phone_number', 15)->after('registered_email');
            $table->date('asic_renewal_date')->nullable()->after('phone_number');

            // Ensure unique constraints on abn and acn
            $table->string('abn')->nullable()->change();
            $table->string('acn')->nullable()->change();
            $table->unique('abn');
            $table->unique('acn');
        });
    }

    public function down(): void
    {
        Schema::table('business_entities', function (Blueprint $table) {
            // Reverse changes for rollback
            $table->dropColumn([
                'trading_name', 'tfn', 'corporate_key', 'registered_address', 
                'registered_email', 'phone_number', 'asic_renewal_date'
            ]);
            $table->dropUnique(['abn']);
            $table->dropUnique(['acn']);
            $table->string('trust_name')->nullable();
            $table->date('trust_establishment_date')->nullable();
            $table->date('registration_date');
        });
    }
}