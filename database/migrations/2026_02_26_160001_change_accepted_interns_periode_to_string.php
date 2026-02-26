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
        // Skip if periode_magang already exists (added in original migration)
        if (Schema::hasColumn('accepted_interns', 'periode_magang')) {
            return;
        }

        Schema::table('accepted_interns', function (Blueprint $table) {
            // Add periode_magang string column
            $table->string('periode_magang')->nullable()->after('intern_id');

            // Drop old date columns if exists
            if (Schema::hasColumn('accepted_interns', 'periode_awal')) {
                $table->dropColumn(['periode_awal', 'periode_akhir']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nothing to do - original migration handles this
    }
};
