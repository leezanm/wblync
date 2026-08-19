<?php

namespace App\Http\Controllers;

use App\Models\AssessmentCriterion;
use App\Models\AssessmentRatingLevel;
use App\Models\AssessmentVersion;
use App\Models\Enrollment;
use App\Models\IndustrySupervisor;
use App\Models\Student;
use App\Models\StudentAssessment;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StudentAssessmentController extends Controller
{
    public function index()
    {
        $assessments = StudentAssessment::with([
            'student',
            'assessmentVersion.assessmentTemplate',
        ])
            ->where('assessor_id', auth()->id())
            ->where('assessor_type', 'INDUSTRY_MENTOR')
            ->latest()
            ->paginate(15);

        return view(
            'student-assessments.index',
            compact('assessments')
        );
    }

    public function adminIndex()
    {
        $assessmentVersions = AssessmentVersion::query()
            ->with([
                'assessmentTemplate.course',
            ])
            ->withCount([
                'studentAssessments as total_students_count',

                'studentAssessments as submitted_count' => function ($query) {
                    $query->where('status', 'Completed');
                },

                'studentAssessments as draft_count' => function ($query) {
                    $query->where('status', 'Draft');
                },
            ])
            ->whereHas('studentAssessments')
            ->latest('id')
            ->paginate(12);

        return view(
            'admin.student-assessments.index',
            compact('assessmentVersions')
        );
    }

    public function mentorIndex()
    {
        $studentAssessments = StudentAssessment::query()
            ->with([
                'student',
                'assessmentVersion.assessmentTemplate',
            ])
            ->where('assessor_type', 'INDUSTRY_MENTOR')
            ->where('assessor_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view(
            'industry-supervisors.assessments.index',
            compact('studentAssessments')
        );
    }

    public function create()
    {

        $industrySupervisorId = IndustrySupervisor::query()
            ->where('user_id', auth()->id())
            ->value('id');

        // student enrollment yang aktif sahaja under company mentor sahaja
        $enrollments = StudentEnrollment::with([
            'student',
            'academicSession',
            'semester',
            'classRoom',
        ])
            ->where('status', 'Active')
            ->whereHas('student.placements', function ($query) use ($industrySupervisorId) {
                $query->where('industry_supervisor_id', '=', $industrySupervisorId);
            })
            ->get();

        $courseRows = Enrollment::query()
            ->join(
                'class_courses',
                'class_courses.id',
                '=',
                'enrollments.class_course_id'
            )
            ->whereIn(
                'enrollments.student_id',
                $enrollments->pluck('student_id')->unique()->values()
            )
            ->whereIn(
                'class_courses.class_room_id',
                $enrollments->pluck('class_room_id')->unique()->values()
            )
            ->select([
                'enrollments.student_id',
                'class_courses.class_room_id',
                'class_courses.course_id',
            ])
            ->get();

        $courseIdsByStudentClass = $courseRows
            ->groupBy(fn ($row) => $row->student_id.'-'.$row->class_room_id)
            ->map(fn ($rows) => $rows->pluck('course_id')->unique()->values());

        $enrollmentCourseIds = $enrollments->mapWithKeys(function ($enrollment) use ($courseIdsByStudentClass) {
            $key = $enrollment->student_id.'-'.$enrollment->class_room_id;

            return [
                $enrollment->id => $courseIdsByStudentClass
                    ->get($key, collect())
                    ->values()
                    ->all(),
            ];
        });

        $relevantCourseIds = $enrollmentCourseIds
            ->flatten()
            ->unique()
            ->values();

        $assessmentVersions = AssessmentVersion::with(
            'assessmentTemplate.course'
        )
            ->where('status', 1)
            ->whereHas('assessmentTemplate', function ($query) use ($relevantCourseIds) {
                $query->whereIn('course_id', $relevantCourseIds);
            })
            ->get();

        return view(
            'student-assessments.create',
            compact(
                'enrollments',
                'assessmentVersions',
                'enrollmentCourseIds'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_enrollment_id' => [
                'required',
                'exists:student_enrollments,id',
            ],

            'assessment_version_id' => [
                'required',
                'exists:assessment_versions,id',
            ],

            'assessed_at' => [
                'nullable',
                'date',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $enrollment = StudentEnrollment::findOrFail(
            $validated['student_enrollment_id']
        );

        $version = AssessmentVersion::findOrFail(
            $validated['assessment_version_id']
        );

        $allowedCourseIds = Enrollment::query()
            ->join(
                'class_courses',
                'class_courses.id',
                '=',
                'enrollments.class_course_id'
            )
            ->where('enrollments.student_id', $enrollment->student_id)
            ->where('class_courses.class_room_id', $enrollment->class_room_id)
            ->pluck('class_courses.course_id')
            ->unique()
            ->values();

        $selectedAssessmentCourseId = (int) $version
            ->assessmentTemplate()
            ->value('course_id');

        if (! $allowedCourseIds->contains($selectedAssessmentCourseId)) {
            throw ValidationException::withMessages([
                'assessment_version_id' => 'Selected assessment is not valid for the selected student course.',
            ]);
        }

        $assessment = StudentAssessment::create([
            'uuid' => (string) Str::uuid(),

            'student_id' => $enrollment->student_id,

            'assessment_version_id' => $version->id,

            // Assessor berdasarkan user yang sedang login
            'assessor_type' => 'INDUSTRY_MENTOR',
            'assessor_id' => auth()->id(),

            'assessed_at' => $validated['assessed_at'] ?? now(),

            // Assessment baru sentiasa Draft
            'status' => 'Draft',

            'total_score' => 0,

            'percentage' => 0,

            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('student-assessments.show', $assessment)
            ->with(
                'success',
                'Student assessment created successfully.'
            );
    }

    public function show(StudentAssessment $studentAssessment)
    {
        if (
            $studentAssessment->assessor_id !== auth()->id()
            || $studentAssessment->assessor_type !== 'INDUSTRY_MENTOR'
        ) {
            abort(403);
        }

        $studentAssessment->load([
            'student',
            'assessmentVersion.assessmentTemplate.course',
            'assessmentVersion.sections.criteria.ratingLevels',
            'scores',
        ]);

        return view(
            'student-assessments.show',
            compact('studentAssessment')
        );
    }

    public function saveScores(
        Request $request,
        StudentAssessment $studentAssessment
    ) {

        if ($studentAssessment->status !== 'Draft') {
            return back()->with(
                'error',
                'This assessment has already been completed and cannot be edited.'
            );
        }
        $validated = $request->validate([
            'scores' => ['required', 'array'],

            'scores.*.assessment_criterion_id' => [
                'required',
                'integer',
                'exists:assessment_criteria,id',
            ],

            'scores.*.rating_level_id' => [
                'required',
                'integer',
                'exists:assessment_rating_levels,id',
            ],

            'scores.*.remark' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $studentAssessment
        ) {
            $totalScore = 0;

            foreach ($validated['scores'] as $scoreData) {

                $criterion = AssessmentCriterion::findOrFail(
                    $scoreData['assessment_criterion_id']
                );

                $rating = AssessmentRatingLevel::where(
                    'id',
                    $scoreData['rating_level_id']
                )
                    ->where(
                        'assessment_criterion_id',
                        $criterion->id
                    )
                    ->firstOrFail();

                $score = (float) $rating->score;

                $studentAssessment->scores()->updateOrCreate(
                    [
                        'assessment_criterion_id' => $criterion->id,
                    ],
                    [
                        'rating_level_id' => $rating->id,

                        'score' => $score,

                        'remark' => $scoreData['remark'] ?? null,
                    ]
                );

                $totalScore += $score;
            }

            $maxScore = (float) $studentAssessment
                ->assessmentVersion
                ->max_score;

            $percentage = $maxScore > 0
                ? ($totalScore / $maxScore) * 100
                : 0;

            $studentAssessment->update([
                'total_score' => $totalScore,
                'percentage' => round($percentage, 2),
            ]);
        });

        return redirect()
            ->route(
                'student-assessments.show',
                $studentAssessment
            )
            ->with(
                'success',
                'Assessment scores saved successfully.'
            );
    }

    public function complete(StudentAssessment $studentAssessment)
    {
        // Pastikan assessment masih Draft
        if ($studentAssessment->status !== 'Draft') {
            return back()->with(
                'error',
                'This assessment has already been completed.'
            );
        }

        // Pastikan semua criteria telah dinilai
        $studentAssessment->load([
            'assessmentVersion.sections.criteria',
            'scores',
        ]);

        $criteriaIds = $studentAssessment
            ->assessmentVersion
            ->sections
            ->flatMap(fn ($section) => $section->criteria)
            ->pluck('id');

        $scoredCriteriaIds = $studentAssessment
            ->scores
            ->pluck('assessment_criterion_id');

        $missingCriteria = $criteriaIds->diff($scoredCriteriaIds);

        if ($missingCriteria->isNotEmpty()) {
            return back()->with(
                'error',
                'Please complete all assessment criteria before submitting.'
            );
        }

        // Tukar Draft → Completed
        $studentAssessment->update([
            'status' => 'Completed',
        ]);

        return redirect()
            ->route(
                'student-assessments.show',
                $studentAssessment
            )
            ->with(
                'success',
                'Assessment completed successfully.'
            );
    }

    public function adminStudents(AssessmentVersion $assessmentVersion)
    {
        $assessmentVersion->load([
            'assessmentTemplate.course',
        ]);

        $studentAssessments = StudentAssessment::query()
            ->with([
                'student',
                'assessor',
            ])
            ->where('assessment_version_id', $assessmentVersion->id)
            ->latest()
            ->paginate(15);

        return view(
            'admin.student-assessments.students',
            compact(
                'assessmentVersion',
                'studentAssessments'
            )
        );
    }

    public function adminShow(StudentAssessment $studentAssessment)
    {
        $studentAssessment->load([
            'student',
            'assessmentVersion.assessmentTemplate.course',
            'assessmentVersion.sections.criteria.ratingLevels',
            'scores',
        ]);

        return view(
            'admin.student-assessments.show',
            compact('studentAssessment')
        );
    }

    public function adminPrint(StudentAssessment $studentAssessment)
    {

        // Load all necessary relationships for printing
        // student, template/course, sections/criteria/ratings, and scores
        $studentAssessment->load([
            'student',
            'student.user',
            'student.classRoom',
            'assessor.company',
            'assessmentVersion.assessmentTemplate.course',
            'assessmentVersion.sections.criteria.ratingLevels',
            'scores',
        ]);

        // dd($studentAssessment);
        return view(
            'admin.student-assessments.print',
            compact('studentAssessment')
        );
    }

    public function lecturerStudentAssessments(
        Request $request,
        Student $student
    ) {
        $this->abortIfLecturerNotSupervisingStudent(
            $request,
            $student->id
        );

        $studentAssessments = StudentAssessment::query()
            ->with([
                'assessmentVersion.assessmentTemplate.course',
                'assessor',
            ])
            ->where('student_id', $student->id)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'lecturers.students.assessments.index',
            compact(
                'student',
                'studentAssessments'
            )
        );
    }

    public function lecturerShow(
        Request $request,
        StudentAssessment $studentAssessment
    ) {
        $this->abortIfLecturerNotSupervisingStudent(
            $request,
            $studentAssessment->student_id
        );

        $studentAssessment->load([
            'student',
            'assessmentVersion.assessmentTemplate.course',
            'assessmentVersion.sections.criteria.ratingLevels',
            'scores',
        ]);

        return view(
            'admin.student-assessments.show',
            [
                'studentAssessment' => $studentAssessment,
                'printRouteName' => 'lecturer.student-assessments.print',
            ]
        );
    }

    public function lecturerPrint(
        Request $request,
        StudentAssessment $studentAssessment
    ) {
        $this->abortIfLecturerNotSupervisingStudent(
            $request,
            $studentAssessment->student_id
        );

        $studentAssessment->load([
            'student',
            'student.user',
            'student.classRoom',
            'assessor.company',
            'assessmentVersion.assessmentTemplate.course',
            'assessmentVersion.sections.criteria.ratingLevels',
            'scores',
        ]);

        return view(
            'admin.student-assessments.print',
            compact('studentAssessment')
        );
    }

    private function abortIfLecturerNotSupervisingStudent(
        Request $request,
        int $studentId
    ): void {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $isAssigned = $lecturer
            ->supervisors()
            ->whereHas('students', function ($query) use ($studentId) {
                $query
                    ->where('student_id', $studentId)
                    ->where('status', 'Active');
            })
            ->exists();

        abort_unless(
            $isAssigned,
            403,
            'You are not authorised to view this student.'
        );
    }
}
