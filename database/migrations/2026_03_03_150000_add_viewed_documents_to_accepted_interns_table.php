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
            // Track individual document views
            $table->boolean('viewed_cv')->default(false)->after('documents_verified_by');
            $table->boolean('viewed_transkrip')->default(false)->after('viewed_cv');
            $table->boolean('viewed_ktp_ktm')->default(false)->after('viewed_transkrip');
            $table->boolean('viewed_bpjs')->default(false)->after('viewed_ktp_ktm');
            $table->boolean('viewed_surat')->default(false)->after('viewed_bpjs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accepted_interns', function (Blueprint $table) {
            $table->dropColumn([
                'viewed_cv',
                'viewed_transkrip',
                'viewed_ktp_ktm',
                'viewed_bpjs',
                'viewed_surat',
            ]);
        });
    }
};
