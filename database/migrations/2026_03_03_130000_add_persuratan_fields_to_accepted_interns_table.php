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
            // Administration/Persuratan status flags
            $table->boolean('surat_konfirmasi_unit_downloaded')->default(false)->after('rejection_wa_sent');
            $table->boolean('surat_ke_kampus_downloaded')->default(false)->after('surat_konfirmasi_unit_downloaded');
            $table->boolean('wa_onboarding_sent')->default(false)->after('surat_ke_kampus_downloaded');

            // Tanggal mulai dan selesai magang (for detail tracking)
            $table->date('tanggal_mulai')->nullable()->after('wa_onboarding_sent');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accepted_interns', function (Blueprint $table) {
            $table->dropColumn([
                'surat_konfirmasi_unit_downloaded',
                'surat_ke_kampus_downloaded',
                'wa_onboarding_sent',
                'tanggal_mulai',
                'tanggal_selesai',
            ]);
        });
    }
};
