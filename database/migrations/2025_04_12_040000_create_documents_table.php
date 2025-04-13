<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('documents')) {
            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('business_entity_id')->constrained()->onDelete('cascade');
                $table->string('file_name');
                $table->string('path');
                $table->string('type')->nullable();
                $table->string('description')->nullable();
                $table->string('filetype')->nullable();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
}; 