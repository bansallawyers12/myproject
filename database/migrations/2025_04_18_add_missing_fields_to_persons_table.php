<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('persons', function (Blueprint $table) {
            // Add missing columns based on model fillable and previous migrations
            if (!Schema::hasColumn('persons', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            
            if (!Schema::hasColumn('persons', 'email')) {
                $table->string('email')->nullable()->unique()->after('last_name');
            }
            
            if (!Schema::hasColumn('persons', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('email');
            }
            
            if (!Schema::hasColumn('persons', 'tfn') && !Schema::hasColumn('persons', 'tax_file_number')) {
                $table->string('tfn', 9)->nullable()->after('phone_number');
            } else if (Schema::hasColumn('persons', 'tax_file_number') && !Schema::hasColumn('persons', 'tfn')) {
                $table->renameColumn('tax_file_number', 'tfn');
            }
            
            if (!Schema::hasColumn('persons', 'address')) {
                $table->text('address')->nullable()->after('abn');
            }
        });
    }

    public function down()
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'email', 'phone_number', 'address']);
            
            if (Schema::hasColumn('persons', 'tfn') && !Schema::hasColumn('persons', 'tax_file_number')) {
                $table->renameColumn('tfn', 'tax_file_number');
            }
        });
    }
}; 