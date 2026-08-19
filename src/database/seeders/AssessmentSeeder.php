<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DVV40237SoundSeeder::class,
            DVV50256LightingProjectSeeder::class,
            DVV50256LightingSeeder::class,
            DVV402411VideoProjectSeeder::class,
            DVV402411VideoSeeder::class,
            DVV502612VideoCompanySeeder::class,
            DVV502612VideoProjectSeeder::class,

        ]);
    }
}
