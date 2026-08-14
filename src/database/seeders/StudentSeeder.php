<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'student_no' => 'ST001',
                'name' => 'Ahmad Hakimi',
                'email' => 'student1@wblync.test',
                'ic_no' => '010101-01-0101',
                'phone' => '012-1111111',
            ],
            [
                'student_no' => 'ST002',
                'name' => 'Nur Aisyah',
                'email' => 'student2@wblync.test',
                'ic_no' => '020202-02-0202',
                'phone' => '013-2222222',
            ],
            [
                'student_no' => 'ST003',
                'name' => 'Muhammad Irfan',
                'email' => 'student3@wblync.test',
                'ic_no' => '030303-03-0303',
                'phone' => '014-3333333',
            ],
            [
                'student_no' => 'ST004',
                'name' => 'Siti Hajar',
                'email' => 'student4@wblync.test',
                'ic_no' => '040404-04-0404',
                'phone' => '015-4444444',
            ],
            [
                'student_no' => 'ST005',
                'name' => 'Farah Nadia',
                'email' => 'student5@wblync.test',
                'ic_no' => '050505-05-0505',
                'phone' => '016-5555555',
            ],
        ];

        foreach ($students as $data) {

            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password'),
                ]
            );

            $user->syncRoles(['Student']);


            Student::updateOrCreate(
                [
                    'student_no' => $data['student_no'],
                ],
                [
                    'uuid' => (string) Str::uuid(),
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'ic_no' => $data['ic_no'],
                    'phone' => $data['phone'],
                    'status' => 1,
                ]
            );
        }
    }
}
