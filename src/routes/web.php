<?php

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\Admin\MonitoringFormTemplateController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AssessmentCriterionController;
use App\Http\Controllers\AssessmentRatingLevelController;
use App\Http\Controllers\AssessmentSectionController;
use App\Http\Controllers\AssessmentTemplateController;
use App\Http\Controllers\AssessmentVersionController;
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
use App\Http\Controllers\Lecturer\MonitoringController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerLogbookController;
use App\Http\Controllers\LecturerStudentController;
use App\Http\Controllers\PlacementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentAcademicProfileController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentEnrollmentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
    Route::resource(
        'student-enrollments',
        StudentEnrollmentController::class
    )->only([
        'create',
        'store',
    ]);

    Route::get('students/{student}/academic-profile', [StudentAcademicProfileController::class, 'show'])->name('students.academic-profile');
    Route::resource('companies', CompanyController::class);
    Route::resource('placements', PlacementController::class);
    Route::patch('placements/{placement}/status', [PlacementController::class, 'updateStatus'])->name('placements.status');
    Route::resource('company-contacts', CompanyContactController::class);
    Route::resource('assessments', AssessmentController::class);
    Route::resource('industry-supervisors', IndustrySupervisorController::class);
    Route::resource('lecturers', LecturerController::class);
    Route::resource('supervisors', SupervisorController::class);
    // assign supervisor
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

    // mentor - student
    Route::get(
        '/industry-supervisor/students',
        [IndustrySupervisorController::class, 'students']
    )->name('industry-supervisor.students');

    Route::resource('users', UserController::class);
});

Route::middleware([
    'auth',
    'role:Industry Mentor|Industry Supervisor',
    'permission:view daily logbooks',
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
        '/logbook-approvals/{dailyLogbook}',
        [IndustrySupervisorLogbookController::class, 'show']
    )->name('logbook-approvals.show');

    Route::post(
        '/logbook-approvals/{dailyLogbook}/approve',
        [IndustrySupervisorLogbookController::class, 'approve']
    )
        ->middleware('permission:approve daily logbooks')
        ->name('logbook-approvals.approve');

    Route::post(
        '/logbook-approvals/{dailyLogbook}/reject',
        [IndustrySupervisorLogbookController::class, 'reject']
    )
        ->middleware('permission:reject daily logbooks')
        ->name('logbook-approvals.reject');
});

// Lecturer
Route::middleware([
    'auth',
    'role:Lecturer',
])
    ->prefix('lecturer')
    ->name('lecturer.')
    ->group(function () {

        Route::get(
            '/students',
            [LecturerStudentController::class, 'index']
        )->name('students.index');

        Route::get(
            '/students/{student}/logbooks',
            [LecturerLogbookController::class, 'index']
        )->name('students.logbooks.index');

        Route::get(
            '/students/{student}/logbooks/{dailyLogbook}',
            [LecturerLogbookController::class, 'show']
        )->name('students.logbooks.show');
    });

// Pemantauan
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/monitoring-form-templates',
            [
                MonitoringFormTemplateController::class,
                'index',
            ]
        )->name(
            'monitoring-form-templates.index'
        );

        Route::post(
            '/monitoring-form-templates/create-version',
            [
                MonitoringFormTemplateController::class,
                'create',
            ]
        )->name(
            'monitoring-form-templates.create'
        );

        Route::get(
            '/monitoring-form-templates/{monitoringFormTemplate}/edit',
            [
                MonitoringFormTemplateController::class,
                'edit',
            ]
        )->name(
            'monitoring-form-templates.edit'
        );

        Route::put(
            '/monitoring-form-templates/{monitoringFormTemplate}',
            [
                MonitoringFormTemplateController::class,
                'update',
            ]
        )->name(
            'monitoring-form-templates.update'
        );

        Route::post(
            '/monitoring-form-templates/{monitoringFormTemplate}/activate',
            [
                MonitoringFormTemplateController::class,
                'activate',
            ]
        )->name(
            'monitoring-form-templates.activate'
        );
    });

Route::middleware('auth')
    ->prefix('lecturer')
    ->name('lecturer.')
    ->group(function () {

        Route::get(
            '/monitoring',
            [MonitoringController::class, 'index']
        )->name('monitoring.index');

        Route::get(
            '/monitoring/visit/{visit}',
            [MonitoringController::class, 'indexVisit']
        )->name('monitoring.visit');

        Route::get(
            '/monitoring/student/{student}',
            [MonitoringController::class, 'student']
        )->name('monitoring.student');

        // Route::get(
        //     '/monitoring/student/{student}/{monitoringNo}/create',
        //     [MonitoringController::class, 'create']
        // )->name('monitoring.create');

        Route::get(
            '/monitoring/student/{monitoringNo}/create',
            [MonitoringController::class, 'create']
        )->name('monitoring.create');

        Route::post(
            '/monitoring/student/{monitoringNo}',
            [MonitoringController::class, 'store']
        )->name('monitoring.store');

        Route::get(
            '/monitoring/{monitoring}',
            [MonitoringController::class, 'show']
        )->name('monitoring.show');
    });

// Assessment Template
Route::middleware('auth')->group(function () {

        Route::resource('assessment-templates', AssessmentTemplateController::class);
        Route::post(
    'assessment-sections/{section}/criteria',
    [AssessmentCriterionController::class, 'store']
)->name('assessment-sections.criteria.store');

// Route::put(
//     'assessment-criteria/{criterion}',
//     [AssessmentCriterionController::class, 'update']
// )->name('assessment-criteria.update');

// Route::delete(
//     'assessment-criteria/{criterion}',
//     [AssessmentCriterionController::class, 'destroy']
// )->name('assessment-criteria.destroy');
});

Route::prefix('assessment-templates/{assessmentTemplate}')
    ->group(function () {

        Route::get(
            'versions',
            [AssessmentVersionController::class, 'index']
        )->name('assessment-versions.index');

        Route::get(
            'versions/create',
            [AssessmentVersionController::class, 'create']
        )->name('assessment-versions.create');

        Route::post(
            'versions',
            [AssessmentVersionController::class, 'store']
        )->name('assessment-versions.store');

        Route::get(
            'versions/{assessmentVersion}',
            [AssessmentVersionController::class, 'show']
        )->name('assessment-versions.show');

        Route::get(
            'versions/{assessmentVersion}/edit',
            [AssessmentVersionController::class, 'edit']
        )->name('assessment-versions.edit');

        Route::put(
            'versions/{assessmentVersion}',
            [AssessmentVersionController::class, 'update']
        )->name('assessment-versions.update');

        Route::post(
            'versions/{assessmentVersion}/publish',
            [AssessmentVersionController::class, 'publish']
        )->name('assessment-versions.publish');

        Route::post(
            'versions/{assessmentVersion}/unpublish',
            [AssessmentVersionController::class, 'unpublish']
        )->name('assessment-versions.unpublish');

        Route::prefix('versions/{assessmentVersion}')->group(function () {

            Route::get(
                'sections',
                [AssessmentSectionController::class, 'index']
            )->name('assessment-sections.index');

            Route::get(
                'sections/create',
                [AssessmentSectionController::class, 'create']
            )->name('assessment-sections.create');

            Route::post(
                'sections',
                [AssessmentSectionController::class, 'store']
            )->name('assessment-sections.store');

            Route::get(
                'sections/{assessmentSection}',
                [AssessmentSectionController::class, 'show']
            )->name('assessment-sections.show');

            Route::get(
                'sections/{assessmentSection}/edit',
                [AssessmentSectionController::class, 'edit']
            )->name('assessment-sections.edit');

            Route::put(
                'sections/{assessmentSection}',
                [AssessmentSectionController::class, 'update']
            )->name('assessment-sections.update');

        });
    });


Route::prefix(
    'assessment-templates/{assessmentTemplate}/versions/{assessmentVersion}/sections/{assessmentSection}'
)->group(function () {

    Route::get(
        'criteria',
        [AssessmentCriterionController::class, 'index']
    )->name('assessment-criteria.index');

    Route::get(
        'criteria/create',
        [AssessmentCriterionController::class, 'create']
    )->name('assessment-criteria.create');

    Route::post(
        'criteria',
        [AssessmentCriterionController::class, 'store']
    )->name('assessment-criteria.store');

    Route::get(
        'criteria/{assessmentCriterion}',
        [AssessmentCriterionController::class, 'show']
    )->name('assessment-criteria.show');

    Route::get(
        'criteria/{assessmentCriterion}/edit',
        [AssessmentCriterionController::class, 'edit']
    )->name('assessment-criteria.edit');

    Route::put(
        'criteria/{assessmentCriterion}',
        [AssessmentCriterionController::class, 'update']
    )->name('assessment-criteria.update');

    Route::delete(
        'criteria/{assessmentCriterion}',
        [AssessmentCriterionController::class, 'destroy']
    )->name('assessment-criteria.destroy');
});

Route::prefix(
    'assessment-templates/{assessmentTemplate}/versions/{assessmentVersion}/sections/{assessmentSection}/criteria/{assessmentCriterion}'
)->group(function () {

    Route::get(
        'ratings',
        [AssessmentRatingLevelController::class, 'index']
    )->name('assessment-rating-levels.index');

    Route::get(
        'ratings/create',
        [AssessmentRatingLevelController::class, 'create']
    )->name('assessment-rating-levels.create');

    Route::post(
        'ratings',
        [AssessmentRatingLevelController::class, 'store']
    )->name('assessment-rating-levels.store');

    Route::get(
        'ratings/{assessmentRatingLevel}/edit',
        [AssessmentRatingLevelController::class, 'edit']
    )->name('assessment-rating-levels.edit');

    Route::put(
        'ratings/{assessmentRatingLevel}',
        [AssessmentRatingLevelController::class, 'update']
    )->name('assessment-rating-levels.update');

    Route::delete(
        'ratings/{assessmentRatingLevel}',
        [AssessmentRatingLevelController::class, 'destroy']
    )->name('assessment-rating-levels.destroy');


});

Route::get(
    'student-assessments',
    [StudentAssessmentController::class, 'index']
)->name('student-assessments.index');


Route::get(
    'admin/student-assessments/{assessmentVersion}/students',
    [StudentAssessmentController::class, 'adminStudents']
)->name('admin.student-assessments.students');

Route::get(
    'student-assessments/create',
    [StudentAssessmentController::class, 'create']
)->name('student-assessments.create');
Route::post(
    'student-assessments',
    [StudentAssessmentController::class, 'store']
)->name('student-assessments.store');
Route::get(
    'student-assessments/{studentAssessment}',
    [StudentAssessmentController::class, 'show']
)->name('student-assessments.show');
Route::post(
    'student-assessments/{studentAssessment}/scores',
    [StudentAssessmentController::class, 'saveScores']
)->name('student-assessments.scores.save');
Route::post(
    'student-assessments/{studentAssessment}/complete',
    [StudentAssessmentController::class, 'complete']
)->name('student-assessments.complete');

//admin assessment routes
Route::get(
    'admin/student-assessments',
    [StudentAssessmentController::class, 'adminIndex']
)->name('admin.student-assessments.index');

Route::get(
    'admin/student-assessments/{assessmentVersion}/students',
    [StudentAssessmentController::class, 'adminStudents']
)->name('admin.student-assessments.students');
Route::get(
    'admin/student-assessments/{studentAssessment}',
    [StudentAssessmentController::class, 'adminShow']
)->name('admin.student-assessments.show');
Route::get(
    'admin/student-assessments/{studentAssessment}/print',
    [StudentAssessmentController::class, 'adminPrint']
)->name('admin.student-assessments.print');

//Industry Mentor Assessment Routes
Route::get(
    'industry-supervisor/assessments',
    [StudentAssessmentController::class, 'mentorIndex']
)->name('industry-supervisor.assessments.index');



require __DIR__.'/auth.php';
