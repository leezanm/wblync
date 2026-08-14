<?php

namespace Database\Seeders;

use App\Models\AcademicSession;
use App\Models\Assessment;
use App\Models\ClassCourse;
use App\Models\ClassRoom;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\Course;
use App\Models\DailyLogbook;
use App\Models\Enrollment;
use App\Models\Placement;
use App\Models\Programme;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SystemSeeder extends Seeder
{
    public function run(): void
    {
        $coordinator = User::updateOrCreate(
            ['email' => 'coordinator@wblync.test'],
            [
                'name' => 'WBL Coordinator',
                'password' => Hash::make('password'),
            ]
        );
        $coordinator->syncRoles(['WBL Coordinator']);

        $lecturer = User::updateOrCreate(
            ['email' => 'lecturer@wblync.test'],
            [
                'name' => 'WBL Lecturer',
                'password' => Hash::make('password'),
            ]
        );
        $lecturer->syncRoles(['Lecturer']);

        $mentor = User::updateOrCreate(
            ['email' => 'mentor@wblync.test'],
            [
                'name' => 'Industry Mentor',
                'password' => Hash::make('password'),
            ]
        );
        $mentor->syncRoles(['Industry Mentor']);

        $academicSessions = [];

        foreach ([
            [
                'code' => 'AS2025-2026',
                'name' => 'Academic Session 2025/2026',
                'start_date' => '2025-08-01',
                'end_date' => '2026-07-31',
                'status' => 'Closed',
                'current' => false,
                'description' => 'Archived demo academic session.',
            ],
            [
                'code' => 'AS2026-2027',
                'name' => 'Academic Session 2026/2027',
                'start_date' => '2026-08-01',
                'end_date' => '2027-07-31',
                'status' => 'Active',
                'current' => true,
                'description' => 'Current demo academic session.',
            ],
        ] as $data) {
            $academicSessions[$data['code']] = AcademicSession::updateOrCreate(
                ['code' => $data['code']],
                [
                    'name' => $data['name'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'status' => $data['status'],
                    'current' => $data['current'],
                    'description' => $data['description'],
                    'created_by' => $coordinator->id,
                ]
            );
        }

        $semesters = [];

        foreach ([
            [
                'code' => 'SEM2025-1',
                'academic_session_code' => 'AS2025-2026',
                'name' => 'Semester 1',
                'start_date' => '2025-08-01',
                'end_date' => '2025-12-31',
                'status' => 'Closed',
                'current' => false,
            ],
            [
                'code' => 'SEM2025-2',
                'academic_session_code' => 'AS2025-2026',
                'name' => 'Semester 2',
                'start_date' => '2026-01-01',
                'end_date' => '2026-07-31',
                'status' => 'Closed',
                'current' => false,
            ],
            [
                'code' => 'SEM2026-1',
                'academic_session_code' => 'AS2026-2027',
                'name' => 'Semester 1',
                'start_date' => '2026-08-01',
                'end_date' => '2026-12-31',
                'status' => 'Active',
                'current' => true,
            ],
        ] as $data) {
            $semester = Semester::updateOrCreate(
                ['code' => $data['code']],
                [
                    'academic_session_id' => $academicSessions[$data['academic_session_code']]->id,
                    'name' => $data['name'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'status' => $data['status'],
                    'current' => $data['current'],
                    'description' => $data['name'].' demo data.',
                    'created_by' => $coordinator->id,
                ]
            );

            $semesters[$data['code']] = $semester;
        }

        $programmes = [];

        foreach ([
            [
                'code' => 'DIT',
                'name' => 'Diploma in Information Technology',
                'description' => 'Demo programme for IT students.',
                'duration' => 6,
                'status' => true,
            ],
            [
                'code' => 'DAB',
                'name' => 'Diploma in Business Administration',
                'description' => 'Demo programme for business students.',
                'duration' => 6,
                'status' => true,
            ],
        ] as $data) {
            $programmes[$data['code']] = Programme::updateOrCreate(
                ['code' => $data['code']],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'duration' => $data['duration'],
                    'status' => $data['status'],
                ]
            );
        }

        $courses = [];

        foreach ([
            [
                'programme_code' => 'DIT',
                'code' => 'IT101',
                'name' => 'Web Development Fundamentals',
                'credit_hours' => 3,
            ],
            [
                'programme_code' => 'DIT',
                'code' => 'IT102',
                'name' => 'Database Systems',
                'credit_hours' => 3,
            ],
            [
                'programme_code' => 'DIT',
                'code' => 'IT103',
                'name' => 'Mobile App Development',
                'credit_hours' => 3,
            ],
            [
                'programme_code' => 'DAB',
                'code' => 'BA101',
                'name' => 'Principles of Management',
                'credit_hours' => 3,
            ],
            [
                'programme_code' => 'DAB',
                'code' => 'BA102',
                'name' => 'Business Communication',
                'credit_hours' => 2,
            ],
            [
                'programme_code' => 'DAB',
                'code' => 'BA103',
                'name' => 'Digital Marketing',
                'credit_hours' => 3,
            ],
        ] as $data) {
            $course = Course::updateOrCreate(
                [
                    'programme_id' => $programmes[$data['programme_code']]->id,
                    'code' => $data['code'],
                ],
                [
                    'name' => $data['name'],
                    'credit_hours' => $data['credit_hours'],
                    'status' => true,
                ]
            );

            $courses[$data['code']] = $course;
        }

        $classRooms = [];

        foreach ([
            [
                'academic_session_code' => 'AS2026-2027',
                'semester_code' => 'SEM2026-1',
                'programme_code' => 'DIT',
                'code' => 'DIT-A',
                'name' => 'DIT Cohort A',
            ],
            [
                'academic_session_code' => 'AS2026-2027',
                'semester_code' => 'SEM2026-1',
                'programme_code' => 'DAB',
                'code' => 'DAB-A',
                'name' => 'DAB Cohort A',
            ],
        ] as $data) {
            $classRoom = ClassRoom::updateOrCreate(
                [
                    'academic_session_id' => $academicSessions[$data['academic_session_code']]->id,
                    'semester_id' => $semesters[$data['semester_code']]->id,
                    'programme_id' => $programmes[$data['programme_code']]->id,
                    'code' => $data['code'],
                ],
                [
                    'name' => $data['name'],
                    'status' => true,
                ]
            );

            $classRooms[$data['code']] = $classRoom;
        }

        $classCourses = [];

        foreach ([
            ['class_room_code' => 'DIT-A', 'course_code' => 'IT101'],
            ['class_room_code' => 'DIT-A', 'course_code' => 'IT102'],
            ['class_room_code' => 'DIT-A', 'course_code' => 'IT103'],
            ['class_room_code' => 'DAB-A', 'course_code' => 'BA101'],
            ['class_room_code' => 'DAB-A', 'course_code' => 'BA102'],
            ['class_room_code' => 'DAB-A', 'course_code' => 'BA103'],
        ] as $data) {
            $classCourse = ClassCourse::updateOrCreate(
                [
                    'class_room_id' => $classRooms[$data['class_room_code']]->id,
                    'course_id' => $courses[$data['course_code']]->id,
                ],
                [
                    'status' => true,
                ]
            );

            $classCourses[$data['class_room_code'].':'.$data['course_code']] = $classCourse;
        }

        $students = [];

        foreach ([
            [
                'student_no' => 'ST001',
                'name' => 'Ahmad Hakimi',
                'email' => 'student1@wblync.test',
                'ic_no' => '010101-01-0101',
                'phone' => '012-1111111',
                'class_room_code' => 'DIT-A',
            ],
            [
                'student_no' => 'ST002',
                'name' => 'Nur Aisyah',
                'email' => 'student2@wblync.test',
                'ic_no' => '020202-02-0202',
                'phone' => '013-2222222',
                'class_room_code' => 'DIT-A',
            ],
            [
                'student_no' => 'ST003',
                'name' => 'Muhammad Irfan',
                'email' => 'student3@wblync.test',
                'ic_no' => '030303-03-0303',
                'phone' => '014-3333333',
                'class_room_code' => 'DIT-A',
            ],
            [
                'student_no' => 'ST004',
                'name' => 'Siti Hajar',
                'email' => 'student4@wblync.test',
                'ic_no' => '040404-04-0404',
                'phone' => '015-4444444',
                'class_room_code' => 'DAB-A',
            ],
            [
                'student_no' => 'ST005',
                'name' => 'Farah Nadia',
                'email' => 'student5@wblync.test',
                'ic_no' => '050505-05-0505',
                'phone' => '016-5555555',
                'class_room_code' => 'DAB-A',
            ],
        ] as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                ]
            );
            $user->syncRoles(['Student']);

            $student = Student::updateOrCreate(
                ['student_no' => $data['student_no']],
                [
                    'class_room_id' => $classRooms[$data['class_room_code']]->id,
                    'name' => $data['name'],
                    'ic_no' => $data['ic_no'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'status' => true,
                    'user_id' => $user->id,
                ]
            );

            $students[$data['student_no']] = $student;
        }

        $studentCourseMap = [
            'ST001' => ['IT101', 'IT102', 'IT103'],
            'ST002' => ['IT101', 'IT102'],
            'ST003' => ['IT102', 'IT103'],
            'ST004' => ['BA101', 'BA102', 'BA103'],
            'ST005' => ['BA101', 'BA103'],
        ];

        foreach ($studentCourseMap as $studentNo => $courseCodes) {
            $student = $students[$studentNo];

            foreach ($courseCodes as $courseCode) {
                $classRoomCode = $student->classRoom->code;

                Enrollment::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'class_course_id' => $classCourses[$classRoomCode.':'.$courseCode]->id,
                    ],
                    [
                        'status' => true,
                    ]
                );
            }
        }

        $companies = [];

        foreach ([
            [
                'code' => 'CMP001',
                'name' => 'Alpha Tech Solutions',
                'registration_no' => 'REG-AT-001',
                'industry' => 'Software Development',
                'email' => 'hello@alphatech.test',
                'phone' => '03-80001111',
                'website' => 'https://alphatech.test',
                'address' => '12, Jalan Teknologi 1',
                'city' => 'Shah Alam',
                'state' => 'Selangor',
                'postcode' => '40150',
            ],
            [
                'code' => 'CMP002',
                'name' => 'Bumi Digital Sdn Bhd',
                'registration_no' => 'REG-BD-002',
                'industry' => 'Digital Marketing',
                'email' => 'contact@bumidigital.test',
                'phone' => '03-80002222',
                'website' => 'https://bumidigital.test',
                'address' => '88, Jalan Kreatif 2',
                'city' => 'Petaling Jaya',
                'state' => 'Selangor',
                'postcode' => '46000',
            ],
            [
                'code' => 'CMP003',
                'name' => 'Maju Manufacturing',
                'registration_no' => 'REG-MM-003',
                'industry' => 'Manufacturing',
                'email' => 'info@majumanufacturing.test',
                'phone' => '04-70003333',
                'website' => 'https://majumanufacturing.test',
                'address' => '5, Jalan Industri 3',
                'city' => 'Georgetown',
                'state' => 'Pulau Pinang',
                'postcode' => '11600',
            ],
        ] as $data) {
            $company = Company::firstOrNew(['code' => $data['code']]);

            $company->fill([
                'name' => $data['name'],
                'registration_no' => $data['registration_no'],
                'industry' => $data['industry'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'website' => $data['website'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'postcode' => $data['postcode'],
                'status' => true,
            ]);

            if (! $company->exists) {
                $company->uuid = (string) Str::uuid();
            }

            $company->save();

            $companies[$data['code']] = $company;
        }

        $companyContacts = [];

        foreach ([
            [
                'company_code' => 'CMP001',
                'name' => 'Aiman Rahman',
                'position' => 'HR Executive',
                'email' => 'aiman@alphatech.test',
                'phone' => '012-9000111',
                'status' => 'Active',
            ],
            [
                'company_code' => 'CMP002',
                'name' => 'Nurul Izzah',
                'position' => 'Operations Manager',
                'email' => 'nurul@bumidigital.test',
                'phone' => '013-9000222',
                'status' => 'Active',
            ],
            [
                'company_code' => 'CMP003',
                'name' => 'Faizal Hamid',
                'position' => 'Industry Supervisor',
                'email' => 'faizal@majumanufacturing.test',
                'phone' => '014-9000333',
                'status' => 'Active',
            ],
        ] as $data) {
            $contact = CompanyContact::updateOrCreate(
                [
                    'company_id' => $companies[$data['company_code']]->id,
                    'name' => $data['name'],
                ],
                [
                    'position' => $data['position'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'status' => $data['status'],
                ]
            );

            $companyContacts[$data['company_code']] = $contact;
        }

        $placements = [];

        foreach ([
            [
                'student_no' => 'ST001',
                'company_code' => 'CMP001',
                'contact_company_code' => 'CMP001',
                'start_date' => '2026-09-01',
                'end_date' => '2027-01-31',
                'status' => 'Active',
                'remarks' => 'Primary IT placement.',
            ],
            [
                'student_no' => 'ST002',
                'company_code' => 'CMP002',
                'contact_company_code' => 'CMP002',
                'start_date' => '2026-09-01',
                'end_date' => '2027-01-31',
                'status' => 'Approved',
                'remarks' => 'Awaiting internship start date.',
            ],
            [
                'student_no' => 'ST003',
                'company_code' => 'CMP001',
                'contact_company_code' => 'CMP001',
                'start_date' => '2026-09-15',
                'end_date' => '2027-02-15',
                'status' => 'Applied',
                'remarks' => 'Placement application in review.',
            ],
            [
                'student_no' => 'ST004',
                'company_code' => 'CMP003',
                'contact_company_code' => 'CMP003',
                'start_date' => '2026-09-10',
                'end_date' => '2027-02-10',
                'status' => 'Draft',
                'remarks' => 'Business track placement draft.',
            ],
            [
                'student_no' => 'ST005',
                'company_code' => 'CMP002',
                'contact_company_code' => 'CMP002',
                'start_date' => '2026-08-20',
                'end_date' => '2027-01-20',
                'status' => 'Completed',
                'remarks' => 'Completed demo placement.',
            ],
        ] as $data) {
            $placement = Placement::firstOrNew([
                'student_id' => $students[$data['student_no']]->id,
                'academic_session_id' => $academicSessions['AS2026-2027']->id,
            ]);

            $placement->fill([
                'company_id' => $companies[$data['company_code']]->id,
                'company_contact_id' => $companyContacts[$data['contact_company_code']]->id,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'status' => $data['status'],
                'remarks' => $data['remarks'],
            ]);

            if (! $placement->exists) {
                $placement->uuid = (string) Str::uuid();
            }

            $placement->save();

            $placements[$data['student_no']] = $placement;
        }

        foreach ([
            [
                'student_no' => 'ST001',
                'assessment_date' => '2026-12-15',
                'score' => 86.50,
                'grade' => 'A',
                'status' => 'Completed',
                'remarks' => 'Strong technical performance.',
            ],
            [
                'student_no' => 'ST002',
                'assessment_date' => '2026-12-18',
                'score' => 78.00,
                'grade' => 'B+',
                'status' => 'Submitted',
                'remarks' => 'Waiting for mentor final review.',
            ],
            [
                'student_no' => 'ST005',
                'assessment_date' => '2026-12-20',
                'score' => 91.00,
                'grade' => 'A+',
                'status' => 'Completed',
                'remarks' => 'Excellent placement outcome.',
            ],
        ] as $data) {
            Assessment::updateOrCreate(
                [
                    'placement_id' => $placements[$data['student_no']]->id,
                    'assessment_date' => $data['assessment_date'],
                ],
                [
                    'score' => $data['score'],
                    'grade' => $data['grade'],
                    'status' => $data['status'],
                    'remarks' => $data['remarks'],
                ]
            );
        }

        foreach ([
            [
                'student_no' => 'ST001',
                'log_date' => '2026-11-01',
                'activity' => 'Built a responsive landing page component.',
                'learning_outcome' => 'Improved HTML structure and CSS layout skills.',
                'working_hours' => 8,
                'status' => 'Approved',
                'remarks' => 'Reviewed by mentor.',
            ],
            [
                'student_no' => 'ST001',
                'log_date' => '2026-11-02',
                'activity' => 'Connected the form to the demo API.',
                'learning_outcome' => 'Practiced fetching and submitting data.',
                'working_hours' => 7.5,
                'status' => 'Submitted',
                'remarks' => null,
            ],
            [
                'student_no' => 'ST002',
                'log_date' => '2026-11-03',
                'activity' => 'Created database migration for student profiles.',
                'learning_outcome' => 'Understood schema design and foreign keys.',
                'working_hours' => 6.5,
                'status' => 'Approved',
                'remarks' => 'Approved by lecturer.',
            ],
            [
                'student_no' => 'ST005',
                'log_date' => '2026-11-04',
                'activity' => 'Prepared weekly internship summary report.',
                'learning_outcome' => 'Improved reporting and reflection writing.',
                'working_hours' => 8,
                'status' => 'Rejected',
                'remarks' => 'Needs more detail on deliverables.',
            ],
        ] as $data) {
            DailyLogbook::updateOrCreate(
                [
                    'placement_id' => $placements[$data['student_no']]->id,
                    'log_date' => $data['log_date'],
                ],
                [
                    'activity' => $data['activity'],
                    'learning_outcome' => $data['learning_outcome'],
                    'working_hours' => $data['working_hours'],
                    'status' => $data['status'],
                    'remarks' => $data['remarks'],
                ]
            );
        }
    }
}
