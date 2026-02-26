<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accepted_interns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained('interns')->onDelete('cascade');
            $table->string('periode_magang')->nullable();
            $table->string('unit_magang');
            $table->string('approval_status')->default('pending');
            $table->text('rejection_reason')->nullable();

            // Div Head approval tracking
            $table->timestamp('sent_to_divhead_at')->nullable();
            $table->timestamp('approved_divhead_at')->nullable();
            $table->foreignId('approved_by_divhead')->nullable()->constrained('users')->onDelete('set null');

            // Deputy approval tracking
            $table->timestamp('sent_to_deputy_at')->nullable();
            $table->timestamp('approved_deputy_at')->nullable();
            $table->foreignId('approved_by_deputy')->nullable()->constrained('users')->onDelete('set null');

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accepted_interns');
    }
};
