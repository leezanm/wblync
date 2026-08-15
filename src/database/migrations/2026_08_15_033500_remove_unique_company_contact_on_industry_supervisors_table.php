<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropForeign(['company_contact_id']);
            $table->dropUnique('industry_supervisors_company_contact_id_unique');
            $table->index('company_contact_id', 'industry_supervisors_company_contact_id_index');
            $table->foreign('company_contact_id')
                ->references('id')
                ->on('company_contacts')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropForeign(['company_contact_id']);
            $table->dropIndex('industry_supervisors_company_contact_id_index');
            $table->unique('company_contact_id', 'industry_supervisors_company_contact_id_unique');
            $table->foreign('company_contact_id')
                ->references('id')
                ->on('company_contacts')
                ->nullOnDelete();
        });
    }
};
