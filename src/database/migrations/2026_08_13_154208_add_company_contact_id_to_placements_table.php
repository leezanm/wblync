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
        Schema::table('placements', function (Blueprint $table) {
            $table->foreignId('company_contact_id')
                ->nullable()
                ->after('company_id')
                ->constrained('company_contacts')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('placements', function (Blueprint $table) {
            $table->dropForeign(['company_contact_id']);
            $table->dropColumn('company_contact_id');
        });
    }
};
