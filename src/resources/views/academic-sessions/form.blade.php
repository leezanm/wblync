<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Code --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
            Academic Session Code <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="code"
            value="{{ old('code', $academicSession->code ?? '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600">

        @error('code')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>

        <label class="block text-sm font-medium text-slate-700 mb-2">
            Status
        </label>

        <select
            name="status"
            class="w-full rounded-xl border-slate-300">

            <option value="Draft">Draft</option>

            <option value="Active">Active</option>

            <option value="Closed">Closed</option>

        </select>

    </div>

    {{-- Name --}}
    <div class="md:col-span-2">

        <label class="block text-sm font-medium text-slate-700 mb-2">

            Academic Session Name

        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name',$academicSession->name ?? '') }}"
            class="w-full rounded-xl border-slate-300">

    </div>

    {{-- Start Date --}}
    <div>

        <label class="block text-sm font-medium mb-2">

            Start Date

        </label>

        <input
            type="date"
            name="start_date"
            value="{{ old('start_date',isset($academicSession)?$academicSession->start_date?->format('Y-m-d'):'') }}"
            class="w-full rounded-xl border-slate-300">

    </div>

    {{-- End Date --}}
    <div>

        <label class="block text-sm font-medium mb-2">

            End Date

        </label>

        <input
            type="date"
            name="end_date"
            value="{{ old('end_date',isset($academicSession)?$academicSession->end_date?->format('Y-m-d'):'') }}"
            class="w-full rounded-xl border-slate-300">

    </div>

    {{-- Current --}}
    <div class="md:col-span-2">

        <label class="inline-flex items-center gap-2">

            <input
                type="checkbox"
                name="current"
                value="1"
                @checked(old('current',$academicSession->current ?? false))
            >

            <span>Set as Current Academic Session</span>

        </label>

    </div>

    {{-- Description --}}
    <div class="md:col-span-2">

        <label class="block text-sm font-medium mb-2">

            Description

        </label>

        <textarea
            rows="5"
            name="description"
            class="w-full rounded-xl border-slate-300">{{ old('description',$academicSession->description ?? '') }}</textarea>

    </div>

</div>

<div class="flex justify-end gap-3 mt-8">

    <a
        href="{{ route('academic-sessions.index') }}"
        class="px-5 py-3 rounded-xl border">

        Cancel

    </a>

    <button
        class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

        Save Academic Session

    </button>

</div>
