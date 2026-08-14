<?php

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ClassCourseController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CompanyContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DailyLogbookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PlacementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentAcademicProfileController;
use App\Http\Controllers\StudentController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
    Route::resource('placements',PlacementController::class);
    Route::patch('placements/{placement}/status',[PlacementController::class, 'updateStatus'])->name('placements.status');
    Route::resource('company-contacts',CompanyContactController::class);
    Route::resource('assessments',AssessmentController::class);

    //logbooks
    Route::resource('daily-logbooks',DailyLogbookController::class);
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
    });

require __DIR__.'/auth.php';
