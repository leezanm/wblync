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
        Schema::create('industry_supervisors', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                ->unique();

            $table->foreignId('company_contact_id')
                ->constrained('company_contacts')
                ->cascadeOnDelete();

            $table->enum('status', [
                'Active',
                'Inactive',
            ])->default('Active');

            $table->timestamps();

            $table->unique('company_contact_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_supervisors');
    }
};
