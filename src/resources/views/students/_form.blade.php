<div class="space-y-6">

    {{-- Class --}}
    <div>
        <label
            for="class_room_id"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
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
                    @selected(
                        old(
                            'class_room_id',
                            $student->class_room_id ?? ''
                        ) == $classRoom->id
                    )
                >
                    {{ $classRoom->code }} -
                    {{ $classRoom->name }}
                </option>

            @endforeach
        </select>

        @error('class_room_id')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <p class="mt-2 text-xs text-slate-500">
            Academic session, semester and programme are determined by the selected class.
        </p>
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


    {{-- Student Number --}}
    <div>

        <label
            for="student_no"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Student Number
        </label>

        <input
            id="student_no"
            type="text"
            name="student_no"
            value="{{ old('student_no', $student->student_no ?? '') }}"
            placeholder="e.g. STU0001"
            maxlength="50"
            required
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 uppercase focus:border-blue-500 focus:ring-blue-500"
        >

        @error('student_no')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- Name --}}
    <div>

        <label
            for="name"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Student Name
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $student->name ?? '') }}"
            placeholder="Enter student's full name"
            maxlength="150"
            required
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

        @error('name')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>


    {{-- IC + Phone --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>

            <label
                for="ic_no"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                IC Number
            </label>

            <input
                id="ic_no"
                type="text"
                name="ic_no"
                value="{{ old('ic_no', $student->ic_no ?? '') }}"
                placeholder="e.g. 900101-01-1234"
                maxlength="20"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('ic_no')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        <div>

            <label
                for="phone"
                class="block text-sm font-medium text-slate-700 mb-2"
            >
                Phone Number
            </label>

            <input
                id="phone"
                type="text"
                name="phone"
                value="{{ old('phone', $student->phone ?? '') }}"
                placeholder="e.g. 012-3456789"
                maxlength="30"
                class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
            >

            @error('phone')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>


    {{-- Email --}}
    <div>

        <label
            for="email"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Email
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $student->email ?? '') }}"
            placeholder="student@example.com"
            maxlength="150"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

        @error('email')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

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
                        $student->status ?? true
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


{{-- Class information --}}
@php
    $classInformation = $classRooms->map(function ($classRoom) {
        return [
            'id' => $classRoom->id,
            'academic_session' => $classRoom->academicSession?->name,
            'semester' => $classRoom->semester
                ? $classRoom->semester->code . ' - ' . $classRoom->semester->name
                : null,
            'programme' => $classRoom->programme
                ? $classRoom->programme->code . ' - ' . $classRoom->programme->name
                : null,
        ];
    })->values();
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const classSelect = document.getElementById('class_room_id');
        const information = document.getElementById('class-information');
        const academicSessionName = document.getElementById('academic-session-name');
        const semesterName = document.getElementById('semester-name');
        const programmeName = document.getElementById('programme-name');

        const classes = @json($classInformation);

        function updateClassInformation() {
            const selectedId = classSelect.value;
            const selectedClass = classes.find(function (item) {
                return String(item.id) === String(selectedId);
            });

            if (!selectedClass) {
                information.classList.add('hidden');

                academicSessionName.textContent = '-';
                semesterName.textContent = '-';
                programmeName.textContent = '-';

                return;
            }

            academicSessionName.textContent = selectedClass.academic_session ?? '-';
            semesterName.textContent = selectedClass.semester ?? '-';
            programmeName.textContent = selectedClass.programme ?? '-';

            information.classList.remove('hidden');
        }

        classSelect.addEventListener('change', updateClassInformation);

        updateClassInformation();
    });
</script>





