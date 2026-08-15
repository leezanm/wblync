<?php

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ClassCourseController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CompanyContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DailyLogbookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\IndustrySupervisorController;
use App\Http\Controllers\IndustrySupervisorLogbookController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\PlacementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentAcademicProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('password.change.edit');
    Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('password.change.update');

    // Academic Sessions
    Route::resource('academic-sessions', AcademicSessionController::class);
    Route::resource('semesters', SemesterController::class);
    Route::get(
        '/academic-sessions/{academicSession}/semesters',
        [SemesterController::class, 'byAcademicSession']
    )->name('academic-sessions.semesters');

    // Programmes
    Route::resource('programmes', ProgrammeController::class);
    // Courses
    Route::resource('courses', CourseController::class);
    // ClassRooms
    Route::resource('classes', ClassRoomController::class);
    // Students
    Route::resource('students', StudentController::class);
    // Class Courses
    Route::resource('class-courses', ClassCourseController::class);
    // enrollment
    Route::resource('enrollments', EnrollmentController::class);
    Route::get('students/{student}/academic-profile', [StudentAcademicProfileController::class, 'show'])->name('students.academic-profile');
    Route::resource('companies', CompanyController::class);
    Route::resource('placements', PlacementController::class);
    Route::patch('placements/{placement}/status', [PlacementController::class, 'updateStatus'])->name('placements.status');
    Route::resource('company-contacts', CompanyContactController::class);
    Route::resource('assessments', AssessmentController::class);
    Route::resource('industry-supervisors', IndustrySupervisorController::class);
    Route::resource('lecturers',LecturerController::class);
    Route::resource('supervisors',SupervisorController::class);
    //assign supervisor
    Route::get(
        'supervisors/{supervisor}/students/create',
        [SupervisorController::class, 'addStudent']
    )->name('supervisors.students.create');

    Route::post(
        'supervisors/{supervisor}/students',
        [SupervisorController::class, 'storeStudent']
    )->name('supervisors.students.store');

    // logbooks
    Route::resource('daily-logbooks', DailyLogbookController::class);
    Route::post(
        'daily-logbooks/{dailyLogbook}/submit',
        [DailyLogbookController::class, 'submit']
    )->name('daily-logbooks.submit');

    Route::post(
        'daily-logbooks/{dailyLogbook}/approve',
        [DailyLogbookController::class, 'approve']
    )->name('daily-logbooks.approve');

    Route::post(
        'daily-logbooks/{dailyLogbook}/reject',
        [DailyLogbookController::class, 'reject']
    )->name('daily-logbooks.reject');

    Route::post(
        '/daily-logbooks/submit-week',
        [DailyLogbookController::class, 'submitWeek']
    )->name('daily-logbooks.submit-week');


    //mentor - student
    Route::get(
        '/industry-supervisor/students',
        [IndustrySupervisorController::class, 'students']
    )->name('industry-supervisor.students');


    Route::resource('users', UserController::class);




});

Route::middleware([
    'auth',
    'role:Industry Mentor|Industry Supervisor',
    'permission:view weekly logbook approvals',
])->prefix('industry-supervisor')->name('industry-supervisor.')->group(function () {

    Route::get(
        '/logbook-approvals',
        [IndustrySupervisorLogbookController::class, 'index']
    )->name('logbook-approvals.index');

     Route::get(
    '/logbook-approvals/history',
    [IndustrySupervisorLogbookController::class, 'history']
    )->name('logbook-approvals.history');


    Route::get(
        '/logbook-approvals/{weeklyLogbookSubmission}',
        [IndustrySupervisorLogbookController::class, 'show']
    )->name('logbook-approvals.show');

    Route::post(
        '/logbook-approvals/{weeklyLogbookSubmission}/approve',
        [IndustrySupervisorLogbookController::class, 'approve']
    )
        ->middleware('permission:approve weekly logbooks')
        ->name('logbook-approvals.approve');

    Route::post(
        '/logbook-approvals/{weeklyLogbookSubmission}/reject',
        [IndustrySupervisorLogbookController::class, 'reject']
    )
        ->middleware('permission:reject weekly logbooks')
        ->name('logbook-approvals.reject');


});

require __DIR__.'/auth.php';
