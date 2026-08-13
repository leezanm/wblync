<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Semesters
            </h2>
        </div>
    </x-slot>

    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Edit Semester
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Update semester information.
            </p>
        </div>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-6xl">
            <div class="rounded-2xl bg-white p-8 shadow">
                <form action="{{ route('semesters.update', $semester) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('semesters.form')
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
