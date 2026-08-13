<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Code --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
            Academic Session Code
        </label>

        <input
            type="text"
            value="{{ old('code', $academicSession->code ?? ($nextCode ?? 'Auto generated')) }}"
            readonly
            disabled
            class="w-full rounded-xl border-slate-300 bg-slate-100 text-slate-500 cursor-not-allowed">

        <p class="mt-1 text-sm text-slate-500">
            Generated automatically in sequence starting from 0001.
        </p>
    </div>

    {{-- Status --}}
    <div>

        <label class="block text-sm font-medium text-slate-700 mb-2">
            Status
        </label>

        <select
            name="status"
            class="w-full rounded-xl border-slate-300">

            <option @if(old('status', $academicSession->status ?? '') == 'Draft') selected @endif value="Draft">Draft</option>

            <option @if(old('status', $academicSession->status ?? '') == 'Active') selected @endif value="Active">Active</option>

            <option @if(old('status', $academicSession->status ?? '') == 'Closed') selected @endif value="Closed">Closed</option>

        </select>

        @error('status')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

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

        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

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

        @error('start_date')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

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

        @error('end_date')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

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

        @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

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
