<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\LecturerMonitoring;
use App\Models\MonitoringFormTemplate;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function index(Request $request): View
    {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $supervisors = $lecturer
            ->supervisors()
            ->with([
                'students' => function ($query) {
                    $query->whereHas('student.placements', function ($placementQuery) {
                        $placementQuery->where('status', 'Active');
                    });
                },
                'students.student.user',
            ])
            ->where('status', 'Active')
            ->get();

        $students = $supervisors
            ->flatMap(fn ($supervisor) => $supervisor->students->pluck('student'))
            ->filter()
            ->unique('id')
            ->values();

        return view(
            'lecturers.monitoring.index',
            compact('students')
        );
    }

    public function student(
        Request $request,
        Student $student
    ): View {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $this->ensureStudentBelongsToLecturer(
            $lecturer,
            $student
        );

        $monitorings = LecturerMonitoring::query()
            ->where('student_id', $student->id)
            ->whereHas('supervisor', function ($query) use ($lecturer) {
                $query->where(
                    'lecturer_id',
                    $lecturer->id
                );
            })
            ->with([
                'placement.company',
                'monitoringFormTemplate',
            ])
            ->orderBy('monitoring_no')
            ->get();

        return view(
            'lecturers.monitoring.student',
            compact(
                'student',
                'monitorings'
            )
        );
    }

    public function create(
        Request $request,
        Student $student,
        int $monitoringNo
    ): View {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $this->ensureStudentBelongsToLecturer(
            $lecturer,
            $student
        );

        abort_unless(
            in_array($monitoringNo, [1, 2, 3]),
            404
        );

        $existing = LecturerMonitoring::query()
            ->where('student_id', $student->id)
            ->where('monitoring_no', $monitoringNo)
            ->whereHas('supervisor', function ($query) use ($lecturer) {
                $query->where(
                    'lecturer_id',
                    $lecturer->id
                );
            })
            ->first();

        abort_if(
            $existing,
            409,
            'This monitoring has already been created.'
        );

        $template = MonitoringFormTemplate::query()
            ->where('status', 'Active')
            ->with([
                'sections.items.options',
            ])
            ->firstOrFail();

        return view(
            'lecturers.monitoring.create',
            compact(
                'student',
                'monitoringNo',
                'template'
            )
        );
    }

    public function store(
        Request $request,
        Student $student,
        int $monitoringNo
    ): RedirectResponse {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $this->ensureStudentBelongsToLecturer(
            $lecturer,
            $student
        );

        abort_unless(
            in_array($monitoringNo, [1, 2, 3]),
            404
        );

        $validated = $request->validate([
            'monitoring_date' => [
                'required',
                'date',
            ],

            'reported_to' => [
                'nullable',
                'boolean',
            ],

            'reported_at' => [
                'nullable',
                'date_format:H:i',
            ],

            'responses' => [
                'required',
                'array',
            ],

            'responses.*.option_id' => [
                'nullable',
                'integer',
            ],

            'responses.*.answer' => [
                'nullable',
                'string',
            ],
        ]);

        $template = MonitoringFormTemplate::query()
            ->where('status', 'Active')
            ->with([
                'sections.items.options',
            ])
            ->firstOrFail();

        $supervisor = $lecturer
            ->supervisors()
            ->whereHas('students', function ($query) use ($student) {
                $query->where(
                    'student_id',
                    $student->id
                );
            })
            ->where('status', 'Active')
            ->firstOrFail();

        $placement = $student->placements()
            ->where('status', 'Active')
            ->latest('id')
            ->first();

        abort_unless(
            $placement,
            422,
            'Active placement not found for this student.'
        );

        DB::transaction(function () use (
            $validated,
            $student,
            $supervisor,
            $placement,
            $template,
            $monitoringNo
        ) {
            $monitoring = LecturerMonitoring::create([
                'uuid' => (string) Str::uuid(),

                'supervisor_id' => $supervisor->id,

                'student_id' => $student->id,

                'placement_id' => $placement->id,

                'academic_session_id' =>
                    $placement->academic_session_id,

                /*
                 * Change this if Placement does not contain
                 * semester_id in your current schema.
                 */
                'semester_id' =>
                    $placement->semester_id,

                'monitoring_form_template_id' =>
                    $template->id,

                'monitoring_no' =>
                    $monitoringNo,

                'monitoring_date' =>
                    $validated['monitoring_date'],

                'reported_to' =>
                    $validated['reported_to'] ?? false,

                'reported_at' =>
                    $validated['reported_at'] ?? null,

                'status' =>
                    'Completed',
            ]);

            foreach (
                $template->sections
                    ->flatMap->items as $item
            ) {

                $response =
                    $validated['responses'][$item->id]
                    ?? [];

                $optionId =
                    $response['option_id']
                    ?? null;

                $answer =
                    $response['answer']
                    ?? null;

                $monitoring->responses()->create([
                    'item_id' => $item->id,
                    'option_id' => $optionId,
                    'answer' => $answer,
                ]);
            }
        });

        return redirect()
            ->route(
                'lecturers.monitoring.student',
                $student
            )
            ->with(
                'success',
                "Monitoring {$monitoringNo} saved successfully."
            );
    }


public function show(
    Request $request,
    LecturerMonitoring $monitoring
    ): View {
        $lecturer = $request->user()->lecturer;

        abort_unless(
            $lecturer,
            403,
            'Lecturer profile not found.'
        );

        $monitoring->load([
            'student',
            'placement.company',
            'monitoringFormTemplate.sections.items.options',
            'responses',
        ]);

        $belongsToLecturer = $monitoring
            ->supervisor()
            ->where('lecturer_id', $lecturer->id)
            ->where('status', 'Active')
            ->exists();

        abort_unless(
            $belongsToLecturer,
            403,
            'You are not authorised to view this monitoring.'
        );

        return view(
            'lecturers.monitoring.show',
            compact('monitoring')
        );
    }
    
    private function ensureStudentBelongsToLecturer(
        $lecturer,
        Student $student
    ): void {
        $exists = $lecturer
            ->supervisors()
            ->whereHas('students', function ($query) use ($student) {
                $query->where(
                    'student_id',
                    $student->id
                )->whereHas('student.placements', function ($placementQuery) {
                    $placementQuery->where('status', 'Active');
                });
            })
            ->where('status', 'Active')
            ->exists();

        abort_unless(
            $exists,
            403,
            'You are not authorised to monitor this student.'
        );
    }
}
