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
use App\Models\IndustrySupervisor;
use App\Models\Lecturer;
use App\Models\Placement;
use App\Models\Programme;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\SupervisorStudent;
use App\Models\User;
use App\Models\WeeklyLogbookSubmission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
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

        $lecturerProfile = Lecturer::updateOrCreate(
            ['user_id' => $lecturer->id],
            [
                'staff_no' => 'L0001',
                'name' => 'WBL Lecturer',
                'email' => 'lecturer@wblync.test',
                'phone' => '011-20000001',
                'status' => 'Active',
            ]
        );

        $academicSessions = [];

        $hasWorkStatusColumn = Schema::hasColumn(
            'daily_logbooks',
            'work_status'
        );
        $hasWeeklySubmissionLinkColumn = Schema::hasColumn(
            'daily_logbooks',
            'weekly_logbook_submission_id'
        );

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

        $industrySupervisors = [];

        foreach ([
            [
                'company_code' => 'CMP001',
                'name' => 'Hafiz Roslan',
                'position' => 'Frontend Team Lead',
                'email' => 'hafiz.roslan@alphatech.test',
                'phone' => '012-3100001',
                'status' => 'Active',
                'user_id' => $mentor->id,
            ],
            [
                'company_code' => 'CMP002',
                'name' => 'Siti Nabila',
                'position' => 'Digital Marketing Manager',
                'email' => 'siti.nabila@bumidigital.test',
                'phone' => '012-3100002',
                'status' => 'Active',
                'user_id' => null,
            ],
            [
                'company_code' => 'CMP003',
                'name' => 'Faizal Hamid',
                'position' => 'Industry Supervisor',
                'email' => 'faizal@majumanufacturing.test',
                'phone' => '014-9000333',
                'status' => 'Active',
                'user_id' => null,
            ],
        ] as $data) {
            $industrySupervisors[$data['company_code']] = IndustrySupervisor::updateOrCreate(
                [
                    'company_id' => $companies[$data['company_code']]->id,
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'position' => $data['position'],
                    'phone' => $data['phone'],
                    'status' => $data['status'],
                    'user_id' => $data['user_id'],
                ]
            );
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
                'industry_supervisor_id' => $industrySupervisors[$data['company_code']]->id,
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

        $targetLecturers = collect([
            $lecturerProfile,
            Lecturer::query()->find(3),
        ])
            ->filter()
            ->unique('id');

        foreach ($targetLecturers as $targetLecturer) {
            $supervisor = Supervisor::updateOrCreate(
                [
                    'lecturer_id' => $targetLecturer->id,
                    'academic_session_id' => $academicSessions['AS2026-2027']->id,
                    'semester_id' => $semesters['SEM2026-1']->id,
                ],
                [
                    'status' => 'Active',
                ]
            );

            foreach ([
                'ST001',
                'ST002',
                'ST005',
            ] as $studentNo) {
                SupervisorStudent::updateOrCreate(
                    [
                        'supervisor_id' => $supervisor->id,
                        'student_id' => $students[$studentNo]->id,
                    ],
                    [
                        'assigned_at' => '2026-09-01 08:00:00',
                        'status' => 'Active',
                    ]
                );
            }
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
                'week_start_date' => '2026-11-02',
                'week_end_date' => '2026-11-08',
                'status' => 'Submitted',
                'submitted_at' => '2026-11-08 18:00:00',
                'reviewed_at' => null,
                'reviewed_by' => null,
                'remarks' => 'Week 1 ready for lecturer review.',
                'daily_logs' => [
                    [
                        'log_date' => '2026-11-02',
                        'work_status' => 'Working',
                        'activity' => 'Built a responsive landing page component for the company portal.',
                        'learning_outcome' => 'Improved Tailwind layouting and responsive UI implementation.',
                        'working_hours' => 8,
                        'status' => 'Submitted',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-03',
                        'work_status' => 'Working',
                        'activity' => 'Connected registration form to the internship demo API.',
                        'learning_outcome' => 'Practiced integrating frontend forms with backend endpoints.',
                        'working_hours' => 8,
                        'status' => 'Submitted',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-04',
                        'work_status' => 'Working',
                        'activity' => 'Fixed validation feedback and improved error messages in the student module.',
                        'learning_outcome' => 'Learned better form validation UX and debugging workflow.',
                        'working_hours' => 7.5,
                        'status' => 'Submitted',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-05',
                        'work_status' => 'Working',
                        'activity' => 'Prepared reusable Blade components for dashboard summary cards.',
                        'learning_outcome' => 'Understood component reuse and consistent UI structure.',
                        'working_hours' => 8,
                        'status' => 'Submitted',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-06',
                        'work_status' => 'Working',
                        'activity' => 'Documented tasks completed and submitted the weekly summary to mentor.',
                        'learning_outcome' => 'Improved technical reporting and weekly reflection writing.',
                        'working_hours' => 6.5,
                        'status' => 'Submitted',
                        'remarks' => null,
                    ],
                ],
            ],
            [
                'student_no' => 'ST001',
                'week_start_date' => '2026-11-09',
                'week_end_date' => '2026-11-15',
                'status' => 'Approved',
                'submitted_at' => '2026-11-15 17:45:00',
                'reviewed_at' => '2026-11-16 09:00:00',
                'reviewed_by' => $mentor->id,
                'remarks' => 'Good progress and clear documentation.',
                'daily_logs' => [
                    [
                        'log_date' => '2026-11-09',
                        'work_status' => 'Working',
                        'activity' => 'Implemented placement statistics widgets for the admin dashboard.',
                        'learning_outcome' => 'Improved understanding of data aggregation and KPI presentation.',
                        'working_hours' => 8,
                        'status' => 'Approved',
                        'remarks' => 'Well documented.',
                    ],
                    [
                        'log_date' => '2026-11-10',
                        'work_status' => 'Working',
                        'activity' => 'Added search and date filter to the daily logbook listing page.',
                        'learning_outcome' => 'Learned to combine query filters with user-friendly form controls.',
                        'working_hours' => 8,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-11',
                        'work_status' => 'Working',
                        'activity' => 'Refactored placement summary card to show mentor and academic session details.',
                        'learning_outcome' => 'Understood how to surface important context in a compact layout.',
                        'working_hours' => 7.5,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-12',
                        'work_status' => 'Working',
                        'activity' => 'Resolved a bug in weekly submission linkage for daily logbooks.',
                        'learning_outcome' => 'Improved schema troubleshooting and relation debugging skills.',
                        'working_hours' => 8,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-13',
                        'work_status' => 'Working',
                        'activity' => 'Presented sprint progress to mentor and captured improvement notes.',
                        'learning_outcome' => 'Practiced concise technical communication and follow-up actions.',
                        'working_hours' => 6,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                ],
            ],
            [
                'student_no' => 'ST002',
                'week_start_date' => '2026-11-16',
                'week_end_date' => '2026-11-22',
                'status' => 'Rejected',
                'submitted_at' => '2026-11-22 18:10:00',
                'reviewed_at' => '2026-11-23 10:00:00',
                'reviewed_by' => $mentor->id,
                'remarks' => 'Please add clearer deliverables and more specific learning outcomes.',
                'daily_logs' => [
                    [
                        'log_date' => '2026-11-16',
                        'work_status' => 'Working',
                        'activity' => 'Drafted campaign performance report for internship clients.',
                        'learning_outcome' => 'Improved report structuring and KPI interpretation.',
                        'working_hours' => 8,
                        'status' => 'Rejected',
                        'remarks' => 'Need more detail.',
                    ],
                    [
                        'log_date' => '2026-11-17',
                        'work_status' => 'Working',
                        'activity' => 'Updated social media content planner with weekly campaign entries.',
                        'learning_outcome' => 'Learned content scheduling and consistency planning.',
                        'working_hours' => 7.5,
                        'status' => 'Rejected',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-18',
                        'work_status' => 'Off Day',
                        'activity' => 'Off Day',
                        'learning_outcome' => 'Rest day recorded in logbook.',
                        'working_hours' => 0,
                        'status' => 'Rejected',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-19',
                        'work_status' => 'Working',
                        'activity' => 'Collected campaign reach data and updated the reporting spreadsheet.',
                        'learning_outcome' => 'Practiced tracking metrics and maintaining clean reporting data.',
                        'working_hours' => 8,
                        'status' => 'Rejected',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-20',
                        'work_status' => 'Working',
                        'activity' => 'Prepared revised campaign ideas for mentor feedback.',
                        'learning_outcome' => 'Strengthened idea justification and feedback incorporation.',
                        'working_hours' => 6.5,
                        'status' => 'Rejected',
                        'remarks' => null,
                    ],
                ],
            ],
            [
                'student_no' => 'ST005',
                'week_start_date' => '2026-11-23',
                'week_end_date' => '2026-11-29',
                'status' => 'Approved',
                'submitted_at' => '2026-11-29 17:20:00',
                'reviewed_at' => '2026-11-30 08:45:00',
                'reviewed_by' => $mentor->id,
                'remarks' => 'Strong reflection and complete weekly evidence.',
                'daily_logs' => [
                    [
                        'log_date' => '2026-11-23',
                        'work_status' => 'Working',
                        'activity' => 'Prepared weekly internship summary report for operations review.',
                        'learning_outcome' => 'Improved concise report writing and summary presentation.',
                        'working_hours' => 8,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-24',
                        'work_status' => 'Working',
                        'activity' => 'Updated stock movement records and checked document completeness.',
                        'learning_outcome' => 'Learned record accuracy and administrative control practices.',
                        'working_hours' => 8,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-25',
                        'work_status' => 'Public Holiday',
                        'activity' => 'Public Holiday',
                        'learning_outcome' => 'Holiday recorded for weekly log completeness.',
                        'working_hours' => 0,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-26',
                        'work_status' => 'Working',
                        'activity' => 'Assisted with data entry cleanup for supplier tracking.',
                        'learning_outcome' => 'Improved spreadsheet discipline and data verification habits.',
                        'working_hours' => 7.5,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                    [
                        'log_date' => '2026-11-27',
                        'work_status' => 'Working',
                        'activity' => 'Closed the week with a mentor review and action list for next week.',
                        'learning_outcome' => 'Practiced reflecting on work output and setting follow-up tasks.',
                        'working_hours' => 6.5,
                        'status' => 'Approved',
                        'remarks' => null,
                    ],
                ],
            ],
        ] as $weeklyData) {
            $submission = WeeklyLogbookSubmission::updateOrCreate(
                [
                    'placement_id' => $placements[$weeklyData['student_no']]->id,
                    'week_start_date' => $weeklyData['week_start_date'],
                ],
                [
                    'week_end_date' => $weeklyData['week_end_date'],
                    'status' => $weeklyData['status'],
                    'submitted_at' => $weeklyData['submitted_at'],
                    'reviewed_at' => $weeklyData['reviewed_at'],
                    'reviewed_by' => $weeklyData['reviewed_by'],
                    'remarks' => $weeklyData['remarks'],
                ]
            );

            foreach ($weeklyData['daily_logs'] as $logData) {
                $payload = [
                    'activity' => $logData['activity'],
                    'learning_outcome' => $logData['learning_outcome'],
                    'working_hours' => $logData['working_hours'],
                    'status' => $logData['status'],
                    'remarks' => $logData['remarks'],
                ];

                if ($hasWorkStatusColumn) {
                    $payload['work_status'] = $logData['work_status'];
                }

                if ($hasWeeklySubmissionLinkColumn) {
                    $payload['weekly_logbook_submission_id'] = $submission->id;
                }

                DailyLogbook::updateOrCreate(
                    [
                        'placement_id' => $placements[$weeklyData['student_no']]->id,
                        'log_date' => $logData['log_date'],
                    ],
                    $payload
                );
            }
        }
    }
}
