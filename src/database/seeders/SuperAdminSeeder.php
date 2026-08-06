<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@wblync.test'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole('Super Admin');
    }
}
