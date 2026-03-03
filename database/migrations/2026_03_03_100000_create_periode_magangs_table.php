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
        Schema::create('periode_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_batch'); // e.g., "Pendaftaran Juni 2026"
            $table->string('nama_periode'); // e.g., "Juli - September 2026"
            $table->date('tanggal_mulai'); // Start date of the period
            $table->date('tanggal_selesai'); // End date of the period
            $table->date('batas_pendaftaran'); // Registration deadline
            $table->boolean('is_active')->default(true); // Whether the period is open for registration
            $table->text('keterangan')->nullable(); // Additional notes
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_magangs');
    }
};
