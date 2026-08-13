<div class="space-y-6">

    {{-- Programme --}}
    <div>

        <label
            for="programme_id"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Programme
        </label>

        <select
            id="programme_id"
            name="programme_id"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

            <option value="">
                Select programme
            </option>

            @foreach ($programmes as $programme)

                <option
                    value="{{ $programme->id }}"
                    @selected(
                        old(
                            'programme_id',
                            $course->programme_id ?? ''
                        ) == $programme->id
                    )
                >
                    {{ $programme->code }} - {{ $programme->name }}
                </option>

            @endforeach

        </select>

        @error('programme_id')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Code --}}
    <div>

        <label
            for="code"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Course Code
        </label>

        <input
            id="code"
            type="text"
            name="code"
            value="{{ old('code', $course->code ?? '') }}"
            placeholder="e.g. BIT101"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 uppercase focus:border-blue-500 focus:ring-blue-500"
        >

        @error('code')

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
            Course Name
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $course->name ?? '') }}"
            placeholder="e.g. Introduction to Programming"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

        @error('name')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Credit Hours --}}
    <div>

        <label
            for="credit_hours"
            class="block text-sm font-medium text-slate-700 mb-2"
        >
            Credit Hours
        </label>

        <input
            id="credit_hours"
            type="number"
            name="credit_hours"
            min="1"
            max="20"
            value="{{ old('credit_hours', $course->credit_hours ?? '') }}"
            placeholder="e.g. 3"
            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
        >

        @error('credit_hours')

            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>

        @enderror

    </div>


    {{-- Status --}}
    <div>

        <label class="flex items-center gap-3">

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
                        $course->status ?? true
                    )
                )
                class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
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
