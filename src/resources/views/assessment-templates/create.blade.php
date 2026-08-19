<x-app-layout>
    <x-slot name="header">
        <h3 class="text-lg font-semibold leading-tight text-gray-800">
            Create Assessment Template
        </h3>
    </x-slot>

    <div class="mx-auto max-w-4xl p-6">

        <div class="mb-6">

            <h1 class="text-2xl font-semibold">
                Create Assessment Template
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Create an assessment form for a course.
            </p>

        </div>


        <form method="POST" action="{{ route('assessment-templates.store') }}" class="rounded-lg border bg-white">

            @csrf

            <div class="space-y-6 p-6">

                {{-- Course --}}
                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Course <span class="text-red-500">*</span>
                    </label>

                    <select name="course_id" required class="w-full rounded-md border-gray-300">

                        <option value="">
                            Select Course
                        </option>

                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                {{ $course->code }} -
                                {{ $course->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('course_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Code --}}
                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Assessment Code <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="code" value="{{ old('code') }}" required maxlength="100"
                        placeholder="e.g. DVV40237-DEMONSTRATION" class="w-full rounded-md border-gray-300">

                    @error('code')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Name --}}
                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Assessment Name <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="e.g. Demonstration" class="w-full rounded-md border-gray-300">

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Description
                    </label>

                    <textarea name="description" rows="4" class="w-full rounded-md border-gray-300"
                        placeholder="Describe this assessment...">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Assessor --}}
                <div>

                    <label class="mb-1 block text-sm font-medium">
                        Assessor Type <span class="text-red-500">*</span>
                    </label>

                    <select name="assessor_type" required class="w-full rounded-md border-gray-300">

                        <option value="INDUSTRY_MENTOR" @selected(old('assessor_type', 'INDUSTRY_MENTOR') === 'INDUSTRY_MENTOR')>
                            Industry Mentor
                        </option>

                    </select>

                    <p class="mt-1 text-xs text-gray-500">
                        Assessment is currently completed by Industry Mentor.
                    </p>

                    @error('assessor_type')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label class="flex items-center gap-2">

                        <input type="checkbox" name="status" value="1" checked class="rounded border-gray-300">

                        <span class="text-sm font-medium">
                            Active
                        </span>

                    </label>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex justify-end gap-3 border-t bg-gray-50 p-5">

                <a href="{{ route('assessment-templates.index') }}" class="rounded-md border border-gray-400 px-4 py-2 text-sm">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-md bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700">
                    Save Assessment
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
