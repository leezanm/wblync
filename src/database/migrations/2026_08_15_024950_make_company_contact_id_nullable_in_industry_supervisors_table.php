<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropForeign(['company_contact_id']);
        });

        DB::statement(
            'ALTER TABLE industry_supervisors MODIFY company_contact_id BIGINT UNSIGNED NULL'
        );

        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->foreign('company_contact_id')
                ->references('id')
                ->on('company_contacts')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        DB::table('industry_supervisors')
            ->whereNull('company_contact_id')
            ->delete();

        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropForeign(['company_contact_id']);
        });

        DB::statement(
            'ALTER TABLE industry_supervisors MODIFY company_contact_id BIGINT UNSIGNED NOT NULL'
        );

        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->foreign('company_contact_id')
                ->references('id')
                ->on('company_contacts')
                ->cascadeOnDelete();
        });
    }
};

