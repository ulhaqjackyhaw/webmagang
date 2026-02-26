<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update role enum to include div_head and deputy
        // First, modify the column to varchar temporarily
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('hc')->change();
        });

        // Add document check status to interns if not exists
        if (!Schema::hasColumn('interns', 'document_checked')) {
            Schema::table('interns', function (Blueprint $table) {
                $table->boolean('document_checked')->default(false)->after('status');
                $table->timestamp('document_checked_at')->nullable()->after('document_checked');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('interns', 'document_checked')) {
            Schema::table('interns', function (Blueprint $table) {
                $table->dropColumn(['document_checked', 'document_checked_at']);
            });
        }
    }
};
