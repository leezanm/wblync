<x-app-layout>

    <div class="max-w-6xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Enroll Students
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Enroll existing students into the selected class and courses.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3">
                <p class="text-sm font-medium text-green-700">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                <ul class="list-disc space-y-1 pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form
            method="POST"
            action="{{ route('student-enrollments.store') }}"
            id="enrollmentForm"
        >
            @csrf


            {{-- ===================================================== --}}
            {{-- 1. CLASS --}}
            {{-- ===================================================== --}}

            <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        1. Select Class
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        The session, semester, and programme will be filled automatically based on the selected class.
                    </p>
                </div>


                <div>
                    <label
                        for="class_room_id"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Class <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="class_room_id"
                        name="class_room_id"
                        required
                        class="w-full rounded-xl border-gray-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">
                            -- Select Class --
                        </option>

                        @foreach ($classRooms as $classRoom)
                            <option
                                value="{{ $classRoom->id }}"
                                @selected(old('class_room_id') == $classRoom->id)
                            >
                                {{ $classRoom->code }} - {{ $classRoom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Class Information --}}
                <div
                    id="classInformation"
                    class="mt-5 hidden grid-cols-1 gap-4 md:grid-cols-3"
                >

                    {{-- Session --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Academic Session
                        </p>

                        <p
                            id="academicSession"
                            class="mt-1 font-semibold text-gray-900"
                        >
                            -
                        </p>

                    </div>


                    {{-- Semester --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Semester
                        </p>

                        <p
                            id="semester"
                            class="mt-1 font-semibold text-gray-900"
                        >
                            -
                        </p>

                    </div>


                    {{-- Programme --}}
                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                            Programme
                        </p>

                        <p
                            id="programme"
                            class="mt-1 font-semibold text-gray-900"
                        >
                            -
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- 2. COURSE --}}
            {{-- ===================================================== --}}

            <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        2. Select Courses
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Only courses available in the selected class will be displayed.
                    </p>
                </div>


                <div
                    id="courseContainer"
                    class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6"
                >
                    <p class="text-center text-sm text-gray-500">
                        Please select a class first.
                    </p>
                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- 3. STUDENT --}}
            {{-- ===================================================== --}}

            <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="mb-5">

                    <h2 class="text-lg font-semibold text-gray-900">
                        3. Select Students
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Search by name or student number. Students from previous semesters can also be selected.
                    </p>

                </div>


                {{-- Search --}}
                <div class="mb-4">

                    <div class="relative">

                        <input
                            type="text"
                            id="studentSearch"
                            placeholder="Search by name or student no..."
                            autocomplete="off"
                            class="w-full rounded-xl border-gray-300 py-3 pl-10 pr-4 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        <svg
                            class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                            />
                        </svg>

                    </div>

                </div>


                {{-- Student Toolbar --}}
                <div class="mb-3 flex flex-wrap items-center justify-between gap-3">

                    <label class="flex cursor-pointer items-center gap-2">

                        <input
                            type="checkbox"
                            id="selectAllStudents"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        >

                        <span class="text-sm font-medium text-gray-700">
                            Select all
                        </span>

                    </label>


                    <span
                        id="selectedStudentCount"
                        class="text-sm font-semibold text-indigo-600"
                    >
                        0 students selected
                    </span>

                </div>


                {{-- Student List --}}
                <div
                    id="studentContainer"
                    class="max-h-[450px] space-y-2 overflow-y-auto rounded-xl border border-gray-200 p-2"
                >
                    <div class="p-8 text-center">

                        <p class="text-sm text-gray-500">
                            Please select a class first.
                        </p>

                    </div>
                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- ACTION --}}
            {{-- ===================================================== --}}

            <div class="flex items-center justify-end gap-3">

                <a
                    href="{{ url()->previous() }}"
                    class="rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    id="submitButton"
                    disabled
                    class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-blue-300 disabled:text-white disabled:hover:bg-blue-300"
                >
                    Enroll Students
                </button>

            </div>

        </form>

    </div>


    {{-- ============================================================= --}}
    {{-- DATA --}}
    {{-- ============================================================= --}}

    @php

        $classRoomPayload = $classRooms->map(function ($classRoom) {

            return [
                'id' => $classRoom->id,
                'code' => $classRoom->code,
                'name' => $classRoom->name,

                'academic_session' =>
                    $classRoom->academicSession?->name ?? '-',

                'semester' =>
                    $classRoom->semester?->name ?? '-',

                'programme' =>
                    $classRoom->programme?->name ?? '-',

                'courses' => $classRoom->classCourses
                    ->where('status', 1)
                    ->map(function ($classCourse) {

                        return [
                            'id' => $classCourse->id,

                            'course_name' =>
                                $classCourse->course?->name
                                ?? 'Course #' . $classCourse->course_id,

                            'course_code' =>
                                $classCourse->course?->code ?? '',
                        ];

                    })
                    ->values()
                    ->all(),
            ];

        })->values()->all();


        $studentPayload = $students->map(function ($student) {

            return [
                'id' => $student->id,
                'student_no' => $student->student_no,
                'name' => $student->name,
            ];

        })->values()->all();

    @endphp


    {{-- ============================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ============================================================= --}}

    <script>

        const classRooms = @json($classRoomPayload);

        const students = @json($studentPayload);


        const classSelect =
            document.getElementById('class_room_id');

        const classInformation =
            document.getElementById('classInformation');

        const academicSession =
            document.getElementById('academicSession');

        const semester =
            document.getElementById('semester');

        const programme =
            document.getElementById('programme');

        const courseContainer =
            document.getElementById('courseContainer');

        const studentContainer =
            document.getElementById('studentContainer');

        const studentSearch =
            document.getElementById('studentSearch');

        const selectAllStudents =
            document.getElementById('selectAllStudents');

        const selectedStudentCount =
            document.getElementById('selectedStudentCount');

        const submitButton =
            document.getElementById('submitButton');


        /*
        |--------------------------------------------------------------------------
        | Selected students
        |--------------------------------------------------------------------------
        |
        | Keep selected student IDs so the selection remains intact
        | when the user performs a search.
        |
        */

        let selectedStudentIds = new Set();


        /*
        |--------------------------------------------------------------------------
        | CLASS CHANGE
        |--------------------------------------------------------------------------
        */

        classSelect.addEventListener('change', function () {

            const classId = Number(this.value);

            const selectedClass =
                classRooms.find(
                    classroom => classroom.id === classId
                );


            if (!selectedClass) {

                classInformation.classList.add('hidden');
                classInformation.classList.remove('grid');


                courseContainer.innerHTML = `
                    <div class="p-6 text-center">
                        <p class="text-sm text-gray-500">
                            Please select a class first.
                        </p>
                    </div>
                `;


                studentContainer.innerHTML = `
                    <div class="p-8 text-center">
                        <p class="text-sm text-gray-500">
                            Please select a class first.
                        </p>
                    </div>
                `;


                selectedStudentIds.clear();

                updateSelectedStudentCount();

                updateSubmitButton();

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | CLASS INFORMATION
            |--------------------------------------------------------------------------
            */

            classInformation.classList.remove('hidden');
            classInformation.classList.add('grid');


            academicSession.textContent =
                selectedClass.academic_session;


            semester.textContent =
                selectedClass.semester;


            programme.textContent =
                selectedClass.programme;


            /*
            |--------------------------------------------------------------------------
            | COURSES
            |--------------------------------------------------------------------------
            */

            renderCourses(
                selectedClass.courses
            );


            /*
            |--------------------------------------------------------------------------
            | STUDENTS
            |--------------------------------------------------------------------------
            */

            renderStudents();

        });


        /*
        |--------------------------------------------------------------------------
        | RENDER COURSES
        |--------------------------------------------------------------------------
        */

        function renderCourses(courses)
        {

            if (!courses.length) {

                courseContainer.innerHTML = `
                    <div class="rounded-xl border border-red-200 bg-red-50 p-5">
                        <p class="text-sm text-red-600">
                            No active courses are available for this class.
                        </p>
                    </div>
                `;

                updateSubmitButton();

                return;
            }


            courseContainer.className =
                'space-y-2';


            courseContainer.innerHTML =
                courses.map(course => `

                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 bg-white p-4 transition hover:border-indigo-300 hover:bg-indigo-50"
                    >

                        <input
                            type="checkbox"
                            name="class_course_ids[]"
                            value="${course.id}"
                            class="course-checkbox h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        >


                        <div class="min-w-0">

                            <p class="text-sm font-semibold text-gray-900">

                                ${
                                    course.course_code
                                        ? course.course_code + ' - '
                                        : ''
                                }

                                ${course.course_name}

                            </p>

                        </div>

                    </label>

                `).join('');


            document
                .querySelectorAll('.course-checkbox')
                .forEach(checkbox => {

                    checkbox.addEventListener(
                        'change',
                        updateSubmitButton
                    );

                });


            updateSubmitButton();

        }


        /*
        |--------------------------------------------------------------------------
        | RENDER STUDENTS
        |--------------------------------------------------------------------------
        */

        function renderStudents()
        {

            const search =
                studentSearch.value
                    .trim()
                    .toLowerCase();


            const filteredStudents =
                students.filter(student => {

                    if (!search) {
                        return true;
                    }


                    return (

                        student.name
                            .toLowerCase()
                            .includes(search)

                        ||

                        student.student_no
                            .toLowerCase()
                            .includes(search)

                    );

                });


            if (!filteredStudents.length) {

                studentContainer.innerHTML = `
                    <div class="p-8 text-center">
                        <p class="text-sm text-gray-500">
                            No students found.
                        </p>
                    </div>
                `;

                selectAllStudents.checked = false;

                updateSelectedStudentCount();

                updateSubmitButton();

                return;
            }


            studentContainer.className =
                'max-h-[450px] space-y-2 overflow-y-auto rounded-xl border border-gray-200 p-2';


            studentContainer.innerHTML =
                filteredStudents.map(student => {

                    const checked =
                        selectedStudentIds.has(
                            student.id
                        );


                    return `

                        <label
                            class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 bg-white p-4 transition hover:border-indigo-300 hover:bg-indigo-50"
                        >

                            <input
                                type="checkbox"
                                value="${student.id}"
                                class="student-checkbox h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                ${checked ? 'checked' : ''}
                            >


                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-gray-900">
                                    ${student.name}
                                </p>


                                <p class="text-xs text-gray-500">
                                    ${student.student_no}
                                </p>

                            </div>

                        </label>

                    `;

                }).join('');


            document
                .querySelectorAll('.student-checkbox')
                .forEach(checkbox => {

                    checkbox.addEventListener(
                        'change',
                        function () {

                            const studentId =
                                Number(this.value);


                            if (this.checked) {

                                selectedStudentIds.add(
                                    studentId
                                );

                            } else {

                                selectedStudentIds.delete(
                                    studentId
                                );

                            }


                            updateSelectedStudentCount();

                            updateSelectAllState();

                            updateSubmitButton();

                        }
                    );

                });


            updateSelectAllState();

            updateSelectedStudentCount();

            updateSubmitButton();

        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        studentSearch.addEventListener(
            'input',
            function () {

                renderStudents();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | SELECT ALL
        |--------------------------------------------------------------------------
        */

        selectAllStudents.addEventListener(
            'change',
            function () {

                const search =
                    studentSearch.value
                        .trim()
                        .toLowerCase();


                const visibleStudents =
                    students.filter(student => {

                        if (!search) {
                            return true;
                        }


                        return (

                            student.name
                                .toLowerCase()
                                .includes(search)

                            ||

                            student.student_no
                                .toLowerCase()
                                .includes(search)

                        );

                    });


                visibleStudents.forEach(student => {

                    if (this.checked) {

                        selectedStudentIds.add(
                            student.id
                        );

                    } else {

                        selectedStudentIds.delete(
                            student.id
                        );

                    }

                });


                renderStudents();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | SELECT ALL STATE
        |--------------------------------------------------------------------------
        */

        function updateSelectAllState()
        {

            const search =
                studentSearch.value
                    .trim()
                    .toLowerCase();


            const visibleStudents =
                students.filter(student => {

                    if (!search) {
                        return true;
                    }


                    return (

                        student.name
                            .toLowerCase()
                            .includes(search)

                        ||

                        student.student_no
                            .toLowerCase()
                            .includes(search)

                    );

                });


            if (!visibleStudents.length) {

                selectAllStudents.checked = false;

                selectAllStudents.indeterminate = false;

                return;
            }


            const selectedCount =
                visibleStudents.filter(
                    student =>
                        selectedStudentIds.has(
                            student.id
                        )
                ).length;


            selectAllStudents.checked =
                selectedCount ===
                visibleStudents.length;


            selectAllStudents.indeterminate =
                selectedCount > 0 &&
                selectedCount < visibleStudents.length;

        }


        /*
        |--------------------------------------------------------------------------
        | SELECTED STUDENT COUNT
        |--------------------------------------------------------------------------
        */

        function updateSelectedStudentCount()
        {

            const count =
                selectedStudentIds.size;


            selectedStudentCount.textContent =
                `${count} students selected`;

        }


        /*
        |--------------------------------------------------------------------------
        | SUBMIT BUTTON
        |--------------------------------------------------------------------------
        */

        function updateSubmitButton()
        {

            const classSelected =
                classSelect.value !== '';


            const coursesSelected =
                document.querySelectorAll(
                    '.course-checkbox:checked'
                ).length > 0;


            const studentsSelected =
                selectedStudentIds.size > 0;


            const canSubmit =
                classSelected &&
                coursesSelected &&
                studentsSelected;


            submitButton.disabled =
                !canSubmit;

        }


        /*
        |--------------------------------------------------------------------------
        | BEFORE SUBMIT
        |--------------------------------------------------------------------------
        |
        | Convert selectedStudentIds into hidden inputs.
        |
        */

        document
            .getElementById('enrollmentForm')
            .addEventListener(
                'submit',
                function () {

                    document
                        .querySelectorAll(
                            '.selected-student-input'
                        )
                        .forEach(
                            input => input.remove()
                        );


                    selectedStudentIds.forEach(
                        studentId => {

                            const input =
                                document.createElement(
                                    'input'
                                );


                            input.type = 'hidden';

                            input.name =
                                'student_ids[]';

                            input.value =
                                studentId;

                            input.className =
                                'selected-student-input';


                            this.appendChild(
                                input
                            );

                        }
                    );

                }
            );


        /*
        |--------------------------------------------------------------------------
        | OLD VALUE
        |--------------------------------------------------------------------------
        */

        @if (old('class_room_id'))

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    classSelect.dispatchEvent(
                        new Event('change')
                    );

                }
            );

        @endif

    </script>

</x-app-layout>
