<div class="space-y-6">

    {{-- Class --}}
    <div>
        <label for="class_room_id"
            class="block text-sm font-medium text-slate-700 mb-2">
            Class
        </label>

        <select
            id="class_room_id"
            name="class_room_id"
            required
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >
            <option value="">Select class</option>

            @foreach ($classRooms as $classRoom)
                <option
                    value="{{ $classRoom->id }}"
                    data-programme-id="{{ $classRoom->programme_id }}"
                    @selected(
                        old(
                            'class_room_id',
                            $classCourse->class_room_id ?? ''
                        ) == $classRoom->id
                    )
                >
                    {{ $classRoom->code }}
                    -
                    {{ $classRoom->name }}
                </option>
            @endforeach
        </select>

        @error('class_room_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>


    {{-- Class Information --}}
    <div
        id="class-information"
        class="hidden rounded-xl border border-blue-100 bg-blue-50 p-5"
    >
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div>
                <p class="text-xs font-medium text-slate-500">
                    Academic Session
                </p>

                <p
                    id="academic-session-name"
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
                    id="semester-name"
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
                    id="programme-name"
                    class="mt-1 text-sm font-semibold text-slate-800"
                >
                    -
                </p>
            </div>

        </div>
    </div>


    {{-- Course --}}
    <div>
        <label for="course_id"
            class="block text-sm font-medium text-slate-700 mb-2">
            Course
        </label>

        <select
            id="course_id"
            name="course_id"
            required
            disabled
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500 disabled:bg-slate-100 disabled:text-slate-400"
        >
            <option value="">
                Select class first
            </option>
        </select>

        @error('course_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <p class="mt-2 text-xs text-slate-500">
            Only courses belonging to the selected class programme are available.
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
                        $classCourse->status ?? true
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

    const classSelect = document.getElementById('class_room_id');
    const courseSelect = document.getElementById('course_id');

    const classInformation =
        document.getElementById('class-information');

    const academicSessionName =
        document.getElementById('academic-session-name');

    const semesterName =
        document.getElementById('semester-name');

    const programmeName =
        document.getElementById('programme-name');


    /*
    |--------------------------------------------------------------------------
    | Data from Laravel
    |--------------------------------------------------------------------------
    */

    const classes = {!! $classRooms->map(fn ($classRoom) => [
        'id' => $classRoom->id,
        'programme_id' => $classRoom->programme_id,
        'academic_session' => $classRoom->academicSession?->name,
        'semester' => $classRoom->semester
            ? $classRoom->semester->code . ' - ' . $classRoom->semester->name
            : null,
        'programme' => $classRoom->programme
            ? $classRoom->programme->code . ' - ' . $classRoom->programme->name
            : null,
    ])->values()->toJson() !!};


    const courses = {!! $courses->map(fn ($course) => [
        'id' => $course->id,
        'programme_id' => $course->programme_id,
        'code' => $course->code,
        'name' => $course->name,
        'credit_hours' => $course->credit_hours,
    ])->values()->toJson() !!};


    const selectedCourse =
        @json(old('course_id', $classCourse->course_id ?? ''));


    /*
    |--------------------------------------------------------------------------
    | Update Class Information
    |--------------------------------------------------------------------------
    */

    function updateClassInformation(selectedClass) {

        if (!selectedClass) {

            classInformation.classList.add('hidden');

            academicSessionName.textContent = '-';
            semesterName.textContent = '-';
            programmeName.textContent = '-';

            return;
        }

        academicSessionName.textContent =
            selectedClass.academic_session ?? '-';

        semesterName.textContent =
            selectedClass.semester ?? '-';

        programmeName.textContent =
            selectedClass.programme ?? '-';

        classInformation.classList.remove('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | Load Courses
    |--------------------------------------------------------------------------
    */

    function loadCourses(programmeId, selectedId = null) {

        courseSelect.innerHTML =
            '<option value="">Select course</option>';

        courseSelect.disabled = true;


        if (!programmeId) {

            courseSelect.innerHTML =
                '<option value="">Select class first</option>';

            return;
        }


        const availableCourses = courses.filter(function (course) {

            return String(course.programme_id) ===
                String(programmeId);

        });


        availableCourses.forEach(function (course) {

            const option =
                document.createElement('option');

            option.value = course.id;

            option.textContent =
                `${course.code} - ${course.name}`;


            if (
                course.credit_hours !== null &&
                course.credit_hours !== undefined
            ) {

                option.textContent +=
                    ` (${course.credit_hours} credit hours)`;

            }


            if (
                selectedId &&
                String(selectedId) === String(course.id)
            ) {

                option.selected = true;

            }


            courseSelect.appendChild(option);

        });


        if (availableCourses.length === 0) {

            courseSelect.innerHTML =
                '<option value="">No courses available for this programme</option>';

            courseSelect.disabled = true;

            return;
        }


        courseSelect.disabled = false;
    }


    /*
    |--------------------------------------------------------------------------
    | Update Form
    |--------------------------------------------------------------------------
    */

    function updateForm(resetCourse = false) {

        const selectedOption =
            classSelect.options[classSelect.selectedIndex];


        if (
            !selectedOption ||
            !selectedOption.value
        ) {

            updateClassInformation(null);

            loadCourses(null);

            return;
        }


        const programmeId =
            selectedOption.dataset.programmeId;


        const selectedClass =
            classes.find(function (item) {

                return String(item.id) ===
                    String(selectedOption.value);

            });


        updateClassInformation(selectedClass);


        loadCourses(
            programmeId,
            resetCourse ? null : selectedCourse
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Class Change
    |--------------------------------------------------------------------------
    */

    classSelect.addEventListener('change', function () {

        updateForm(true);

    });


    /*
    |--------------------------------------------------------------------------
    | Initial Load
    |--------------------------------------------------------------------------
    */

    updateForm(false);

});
</script>
