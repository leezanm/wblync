<div class="space-y-6">

    {{-- Student --}}
    <div>
        <label
            for="student_id"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Student
        </label>

        <select
            id="student_id"
            name="student_id"
            required
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >
            <option value="">Select student</option>

            @foreach ($students as $student)

                <option
                    value="{{ $student->id }}"
                    data-class-room-id="{{ $student->class_room_id }}"
                    @selected(
                        old(
                            'student_id',
                            $enrollment->student_id ?? ''
                        ) == $student->id
                    )
                >
                    {{ $student->student_no }}
                    -
                    {{ $student->name }}
                </option>

            @endforeach

        </select>

        @error('student_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Student Academic Information --}}
    <div
        id="student-information"
        class="hidden rounded-xl border border-blue-100 bg-blue-50 p-5"
    >

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div>
                <p class="text-xs font-medium text-slate-500">
                    Class
                </p>

                <p
                    id="student-class"
                    class="mt-1 text-sm font-semibold text-slate-800"
                >
                    -
                </p>
            </div>


            <div>
                <p class="text-xs font-medium text-slate-500">
                    Academic Session
                </p>

                <p
                    id="student-session"
                    class="mt-1 text-sm font-semibold text-slate-800"
                >
                    -
                </p>
            </div>


            <div>
                <p class="text-xs font-medium text-slate-500">
                    Semester
                </p>

                <p
                    id="student-semester"
                    class="mt-1 text-sm font-semibold text-slate-800"
                >
                    -
                </p>
            </div>


            <div>
                <p class="text-xs font-medium text-slate-500">
                    Programme
                </p>

                <p
                    id="student-programme"
                    class="mt-1 text-sm font-semibold text-slate-800"
                >
                    -
                </p>
            </div>

        </div>

    </div>


    {{-- Course --}}
    <div>

        <label
            for="class_course_id"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Course
        </label>

        <select
            id="class_course_id"
            name="class_course_id"
            required
            disabled
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500 disabled:bg-slate-100 disabled:text-slate-400"
        >
            <option value="">
                Select student first
            </option>
        </select>

        @error('class_course_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <p class="mt-2 text-xs text-slate-500">
            Only courses assigned to the student's class are available.
        </p>

    </div>


    {{-- Status --}}
    <div>

        <label class="inline-flex items-center gap-3 cursor-pointer">

            <input
                type="hidden"
                name="status"
                value="0"
            >

            <input
                type="checkbox"
                name="status"
                value="1"
                @checked(
                    old(
                        'status',
                        $enrollment->status ?? true
                    )
                )
                class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
            >

            <span class="text-sm font-medium text-slate-700">
                Active
            </span>

        </label>

        @error('status')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const studentSelect =
        document.getElementById('student_id');

    const courseSelect =
        document.getElementById('class_course_id');

    const studentInformation =
        document.getElementById('student-information');

    const studentClass =
        document.getElementById('student-class');

    const studentSession =
        document.getElementById('student-session');

    const studentSemester =
        document.getElementById('student-semester');

    const studentProgramme =
        document.getElementById('student-programme');


    /*
    |--------------------------------------------------------------------------
    | Laravel data
    |--------------------------------------------------------------------------
    */

    const students = {!! $students->map(fn ($student) => [
        'id' => $student->id,
        'class_room_id' => $student->class_room_id,

        'class' => $student->classRoom
            ? $student->classRoom->code . ' - ' . $student->classRoom->name
            : null,

        'session' => $student->classRoom?->academicSession?->name,

        'semester' => $student->classRoom?->semester
            ? $student->classRoom->semester->code
                . ' - '
                . $student->classRoom->semester->name
            : null,

        'programme' => $student->classRoom?->programme
            ? $student->classRoom->programme->code
                . ' - '
                . $student->classRoom->programme->name
            : null,
    ])->values()->toJson() !!};


    const classCourses = {!! $classCourses->map(fn ($classCourse) => [
        'id' => $classCourse->id,

        'class_room_id' =>
            $classCourse->class_room_id,

        'course_code' =>
            $classCourse->course?->code,

        'course_name' =>
            $classCourse->course?->name,

        'credit_hours' =>
            $classCourse->course?->credit_hours,
    ])->values()->toJson() !!};


    const selectedClassCourse =
        @json(
            old(
                'class_course_id',
                $enrollment->class_course_id ?? ''
            )
        );


    /*
    |--------------------------------------------------------------------------
    | Student Information
    |--------------------------------------------------------------------------
    */

    function updateStudentInformation(student) {

        if (!student) {

            studentInformation.classList.add('hidden');

            studentClass.textContent = '-';
            studentSession.textContent = '-';
            studentSemester.textContent = '-';
            studentProgramme.textContent = '-';

            return;
        }


        studentClass.textContent =
            student.class ?? '-';

        studentSession.textContent =
            student.session ?? '-';

        studentSemester.textContent =
            student.semester ?? '-';

        studentProgramme.textContent =
            student.programme ?? '-';

        studentInformation.classList.remove('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | Load Courses
    |--------------------------------------------------------------------------
    */

    function loadCourses(
        classRoomId,
        selectedId = null
    ) {

        courseSelect.innerHTML =
            '<option value="">Select course</option>';

        courseSelect.disabled = true;


        if (!classRoomId) {

            courseSelect.innerHTML =
                '<option value="">Select student first</option>';

            return;
        }


        const availableCourses =
            classCourses.filter(function (classCourse) {

                return String(classCourse.class_room_id) ===
                    String(classRoomId);

            });


        availableCourses.forEach(function (classCourse) {

            const option =
                document.createElement('option');

            option.value =
                classCourse.id;


            option.textContent =
                `${classCourse.course_code} - ${classCourse.course_name}`;


            if (
                classCourse.credit_hours !== null &&
                classCourse.credit_hours !== undefined
            ) {

                option.textContent +=
                    ` (${classCourse.credit_hours} credit hours)`;

            }


            if (
                selectedId &&
                String(selectedId) ===
                    String(classCourse.id)
            ) {

                option.selected = true;

            }


            courseSelect.appendChild(option);

        });


        if (availableCourses.length === 0) {

            courseSelect.innerHTML =
                '<option value="">No courses assigned to this class</option>';

            courseSelect.disabled = true;

            return;
        }


        courseSelect.disabled = false;
    }


    /*
    |--------------------------------------------------------------------------
    | Update form
    |--------------------------------------------------------------------------
    */

    function updateForm(resetCourse = false) {

        const selectedOption =
            studentSelect.options[
                studentSelect.selectedIndex
            ];


        if (
            !selectedOption ||
            !selectedOption.value
        ) {

            updateStudentInformation(null);

            loadCourses(null);

            return;
        }


        const student =
            students.find(function (item) {

                return String(item.id) ===
                    String(selectedOption.value);

            });


        if (!student) {

            updateStudentInformation(null);

            loadCourses(null);

            return;
        }


        updateStudentInformation(student);


        loadCourses(
            student.class_room_id,
            resetCourse
                ? null
                : selectedClassCourse
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Student changed
    |--------------------------------------------------------------------------
    */

    studentSelect.addEventListener(
        'change',
        function () {

            updateForm(true);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Initial load
    |--------------------------------------------------------------------------
    */

    updateForm(false);

});
</script>
