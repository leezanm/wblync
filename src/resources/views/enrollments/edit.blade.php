<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Enrollments
            </h2>

        </div>

    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Edit Enrollment
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Update the student's course enrollment.
                </p>
            </div>

    </div>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

            <form
                method="POST"
                action="{{ route('enrollments.update', $enrollment) }}"
            >

                @csrf
                @method('PUT')

                @include('enrollments._form')

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-100">

                    <a
                        href="{{ route('enrollments.index') }}"
                        class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex justify-center items-center px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
