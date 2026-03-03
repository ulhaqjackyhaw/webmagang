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
            // New file upload fields - replacing proposal with transkrip, bpjs, ktp_ktm
            $table->string('file_transkrip')->nullable()->after('file_cv');
            $table->string('file_ktp_ktm')->nullable()->after('file_transkrip');
            $table->string('file_bpjs')->nullable()->after('file_ktp_ktm');

            // Keterangan surat magang fields
            $table->string('nomor_surat_kampus')->nullable()->after('file_bpjs');
            $table->date('tanggal_surat')->nullable()->after('nomor_surat_kampus');
            $table->string('perihal_surat')->nullable()->after('tanggal_surat');
            $table->string('pengirim_surat')->nullable()->after('perihal_surat');

            // Date range for internship within selected period
            $table->date('tanggal_mulai_magang')->nullable()->after('pengirim_surat');
            $table->date('tanggal_selesai_magang')->nullable()->after('tanggal_mulai_magang');

            // Administration/Persuratan status flags
            $table->boolean('surat_konfirmasi_unit_downloaded')->default(false)->after('tanggal_selesai_magang');
            $table->boolean('surat_ke_kampus_downloaded')->default(false)->after('surat_konfirmasi_unit_downloaded');
            $table->boolean('wa_onboarding_sent')->default(false)->after('surat_ke_kampus_downloaded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->dropColumn([
                'file_transkrip',
                'file_ktp_ktm',
                'file_bpjs',
                'nomor_surat_kampus',
                'tanggal_surat',
                'perihal_surat',
                'pengirim_surat',
                'tanggal_mulai_magang',
                'tanggal_selesai_magang',
                'surat_konfirmasi_unit_downloaded',
                'surat_ke_kampus_downloaded',
                'wa_onboarding_sent',
            ]);
        });
    }
};
