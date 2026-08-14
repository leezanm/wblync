<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->string('name')->nullable()->after('company_contact_id');
            $table->string('position')->nullable()->after('name');
            $table->string('email')->nullable()->after('position');
            $table->string('phone')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('industry_supervisors', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'position',
                'email',
                'phone',
            ]);
        });
    }
};
