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
        Schema::table('accepted_interns', function (Blueprint $table) {
            $table->boolean('documents_verified')->default(false)->after('approval_status');
            $table->timestamp('documents_verified_at')->nullable()->after('documents_verified');
            $table->foreignId('documents_verified_by')->nullable()->after('documents_verified_at')
                ->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accepted_interns', function (Blueprint $table) {
            $table->dropForeign(['documents_verified_by']);
            $table->dropColumn(['documents_verified', 'documents_verified_at', 'documents_verified_by']);
        });
    }
};
