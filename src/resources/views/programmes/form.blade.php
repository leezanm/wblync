<div class="grid grid-cols-1 gap-6 md:grid-cols-2">

    <div>
        <label for="code" class="mb-2 block text-sm font-medium text-slate-700">
            Programme Code <span class="text-red-500">*</span>
        </label>

        <input
            id="code"
            type="text"
            name="code"
            value="{{ old('code', $programme->code ?? '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
            placeholder="CS110"
        >

        @error('code')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="duration" class="mb-2 block text-sm font-medium text-slate-700">
            Duration (Years)
        </label>

        <input
            id="duration"
            type="number"
            name="duration"
            min="1"
            max="10"
            step="0.1"
            value="{{ old('duration', $programme->duration ?? '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
            placeholder="2.5"
        >

        @error('duration')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
            Programme Name <span class="text-red-500">*</span>
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $programme->name ?? '') }}"
            class="w-full rounded-xl border-slate-300 focus:border-blue-600 focus:ring-blue-600"
            placeholder="Diploma in Computer Science"
        >

        @error('name')
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
            <option value="1" @selected((string) old('status', $programme->status ?? '1') === '1')>Active</option>
            <option value="0" @selected((string) old('status', $programme->status ?? '1') === '0')>Inactive</option>
        </select>

        @error('status')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
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
            placeholder="Describe the programme outline..."
        >{{ old('description', $programme->description ?? '') }}</textarea>

        @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="mt-8 flex justify-end gap-3">
    <a href="{{ route('programmes.index') }}" class="rounded-xl border px-5 py-3">
        Cancel
    </a>

    <button class="rounded-xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">
        Save Programme
    </button>
</div>
