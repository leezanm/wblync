<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // [
            //     'name' => 'WBLync Super Admin',
            //     'email' => 'admin@wblync.test',
            //     'role' => 'Super Admin',
            // ],
            [
                'name' => 'WBL Coordinator',
                'email' => 'coordinator@wblync.test',
                'role' => 'WBL Coordinator',
            ],
            [
                'name' => 'WBL Lecturer',
                'email' => 'lecturer@wblync.test',
                'role' => 'Lecturer',
            ],
            [
                'name' => 'Industry Mentor',
                'email' => 'mentor@wblync.test',
                'role' => 'Industry Mentor',
            ],
            [
                'name' => 'WBL Student',
                'email' => 'student@wblync.test',
                'role' => 'Student',
            ],
        ];

        foreach ($users as $data) {

            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                ]
            );

            $user->syncRoles([
                $data['role'],
            ]);
        }
    }
}
