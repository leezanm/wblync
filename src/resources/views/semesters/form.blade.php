<div class="grid grid-cols-1 gap-6 md:grid-cols-2">

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700">
            Semester Code
        </label>

        <input
            type="text"
            value="{{ old('code', $semester->code ?? ($nextCode ?? 'Auto generated')) }}"
            readonly
            disabled
            class="w-full cursor-not-allowed rounded-xl border-slate-300 bg-slate-100 text-slate-500"
        >

        <p class="mt-1 text-sm text-slate-500">
            Generated automatically in sequence starting from 0001.
        </p>
    </div>

    <div>
        <label for="academic_session_id" class="mb-2 block text-sm font-medium text-slate-700">
            Academic Session <span class="text-red-500">*</span>
        </label>

        <select
            id="academic_session_id"
            name="academic_session_id"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
        >
            <option value="">Select academic session</option>
            @foreach ($academicSessions as $academicSession)
                <option
                    value="{{ $academicSession->id }}"
                    @selected(old('academic_session_id', $semester->academic_session_id ?? '') == $academicSession->id)
                >
                    {{ $academicSession->name }}
                </option>
            @endforeach
        </select>

        @error('academic_session_id')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
            Semester Name <span class="text-red-500">*</span>
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $semester->name ?? '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
        >

        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="start_date" class="mb-2 block text-sm font-medium text-slate-700">
            Start Date <span class="text-red-500">*</span>
        </label>

        <input
            id="start_date"
            type="date"
            name="start_date"
            value="{{ old('start_date', isset($semester) ? $semester->start_date?->format('Y-m-d') : '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
        >

        @error('start_date')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="end_date" class="mb-2 block text-sm font-medium text-slate-700">
            End Date <span class="text-red-500">*</span>
        </label>

        <input
            id="end_date"
            type="date"
            name="end_date"
            value="{{ old('end_date', isset($semester) ? $semester->end_date?->format('Y-m-d') : '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
        >

        @error('end_date')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
            Status <span class="text-red-500">*</span>
        </label>

        <select
            id="status"
            name="status"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
        >
            @foreach (['Draft', 'Active', 'Closed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $semester->status ?? 'Draft') === $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        @error('status')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="inline-flex items-center gap-2">
            <input
                type="checkbox"
                name="current"
                value="1"
                @checked(old('current', $semester->current ?? false))
            >
            <span>Set as Current Semester</span>
        </label>
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-2 block text-sm font-medium text-slate-700">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="5"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
        >{{ old('description', $semester->description ?? '') }}</textarea>

        @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="mt-8 flex justify-end gap-3">
    <a
        href="{{ route('semesters.index') }}"
        class="rounded-xl border px-5 py-3"
    >
        Cancel
    </a>

    <button class="rounded-xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">
        Save Semester
    </button>
</div>
