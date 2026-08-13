<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Class Courses
            </h2>


        </div>

    </x-slot>
<div class="flex flex-col gap-4 mb-6  sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Assign a Class Course
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Add a course to a class.
                </p>
            </div>



    </div>

    <div class="max-w-full">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <form
                method="POST"
                action="{{ route('class-courses.store') }}"
            >

                @csrf

                @include('class-courses._form')

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

                    <a
                        href="{{ route('class-courses.index') }}"
                        class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex justify-center items-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
                    >
                        Assign Course
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
