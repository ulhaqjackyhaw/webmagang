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
        Schema::table('interns', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['created_by']);

            // Make created_by nullable
            $table->foreignId('created_by')->nullable()->change();

            // Add the foreign key back with nullable constraint
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            // Drop the nullable foreign key
            $table->dropForeign(['created_by']);

            // Restore to non-nullable
            $table->foreignId('created_by')->nullable(false)->change();

            // Add back the original cascade foreign key
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
