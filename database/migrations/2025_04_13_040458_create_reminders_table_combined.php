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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->dateTime('reminder_date');
            $table->string('status')->default('active');
            $table->string('repeat_type')->default('none'); // none, monthly, quarterly, annual
            $table->date('repeat_end_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->foreignId('business_entity_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('asset_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('category')->nullable(); // For categorizing reminders (e.g., financial, legal, etc.)
            $table->text('notes')->nullable(); // Additional notes
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->string('priority')->default('medium'); // low, medium, high
            $table->enum('recurrence', ['None', 'Monthly', 'Quarterly', 'Annually', 'Custom'])->default('None');
            $table->integer('recurrence_interval')->nullable(); // For custom recurrence (e.g., every 45 days)
            $table->date('next_reminder_date')->nullable(); // For recurring reminders
            $table->string('reminder_type')->nullable(); // For polymorphic relationship
            $table->unsignedBigInteger('reminder_id')->nullable(); // For polymorphic relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Add index for polymorphic relationship
            $table->index(['reminder_type', 'reminder_id']);
            // Add index for finding upcoming reminders
            $table->index('next_reminder_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
}; 