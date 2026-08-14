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
            $table->foreignId('company_id')
                ->nullable()
                ->after('uuid')
                ->constrained('companies')
                ->nullOnDelete();
        });

        DB::statement(
            'UPDATE industry_supervisors isv
            INNER JOIN company_contacts cc ON cc.id = isv.company_contact_id
            SET isv.company_id = cc.company_id
            WHERE isv.company_contact_id IS NOT NULL AND isv.company_id IS NULL'
        );

        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropForeign(['company_contact_id']);
            $table->dropColumn('company_contact_id');
        });
    }

    public function down(): void
    {
        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->foreignId('company_contact_id')
                ->nullable()
                ->after('company_id')
                ->constrained('company_contacts')
                ->nullOnDelete();
        });

        DB::statement(
            'UPDATE industry_supervisors isv
            INNER JOIN company_contacts cc ON cc.company_id = isv.company_id
            SET isv.company_contact_id = cc.id
            WHERE isv.company_id IS NOT NULL AND isv.company_contact_id IS NULL'
        );

        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};

