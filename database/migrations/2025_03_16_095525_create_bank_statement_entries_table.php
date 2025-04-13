<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bank_statement_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->string('transaction_type')->nullable();
            $table->timestamps();
            $table->index('bank_account_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('bank_statement_entries');
    }
};